<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <Panel :no-header="true">
        <template v-slot:body>
            <div class="w-full">
                <div v-for="item in menuItems" class="mb-2">
                    <a
                            @click.prevent="changeScreen(item.screen)"
                            class="block p-1 underline-no border-l-4 hover:border-blue-800"
                            :class="{
                                'border-white': !isCurrentPage(item),
                                'border-blue-800': isCurrentPage(item)
                            }"
                            href="javascript:void(0)"
                    >{{ item.name }}</a>
                </div>
            </div>

            <div class="w-full mt-2">
                <CreateNewGroupInlineComponent></CreateNewGroupInlineComponent>
            </div>
        </template>
    </Panel>
</template>

<script>
    import Panel from "./Layout/Panel";
    import ButtonLink from "./Layout/ButtonLink";
    import CreateNewGroupInlineComponent from "./PasswordGroups/CreateNewGroupInlineComponent";

    export default {
        name: "AppSideMenu",

        components: {CreateNewGroupInlineComponent, ButtonLink, Panel},

        methods: {
            changeScreen(screen) {
                this.$store.commit('changeScreen', screen);
            },

            isCurrentPage(item) {
                return this.$store.state.screen === item.screen;
            }
        },

        computed: {
            menuItems() {
                return this.$store.state.pageData.sideMenuItems || [];
            }
        }
    }
</script>
