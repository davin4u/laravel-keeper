<template>
    <div class="text-center">
        <InlineGroupEdit
                v-if="creating"
                @cancel="creating = false"
                @saved="creating = false"
        ></InlineGroupEdit>

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
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";
    import InlineGroupEdit from "./InlineGroupEdit";

    export default {
        name: "CreateNewGroupInlineComponent",

        components: {InlineGroupEdit, PrimaryButton},

        data() {
            return {
                creating: false
            }
        }
    }
</script>
