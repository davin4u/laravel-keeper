<template>
    <Modal>
        <div class="flex flex-wrap mb-3">
            <div v-for="icon in icons" class="w-2/12 text-center">
                <button
                        @click.prevent="select(icon)"
                        class="p-3 text-gray-600 hover:bg-gray-200 focus:outline-none"
                        :class="{
                            'bg-gray-200': isCurrentIcon(icon)
                        }"
                >
                    <component :is="getIconComponent(icon)" class="w-6 h-6"></component>
                </button>
            </div>
        </div>

        <DangerButton @click.native.prevent="cancel">Cancel</DangerButton>
    </Modal>
</template>

<script>
    import Modal from "../Layout/Modal/Modal";
    import DangerButton from "../Layout/Buttons/DangerButton";

    export default {
        name: "IconSelector",

        components: {DangerButton, Modal},

        props: ['current'],

        computed: {
            icons() {
                return this.getAppIcons();
            }
        },

        methods: {
            isCurrentIcon(name) {
                return name === this.current;
            },

            cancel() {
                this.$emit('cancel');
            },

            select(icon) {
                this.$emit('select', {icon: icon});
            }
        }
    }
</script>
