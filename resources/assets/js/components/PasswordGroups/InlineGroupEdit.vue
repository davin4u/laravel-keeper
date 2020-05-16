<template>
    <div>
        <div class="flex mb-2">
            <button @click.prevent="selectIcon()" class="flex mr-1 px-3 text-gray-600 hover:bg-gray-200 focus:outline-none">
                <component :is="getIconComponent(iconPreference)" class="w-4 h-4 self-center"></component>
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

        <IconSelector
                :current="iconPreference"
                @select="iconSelected"
                @cancel="showIconSelector = false"
                v-if="showIconSelector"
        ></IconSelector>
    </div>
</template>

<script>
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";
    import DangerButton from "../Layout/Buttons/DangerButton";
    import FormInput from "../Layout/Form/FormInput";
    import IconSelector from "../Functional/IconSelector";

    export default {
        name: "InlineGroupEdit",

        components: {IconSelector, FormInput, DangerButton, PrimaryButton},

        props: {
            group: {
                default: null
            }
        },

        data() {
            return {
                newGroupName: '',

                error: '',

                iconPreference: 'FolderIcon',

                showIconSelector: false
            }
        },

        computed: {
            isEditMode() {
                return !_.isNull(this.group);
            }
        },

        mounted() {
            if (this.isEditMode) {
                this.iconPreference = _.get(this.group, ['icon'], 'FolderIcon');
                this.newGroupName = _.get(this.group, ['name'], '');
            }
        },

        methods: {
            save() {
                this.error = '';

                let url = this.isEditMode
                    ? this.route('password_groups.update', {id: this.group.id})
                    : this.route('password_groups.store');

                this.http().post(url, { name: this.newGroupName, icon: this.iconPreference })
                    .then((response) => {
                        if (!_.isUndefined(response) && response.success === true) {
                            this.$store.commit('setUser', response.user);

                            this.setDefaults();

                            this.$emit('saved');
                        }
                    })
                    .catch(() => {
                        this.error = 'Something went wrong. Please contact our support.';
                    });
            },

            cancel() {
                this.setDefaults();

                this.$emit('cancel');
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
