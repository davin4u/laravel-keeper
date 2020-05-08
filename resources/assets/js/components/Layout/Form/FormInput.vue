<template>
    <div class="mb-2">
        <input
                class="w-full border p-2 outline-none"
                :class="{
                    'border-gray-200': !error,
                    'border-red-600': error
                }"
                :name="name"
                :type="type"
                :placeholder="placeholder"
                :value="value"
                v-model="inputValue"
        />

        <div v-if="error" class="mt-2 text-xs text-red-600 font-bold">
            {{ error }}
        </div>
    </div>
</template>

<script>
    export default {
        name: "FormInput",

        props: {
            name: {
                type: String,
                default: ''
            },
            type: {
                type: String,
                default: 'text'
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
            'value': function () {
                this.inputValue = this.value;
            },

            'inputValue': function () {
                this.$emit('input', this.inputValue);
            }
        }
    }
</script>
