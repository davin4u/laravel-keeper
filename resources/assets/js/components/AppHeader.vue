<template>
    <div class="w-full border-b-4 border-blue-500 bg-white p-2 mb-2">
        <div class="flex">
            <div class="flex w-1/4">
                <LogoIcon class="w-10 h-10"></LogoIcon>
                <span class="text-gray-600 ml-2 self-center">Laravel passwords keeper</span>
            </div>

            <div class="flex w-3/4 flex-row-reverse">
                <ButtonLink @click.native.prevent="addNewPassword">Add new password</ButtonLink>
            </div>
        </div>
    </div>
</template>

<script>
    import LogoIcon from "./Icons/LogoIcon";
    import Button from "./Layout/Buttons/Button";
    import ButtonLink from "./Layout/ButtonLink";

    export default {
        name: "AppHeader",

        components: {ButtonLink, Button, LogoIcon},

        methods: {
            addNewPassword() {
                this.$store.commit('changeScreen', 'passwords.create');
            }
        }
    }
</script>
