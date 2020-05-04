<template>
    <Button :size="size" class="border-red-300 bg-red-100 text-red-800 hover:bg-red-200">
        <slot></slot>
    </Button>
</template>

<script>
    import Button from "./Button";

    export default {
        name: "DangerButton",

        components: {Button},

        props: {
            size: {
                type: String,
                default: 'md'
            }
        }
    }
</script>
