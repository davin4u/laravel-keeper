<template>
    <div class="mb-2">
        <textarea
                class="w-full h-40 border p-2 outline-none"
                :class="{
                    'border-gray-200': !error,
                    'border-red-600': error
                }"
                :name="name"
                :placeholder="placeholder"
                v-model="inputValue"
        >{{ value }}</textarea>

        <div v-if="error" class="mt-2 text-xs text-red-600 font-bold">
            {{ error }}
        </div>
    </div>
</template>

<script>
    export default {
        name: "FormTextArea",

        props: {
            name: {
                type: String,
                default: ''
            },
            placeholder: {
                type: String,
                default: ''
            },
            value: {
                type: String,
                default: ''
            },
            error: {
                type: String,
                default: ''
            }
        },

        data() {
            return {
                inputValue: ''
            }
        },

        mounted() {
            this.inputValue = this.value;
        },

        watch: {
            'inputValue': function () {
                this.$emit('input', this.inputValue);
            }
        }
    }
</script>
