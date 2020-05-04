<template>
    <button
            class="border rounded focus:outline-none"
            :class="computedClasses"
    >
        <slot></slot>
    </button>
</template>

<script>
    export default {
        name: "Button",

        props: {
            size: {
                type: String,
                default: 'md'
            }
        },

        computed: {
            computedClasses() {
                switch (this.size) {
                    case 'sm':
                        return 'text-sm py-1 px-2';
                    case 'md':
                        return 'py-1 px-2';
                    case 'lg':
                        return 'py-2 px-2';
                    default:
                        return 'py-1 px-2';
                }
            }
        }
    }
</script>
