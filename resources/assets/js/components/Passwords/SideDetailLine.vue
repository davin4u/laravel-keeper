<template>
    <div class="flex w-full mb-2 border-b border-gray-200">
        <div class="w-1/3 text-gray-700 self-center font-bold">{{ label }}</div>

        <div class="flex-1 text-gray-500 self-center" :id="valueId">{{ value }}</div>

        <div class="w-10 self-center text-right">
            <button
                    @click.prevent="copy"
                    content="Copied to clipboard!"
                    v-tippy="{trigger: 'click', delay: [0, 800]}"
                    class="focus:outline-none"
            >
                <CopyIcon class="w-6 h-6"></CopyIcon>
            </button>
        </div>
    </div>
</template>

<script>
    import CopyIcon from "../Icons/CopyIcon";

    export default {
        name: "SideDetailLine",

        components: {CopyIcon},

        props: ['label', 'value'],

        data() {
            return {
                valueId: ''
            }
        },

        methods: {
            copy() {
                if (!_.isUndefined(document.selection)) {
                    /** @TODO check for which browsers this part works */
                    let range = document.body.createTextRange();

                    range.moveToElementText(document.getElementById(this.valueId));
                    range.select().createTextRange();
                    document.execCommand("copy");
                } else if (window.getSelection) {
                    window.getSelection().removeAllRanges();

                    let range = document.createRange();

                    range.selectNode(document.getElementById(this.valueId));

                    window.getSelection().addRange(range);

                    document.execCommand("copy");

                    window.getSelection().removeAllRanges();
                }
            }
        },

        created() {
            this.valueId = 'copy-' + Math.floor(Math.random() * Math.floor(99999)) + '-' + this._uid;
        }
    }
</script>
