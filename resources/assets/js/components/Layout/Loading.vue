<template>
    <div class="block h-full absolute left-0 right-0 bg-white opacity-75 text-center z-10">
        <LoadingIcon class="inline-block"></LoadingIcon>
    </div>
</template>

<script>
    import LoadingIcon from "../Icons/LoadingIcon";

    export default {
        name: "Loading",
        components: {LoadingIcon}
    }
</script>
