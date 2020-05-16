<template>
    <div class="fixed w-full h-screen top-0 left-0 z-40">
        <div class="fixed w-full h-screen top-0 left-0 bg-black opacity-25 z-40"></div>

        <div class="fixed z-50 w-full h-screen">
            <div class="w-1/3 mx-auto mt-10 rounded shadow p-4 bg-white text-center z-50 md:mt-32">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Modal"
    }
</script>
