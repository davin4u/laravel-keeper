<template>
    <div class="bg-white p-3 shadow">
        <PanelHeader v-if="!noHeader">
            <slot name="header"></slot>
        </PanelHeader>

        <slot name="body"></slot>
    </div>
</template>

<script>
    import PanelHeader from "./PanelHeader";

    export default {
        name: "Panel",

        components: {PanelHeader},

        props: {
            noHeader: {
                type: Boolean,
                default: false
            }
        }
    }
</script>
