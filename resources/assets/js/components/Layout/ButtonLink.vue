<template>
    <a
        :href="link"
        class="py-1 px-2 border border-blue-300 bg-blue-100 text-blue-800 text-sm rounded focus:outline-none hover:bg-blue-200 self-center"
    >
        <slot></slot>
    </a>
</template>

<script>
    export default {
        name: "ButtonLink",

        props: {
            link: {
                type: String,
                default: 'javascript:void(0)'
            }
        }
    }
</script>
