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

                        <button
                                v-if="isGroupEditable(item)"
                                @click.prevent="deleteGroup(item)"
                                class="edit-group-btn self-center p-1 text-gray-500 hover:text-red-800 focus:outline-none"
                                content="Delete group"
                                v-tippy
                        >
                            <TrashIcon class="w-4 h-4"></TrashIcon>
                        </button>
                    </div>
                </div>
            </div>

            <div class="w-full mt-2">
                <CreateNewGroupInlineComponent></CreateNewGroupInlineComponent>
            </div>

            <ConfirmationModal
                    v-if="deleting"
                    @confirm="confirmDeleteGroup"
                    @cancel="deleting = null"
            >
                <p class="text-xl text-red-600">WARNING</p>
                <p>You are going to delete the group</p>
                <p><span class="text-red-600">ALL</span> passwords attached to this group will be removed as well.</p>
                <p>Are you sure?</p>
            </ConfirmationModal>
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
    import TrashIcon from "./Icons/TrashIcon";
    import ConfirmationModal from "./Layout/Modal/ConfirmationModal";

    export default {
        name: "AppSideMenu",

        components: {
            ConfirmationModal,
            TrashIcon, InlineGroupEdit, CogIcon, CreateNewGroupInlineComponent, ButtonLink, Panel},

        mixins: [user],

        data() {
            return {
                editing: null,
                deleting: null
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
            },

            deleteGroup(item) {
                this.deleting = item;
            },

            confirmDeleteGroup() {
                this.http().post(this.route('password_groups.delete', {id: this.deleting.id}))
                    .then((response) => {
                        if (this.deleting.screen === this.$store.state.screen) {
                            this.$store.commit('changeScreen', 'passwords');
                        }

                        this.deleting = null;

                        if (!_.isUndefined(response) && response.success === true) {
                            this.$store.commit('setUser', response.user);
                        }
                    })
                    .catch(() => {
                        this.deleting = null;
                    });
            }
        },

        computed: {
            menuItems() {
                let data = {
                    sideMenuItems: [
                        //{name: 'Dashboard', screen: 'dashboard', icon: 'DashboardIcon'},
                        {name: 'Passwords', screen: 'passwords', icon: 'LockerClosedIcon'},
                        {name: 'Projects', screen: 'projects', icon: 'ProjectsIcon'}
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
