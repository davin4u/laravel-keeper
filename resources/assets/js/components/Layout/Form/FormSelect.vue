<template>
    <div>
        <div v-if="label" class="mb-1 w-full text-gray-700 font-bold">{{ label }}</div>

        <div class="relative w-full">
            <select
                    class="w-full border p-2 bg-white appearance-none rounded-none outline-none"
                    :class="{
                        'border-gray-400': !error,
                        'border-red-600': error
                    }"
                    :name="name"
                    :value="value"
                    v-model="inputValue"
            >
                <option value="0">{{ placeholder }}</option>

                <option v-for="option in options" :value="option.value">{{ option.name }}</option>
            </select>

            <div class="flex px-3 m-2 pointer-events-none absolute inset-y-0 right-0 items-center text-blue-800 bg-white">
                <SelectDropdownIcon></SelectDropdownIcon>
            </div>
        </div>

        <div v-if="error" class="mt-2 text-xs text-red-600 font-bold">
            {{ error }}
        </div>
    </div>
</template>

<script>
    import SelectDropdownIcon from "../../Icons/SelectDropdownIcon";

    export default {
        name: "FormSelect",

        components: {SelectDropdownIcon},

        props: {
            options: {
                type: Array,
                default: function () {
                    return [];
                }
            },
            name: {
                type: String,
                default: ''
            },
            placeholder: {
                type: String,
                default: ''
            },
            value: {
                type: Number,
                default: 0
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
            this.inputValue = parseInt(this.value);
        },

        watch: {
            'value': function () {
                this.inputValue = parseInt(this.value);
            },

            'inputValue': function () {
                this.$emit('input', parseInt(this.inputValue));
            }
        }
    }
</script>
