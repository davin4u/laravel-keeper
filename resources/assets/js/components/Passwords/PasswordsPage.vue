<template>
    <div>
        <Error v-if="error">{{ error }}</Error>

        <div class="w-full mb-2">
            <div class="flex border-b border-gray-300">
                <div class="p-2 w-2/5 font-bold">Password name</div>

                <div class="p-2 w-1/5 font-bold">Username</div>

                <div class="p-2 w-1/5 font-bold">Password</div>

                <div class="p-2 w-1/5"></div>
            </div>

            <div v-for="password in passwords" class="flex border-b border-gray-300">
                <div class="p-2 w-2/5 self-center">
                    <div class="text-gray-700">{{ password.name }}</div>

                    <div v-if="password.project" class="text-gray-500 text-sm">
                        <a :href="password.project.url" target="_blank">{{ password.project.name }}</a>
                    </div>
                </div>

                <div class="p-2 w-1/5 self-center">
                    <div class="text-gray-700">{{ password.username }}</div>
                </div>

                <div class="p-2 w-1/5 self-center">
                    <div class="text-gray-700">{{ password.password }}</div>
                </div>

                <div class="p-2 w-1/5 text-right self-center">
                    <PrimaryButton @click.native.prevent="edit(password)" size="sm">edit</PrimaryButton>

                    <DangerButton @click.native.prevent="deletePassword(password)" size="sm">delete</DangerButton>
                </div>
            </div>
        </div>

        <PrimaryButton @click.native.prevent="create" size="sm">Add new password</PrimaryButton>

        <ConfirmationModal
                v-if="deleting"
                @confirm="confirmPasswordDelete"
                @cancel="deleting = null"
        >
            <p>You are going to delete the password</p>
            <p>Are you sure?</p>
        </ConfirmationModal>
    </div>
</template>

<script>
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";
    import DangerButton from "../Layout/Buttons/DangerButton";
    import {user} from "../../mixins/user";
    import Modal from "../Layout/Modal/Modal";
    import ConfirmationModal from "../Layout/Modal/ConfirmationModal";
    import Error from "../Layout/Error";

    export default {
        name: "PasswordsPage",

        components: {Error, ConfirmationModal, Modal, DangerButton, PrimaryButton},

        mixins: [user],

        data() {
            return {
                error: '',

                deleting: null
            }
        },

        computed: {
            passwords() {
                return this.user().getPasswords();
            }
        },

        methods: {
            create() {
                this.$store.commit('changeScreen', 'passwords.create');
            },

            edit(password) {
                this.$store.commit('changeScreen', 'passwords.edit#id:' + password.id);
            },

            deletePassword(password) {
                this.deleting = password;
            },

            confirmPasswordDelete() {
                if (!this.deleting) {
                    return;
                }

                this.http().post(this.route('passwords.delete', {id: this.deleting.id}))
                    .then((response) => {
                        this.deleting = null;

                        this.processResponse(response);
                    })
                    .catch(() => {
                        this.deleting = null;

                        this.error = 'Something went wrong. Please contact our support.';
                    });
            },

            processResponse(response) {
                if (!_.isUndefined(response.user) && response.success === true) {
                    this.$store.commit('setUser', response.user);
                }
                else if (!_.isUndefined(response.error)) {
                    this.error = response.error;
                }
                else {
                    this.error = 'Something went wrong. Please contact our support.';
                }
            }
        }
    }
</script>
