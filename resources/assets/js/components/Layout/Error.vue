<template>
    <div class="block w-full border border-red-300 bg-red-100 text-red-800 p-2 mb-2">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "Error"
    }
</script>
