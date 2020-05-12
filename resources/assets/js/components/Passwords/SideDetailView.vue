<template>
    <div class="fixed right-0 top-0 w-1/3 h-screen p-2 bg-white border-l border-gray-300 shadow">
        <div class="flex flex-row-reverse">
            <a
                    @click.prevent="close"
                    href="javascript:void(0)"
                    class="text-gray-500 self-center hover:text-gray-700"
            >
                <CloseIcon class="h-8 w-8"></CloseIcon>
            </a>
        </div>

        <PanelHeader class="-mt-2">{{ password.name }}</PanelHeader>

        <div class="mt-2">
            <SideDetailLine :label="'Username:'" :value="password.username"></SideDetailLine>

            <SideDetailLine :label="'Password:'" :value="password.decrypted_password"></SideDetailLine>
        </div>

        <div v-if="project" class="mt-10">
            <PanelHeader class="-mt-2">Project details</PanelHeader>

            <div class="mt-2">
                <SideDetailLine :label="'Name:'" :value="project.name"></SideDetailLine>

                <SideDetailLine :label="'URL:'" :value="project.url"></SideDetailLine>
            </div>
        </div>
    </div>
</template>

<script>
    import PanelHeader from "../Layout/PanelHeader";
    import CloseIcon from "../Icons/CloseIcon";
    import SideDetailLine from "./SideDetailLine";

    export default {
        name: "SideDetailView",

        components: {SideDetailLine, CloseIcon, PanelHeader},

        props: ['password'],

        computed: {
            project() {
                return _.get(this.password, ['project'], null);
            }
        },

        methods: {
            close() {
                this.$emit('close');
            }
        }
    }
</script>
