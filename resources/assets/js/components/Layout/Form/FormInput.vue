<template>
    <div>
        <div v-if="label" class="mb-1 w-full text-gray-700 font-bold">{{ label }}</div>

        <div class="relative">
            <div v-if="withIcon" class="absolute left-0 top-0 h-full flex text-gray-500 ml-2">
                <component :is="iconComponent" class="w-5 h-5 self-center"></component>
            </div>

            <input
                    class="w-full border p-2 outline-none"
                    :class="{
                        'border-gray-400': !error,
                        'border-red-600': error,
                        'pl-10': withIcon
                    }"
                    :name="name"
                    :type="type"
                    :placeholder="placeholder"
                    :value="value"
                    v-model="inputValue"
            />
        </div>

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
            },
            label: {
                type: String,
                default: ''
            },
            icon: {
                default: null
            }
        },

        data() {
            return {
                inputValue: '',
                iconComponent: null
            }
        },

        computed: {
            withIcon() {
                return this.icon && this.iconComponent;
            }
        },

        mounted() {
            this.inputValue = this.value;

            if (this.icon) {
                this.iconComponent = this.getIconComponent(this.icon);
            }
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
