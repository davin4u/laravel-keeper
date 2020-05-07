<template>
    <div>
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
                    <PrimaryButton size="sm">edit</PrimaryButton>

                    <DangerButton size="sm">delete</DangerButton>
                </div>
            </div>
        </div>

        <PrimaryButton @click.native.prevent="create" size="sm">Add new password</PrimaryButton>
    </div>
</template>

<script>
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";
    import DangerButton from "../Layout/Buttons/DangerButton";

    export default {
        name: "PasswordsPage",

        components: {DangerButton, PrimaryButton},

        computed: {
            passwords() {
                return _.get(this.$store.state.user, ['passwords', 'data'], []);
            }
        },

        methods: {
            create() {
                this.$store.commit('changeScreen', 'passwords.create');
            }
        }
    }
</script>
