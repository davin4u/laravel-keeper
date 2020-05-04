<template>
    <Button :size="size" class="border-blue-300 bg-blue-100 text-blue-800 hover:bg-blue-200">
        <slot></slot>
    </Button>
</template>

<script>
    import Button from "./Button";

    export default {
        name: "PrimaryButton",

        components: {Button},

        props: {
            size: {
                type: String,
                default: 'md'
            }
        }
    }
</script>
