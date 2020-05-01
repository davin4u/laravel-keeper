<template>
    <div class="mb-2">
        <input
                class="w-full border border-gray-200 p-2"
                :name="name"
                :type="type"
                :placeholder="placeholder"
                :value="value"
                v-model="inputValue"
        />
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
