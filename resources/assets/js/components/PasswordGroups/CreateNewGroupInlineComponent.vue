<template>
    <div class="text-center">
        <div v-if="creating">
            <div class="flex mb-2">
                <button @click.prevent="selectIcon()" class="mr-1 px-3 text-gray-600 hover:bg-gray-200 focus:outline-none">
                    <component :is="getIconComponent(iconPreference)" class="w-4 h-4"></component>
                </button>

                <FormInput
                    v-model="newGroupName"
                    :name="'new_group'"
                    :type="'text'"
                    :placeholder="'Group name'"
                    :error="error"
                ></FormInput>
            </div>

            <PrimaryButton @click.native.prevent="save" size="sm">Save</PrimaryButton>
            <DangerButton @click.native.prevent="cancel" size="sm">Cancel</DangerButton>
        </div>

        <PrimaryButton
                v-if="!creating"
                @click.native.prevent="creating = true"
                size="sm"
        >
            Add a group
        </PrimaryButton>

        <IconSelector
                :current="iconPreference"
                @select="iconSelected"
                @cancel="showIconSelector = false"
                v-if="showIconSelector"
        ></IconSelector>
    </div>
</template>

<script>
    import PlusIcon from "../Icons/PlusIcon";
    import FormInput from "../Layout/Form/FormInput";
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";
    import DangerButton from "../Layout/Buttons/DangerButton";
    import IconSelector from "../Functional/IconSelector";

    export default {
        name: "CreateNewGroupInlineComponent",

        components: {IconSelector, DangerButton, PrimaryButton, FormInput, PlusIcon},

        data() {
            return {
                creating: false,

                newGroupName: '',

                error: '',

                iconPreference: 'FolderIcon',

                showIconSelector: false
            }
        },

        methods: {
            save() {
                this.error = '';

                let data = {
                    sideMenuItems: this.$store.state.pageData.sideMenuItems || []
                };

                this.http().post(this.route('password_groups.store'), { name: this.newGroupName, icon: this.iconPreference })
                    .then((response) => {
                        if (!_.isUndefined(response) && response.success === true) {
                            data.sideMenuItems.push({
                                name: this.newGroupName,
                                screen: 'passwords#group-' + response.group.id,
                                icon: this.iconPreference
                            });

                            this.$store.commit('updatePageData', data);

                            this.setDefaults();
                        }
                    })
                    .catch(() => {
                        this.error = 'Something went wrong. Please contact our support.';
                    });
            },

            cancel() {
                this.setDefaults();
            },

            selectIcon() {
                this.showIconSelector = true;
            },

            iconSelected(payload) {
                this.iconPreference = _.get(payload, ['icon'], 'FolderIcon');

                this.showIconSelector = false;
            },

            setDefaults() {
                this.error = '';
                this.creating = false;
                this.newGroupName = '';
                this.iconPreference = 'FolderIcon';
            }
        }
    }
</script>
