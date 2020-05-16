<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <Panel :no-header="true">
        <template v-slot:body>
            <div class="w-full">
                <div
                        v-for="item in menuItems"
                        class="mb-2"
                >
                    <div v-if="isEditing(item)">
                        <InlineGroupEdit
                                :group="item"
                                @cancel="editing = null"
                                @saved="editing = null"
                        ></InlineGroupEdit>
                    </div>
                    <div v-else class="group-item flex">
                        <a
                                @click.prevent="changeScreen(item.screen)"
                                class="flex flex-1 p-1 underline-no border-l-4 hover:border-blue-800"
                                :class="{
                                    'border-white': !isCurrentPage(item),
                                    'border-blue-800': isCurrentPage(item)
                                }"
                                href="javascript:void(0)"
                        >
                            <component v-if="item.icon" :is="getIconComponent(item.icon)" class="self-center w-4 h-4 text-gray-600"></component>

                            <span class="ml-1 self-center flex-1">{{ item.name }}</span>
                        </a>

                        <button
                                v-if="isGroupEditable(item)"
                                @click.prevent="editGroup(item)"
                                class="edit-group-btn self-center p-1 text-gray-500 hover:text-blue-800 focus:outline-none"
                                content="Edit group"
                                v-tippy
                        >
                            <CogIcon class="w-4 h-4"></CogIcon>
                        </button>
                    </div>
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
    import CogIcon from "./Icons/CogIcon";
    import {user} from "../mixins/user";
    import InlineGroupEdit from "./PasswordGroups/InlineGroupEdit";

    export default {
        name: "AppSideMenu",

        components: {InlineGroupEdit, CogIcon, CreateNewGroupInlineComponent, ButtonLink, Panel},

        mixins: [user],

        data() {
            return {
                editing: null
            }
        },

        methods: {
            changeScreen(screen) {
                this.$store.commit('changeScreen', screen);
            },

            isCurrentPage(item) {
                return this.$store.state.screen === item.screen;
            },

            isGroupEditable(item) {
                return _.get(item, ['editable'], false);
            },

            editGroup(item) {
                this.editing = item;
            },

            isEditing(item) {
                if (_.isNull(this.editing)) {
                    return false;
                }

                return item.id === this.editing.id;
            }
        },

        computed: {
            menuItems() {
                // set side menu items
                let data = {
                    sideMenuItems: [
                        {name: 'Dashboard', screen: 'dashboard', icon: 'DashboardIcon'},
                        {name: 'Projects', screen: 'projects', icon: 'ProjectsIcon'},
                        {name: 'Passwords', screen: 'passwords', icon: 'LockerClosedIcon'}
                    ]
                };

                let userGroups = this.user().getPasswordGroups();

                if (userGroups.length > 0) {
                    for (let key in userGroups) {
                        let passwordGroup = userGroups[key];

                        data.sideMenuItems.push({
                            id: passwordGroup.id,
                            name: passwordGroup.name,
                            screen: 'passwords#password-group:' + passwordGroup.id,
                            icon: passwordGroup.icon || 'FolderIcon',
                            editable: true
                        });
                    }
                }

                return data.sideMenuItems;
            }
        }
    }
</script>
