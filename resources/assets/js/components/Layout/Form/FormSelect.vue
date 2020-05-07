<template>
    <div class="mb-2">
        <div class="relative">
            <select
                    class="w-full border p-2 border-gray-200 bg-white appearance-none rounded-none outline-none"
                    :class="{
                        'border-gray-200': !error,
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
            'inputValue': function () {
                this.$emit('input', parseInt(this.inputValue));
            }
        }
    }
</script>
