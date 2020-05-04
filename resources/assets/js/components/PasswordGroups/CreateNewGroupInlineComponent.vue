<template>
    <div class="text-center">
        <div v-if="creating">
            <FormInput
                v-model="newGroupName"
                :name="'new_group'"
                :type="'text'"
                :placeholder="'Group name'"
                :error="error"
            ></FormInput>

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
    </div>
</template>

<script>
    import PlusIcon from "../Icons/PlusIcon";
    import FormInput from "../Layout/FormInput";
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";
    import DangerButton from "../Layout/Buttons/DangerButton";

    export default {
        name: "CreateNewGroupInlineComponent",

        components: {DangerButton, PrimaryButton, FormInput, PlusIcon},

        data() {
            return {
                creating: false,

                newGroupName: '',

                error: ''
            }
        },

        methods: {
            save() {
                this.error = '';

                let data = {
                    sideMenuItems: this.$store.state.pageData.sideMenuItems || []
                };

                this.http().post(this.route('password_groups.store'), { name: this.newGroupName })
                    .then((response) => {
                        if (!_.isUndefined(response) && response.success === true) {
                            data.sideMenuItems.push({
                                name: this.newGroupName,
                                screen: 'passwords#group-' + response.group.id
                            });

                            this.$store.commit('updatePageData', data);

                            this.creating = false;

                            this.newGroupName = '';
                        }
                    })
                    .catch(() => {
                        this.error = 'Something went wrong. Please contact our support.';
                    });
            },

            cancel() {
                this.error = '';
                this.creating = false;
                this.newGroupName = '';
            }
        }
    }
</script>
