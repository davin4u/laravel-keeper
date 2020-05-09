<template>
    <Modal>
        <div>
            <slot></slot>
        </div>

        <div class="text-center mt-4">
            <PrimaryButton @click.native.prevent="confirm">Yes, delete</PrimaryButton>

            <DangerButton @click.native.prevent="cancel">No, cancel</DangerButton>
        </div>
    </Modal>
</template>

<script>
    import Modal from "./Modal";
    import PrimaryButton from "../Buttons/PrimaryButton";
    import DangerButton from "../Buttons/DangerButton";

    export default {
        name: "ConfirmationModal",

        components: {DangerButton, PrimaryButton, Modal},

        methods: {
            confirm() {
                this.$emit('confirm');
            },

            cancel() {
                this.$emit('cancel');
            }
        }
    }
</script>
