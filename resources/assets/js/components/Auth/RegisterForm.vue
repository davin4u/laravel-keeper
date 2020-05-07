<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <section class="mt-20">
        <Panel>
            <template v-slot:header>Create Account</template>

            <template v-slot:body>
                <Error v-if="error">{{ error }}</Error>

                <div class="relative">
                    <Loading v-if="loading"></Loading>

                    <form role="form" method="POST" :action="route('auth.register')">
                        <FormInput v-model="form.name"
                                   :name="'name'"
                                   :type="'text'"
                                   :placeholder="'Your name'"
                                   :error="form.errors.name"
                        ></FormInput>

                        <FormInput v-model="form.email"
                                   :name="'email'"
                                   :type="'email'"
                                   :placeholder="'E-mail'"
                                   :error="form.errors.email"
                        ></FormInput>

                        <FormInput v-model="form.password"
                                   :name="'password'"
                                   :type="'password'"
                                   :placeholder="'Password'"
                                   :error="form.errors.password"
                        ></FormInput>

                        <FormInput v-model="form.password_confirmation"
                                   :name="'password_confirmation'"
                                   :type="'password'"
                                   :placeholder="'Confirm password'"
                        ></FormInput>

                        <div>
                            <PrimaryButton @click.native.prevent="register">Register</PrimaryButton>

                            <div class="flex text-gray-500 mt-2 text-xs justify-between">
                                <p>Already a member? <a :href="route('auth.login')" class="hover:underline">Log in</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </template>
        </Panel>
    </section>
</template>

<script>
    import Panel from "../Layout/Panel";
    import FormInput from "../Layout/Form/FormInput";
    import Loading from "../Layout/Loading";
    import Error from "../Layout/Error";
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";

    export default {
        name: "RegisterForm",

        components: {PrimaryButton, Error, Loading, FormInput, Panel},

        data() {
            return {
                loading: false,

                error: '',

                form: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    errors: {
                        name: '',
                        email: '',
                        password: ''
                    }
                }
            }
        },

        methods: {
            register() {
                this.error = '';
                this.loading = true;

                let data = {
                    name: this.form.name,
                    email: this.form.email,
                    password: this.form.password,
                    password_confirmation: this.form.password_confirmation
                };

                this.http().post(this.route('auth.register'), data)
                    .then((response) => {
                        this.loading = false;

                        this.processResponse(response);
                    })
                    .catch(() => {
                        this.loading = false;

                        this.error = 'Something went wrong. Please contact our support.';
                    });
            },

            processResponse(response) {
                this.processErrors(response.errors || {});

                if (!_.isUndefined(response.user) && response.success === true) {
                    document.location.href = response.redirect;
                }
            },

            processErrors(errors) {
                let fields = ['name', 'email', 'password'];

                for (let key in fields) {
                    if (!errors.hasOwnProperty(fields[key])) {
                        this.form.errors[fields[key]] = '';

                        continue;
                    }

                    this.form.errors[fields[key]] = errors[fields[key]][0] || '';
                }
            }
        },

        watch: {
            'form.name': function () {
                this.form.errors.name = '';
            },
            'form.email': function () {
                this.form.errors.email = '';
            },
            'form.password': function () {
                this.form.errors.password = '';
            }
        }
    }
</script>
