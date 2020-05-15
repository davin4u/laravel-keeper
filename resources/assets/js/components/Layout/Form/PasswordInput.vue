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

            <div class="absolute right-0 top-0 h-full">
                <a
                    class="block text-blue-800 py-1 px-2 h-full flex cursor-pointer"
                    @click.prevent="toggleShow"
                    href="javascript:void(0)"
                    :content="show ? 'Hide password' : 'Show password'"
                    v-tippy
                >
                    <ShowIcon v-if="!show" class="w-6 h-6 self-center"></ShowIcon>
                    <HideIcon v-if="show" class="w-6 h-6 self-center"></HideIcon>
                </a>
            </div>
        </div>

        <div v-if="error" class="mt-2 text-xs text-red-600 font-bold">
            {{ error }}
        </div>
    </div>
</template>

<script>
    import ShowIcon from "../../Icons/ShowIcon";
    import HideIcon from "../../Icons/HideIcon";

    export default {
        name: "PasswordInput",

        components: {HideIcon, ShowIcon},

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
            },
            icon: {
                default: null
            }
        },

        data() {
            return {
                inputValue: '',

                show: false,

                iconComponent: null
            }
        },

        computed: {
            type() {
                return this.show ? 'text' : 'password';
            },

            withIcon() {
                return this.icon && this.iconComponent;
            }
        },

        methods: {
            toggleShow() {
                this.show = !this.show;
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
