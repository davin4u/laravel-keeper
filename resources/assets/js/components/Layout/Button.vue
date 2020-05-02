<template>
    <button class="py-1 px-2 border border-blue-300 bg-blue-100 text-blue-800 rounded focus:outline-none hover:bg-blue-200">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        name: "Button"
    }
</script>
