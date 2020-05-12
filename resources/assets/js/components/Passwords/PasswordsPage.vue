<template>
    <div>
        <Error v-if="error">{{ error }}</Error>

        <div class="mb-2 p-2 bg-gray-100 flex">
            <div class="w-1/2">
                <FormInput
                        v-model="search"
                        :type="'text'"
                        :name="'search'"
                        :placeholder="'Search for a password'"
                ></FormInput>
            </div>

            <div class="w-1/2 text-right self-center">
            </div>
        </div>

        <div v-if="havePasswords" class="w-full">
            <div class="flex border-b border-gray-300">
                <div class="p-2 w-56 font-bold">Password name</div>

                <div class="p-2 flex-1 font-bold">Username</div>

                <div class="p-2 w-56"></div>
            </div>

            <div v-for="password in passwords" class="flex border-b border-gray-300">
                <div class="p-2 w-56 self-center">
                    <div class="text-gray-700">{{ password.name }}</div>

                    <div v-if="password.project" class="text-gray-500 text-sm">
                        <a :href="password.project.url" target="_blank">{{ password.project.name }}</a>
                    </div>
                </div>

                <div class="p-2 flex-1 self-center">
                    <div class="text-gray-700">{{ password.username }}</div>
                </div>

                <div class="p-2 w-56 text-right self-center">
                    <PrimaryButton @click.native.prevent="showDetails(password)" size="sm">details</PrimaryButton>

                    <PrimaryButton @click.native.prevent="edit(password)" size="sm">edit</PrimaryButton>

                    <DangerButton @click.native.prevent="deletePassword(password)" size="sm">delete</DangerButton>
                </div>
            </div>
        </div>
        <div v-else>
            <Alert>{{ noPasswordsMessage }}</Alert>
        </div>

        <ConfirmationModal
                v-if="deleting"
                @confirm="confirmPasswordDelete"
                @cancel="deleting = null"
        >
            <p>You are going to delete the password</p>
            <p>Are you sure?</p>
        </ConfirmationModal>

        <SideDetailView
                v-if="detail"
                :password="detail"
                @close="detail = null"
        ></SideDetailView>
    </div>
</template>

<script>
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";
    import DangerButton from "../Layout/Buttons/DangerButton";
    import {user} from "../../mixins/user";
    import Modal from "../Layout/Modal/Modal";
    import ConfirmationModal from "../Layout/Modal/ConfirmationModal";
    import Error from "../Layout/Error";
    import Alert from "../Layout/Alert";
    import FormInput from "../Layout/Form/FormInput";
    import SideDetailView from "./SideDetailView";

    export default {
        name: "PasswordsPage",

        components: {
            SideDetailView,
            FormInput, Alert, Error, ConfirmationModal, Modal, DangerButton, PrimaryButton
        },

        mixins: [user],

        props: ['options'],

        data() {
            return {
                error: '',

                deleting: null,

                search: '',

                detail: null
            }
        },

        computed: {
            passwords() {
                return this.filterPasswords(
                    this.user().getPasswords()
                );
            },

            selectedPasswordGroup() {
                let id = _.get(this.options, ['password-group'], null);

                if (!_.isNull(id)) {
                    id = parseInt(id);
                }

                return id;
            },

            havePasswords() {
                return this.passwords.length > 0;
            },

            noPasswordsMessage() {
                return this.search.length > 0 ? 'No passwords found.' : 'No passwords added yet.';
            }
        },

        methods: {
            filterPasswords(passwords) {
                if (passwords.length === 0) {
                    return [];
                }

                return passwords.filter((password) => {
                    if (!_.isNull(this.selectedPasswordGroup)) {
                        if (
                            !_.isUndefined(password.group)
                            && !_.isNull(password.group)
                            && password.group.id !== this.selectedPasswordGroup
                        ) {
                            return false;
                        }
                    }

                    if (this.search.length > 0) {
                        if (password.name.toLowerCase().indexOf(this.search.toLowerCase()) === -1) {
                            if (!_.isUndefined(password.project)) {
                                if (password.project.name.toLowerCase().indexOf(this.search.toLowerCase()) === -1) {
                                    return false;
                                }
                            }
                            else {
                                return false;
                            }
                        }
                    }

                    return true;
                });

                if (!_.isNull(this.selectedPasswordGroup)) {
                    let filtered = [];

                    for (let k in passwords) {
                        if (
                            !_.isUndefined(passwords[k].group)
                            && !_.isNull(passwords[k].group)
                            && passwords[k].group.id === this.selectedPasswordGroup
                        ) {
                            filtered.push(passwords[k]);
                        }
                    }

                    return filtered;
                }

                return passwords;
            },

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
            },

            showDetails(password) {
                this.detail = password;
            }
        }
    }
</script>
