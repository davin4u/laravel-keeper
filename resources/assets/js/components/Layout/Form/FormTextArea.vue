<template>
    <div>
        <div v-if="label" class="mb-1 w-full text-gray-700 font-bold">{{ label }}</div>

        <textarea
                class="w-full h-40 border p-2 outline-none"
                :class="{
                    'border-gray-400': !error,
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
            },
            label: {
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
            'value': function () {
                this.inputValue = this.value;
            },

            'inputValue': function () {
                this.$emit('input', this.inputValue);
            }
        }
    }
</script>
