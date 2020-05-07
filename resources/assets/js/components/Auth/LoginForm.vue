<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <section class="mt-20">
        <Panel>
            <template v-slot:header>Login</template>

            <template v-slot:body>
                <form role="form" method="POST" :action="route('auth.login')">
                    <Error v-if="error">{{ error }}</Error>

                    <div class="relative">
                        <Loading v-if="loading"></Loading>

                        <FormInput v-model="form.email"
                                   :name="'email'"
                                   :type="'email'"
                                   :placeholder="'E-mail'"
                        ></FormInput>

                        <FormInput v-model="form.password"
                                   :name="'password'"
                                   :type="'password'"
                                   :placeholder="'Password'"
                        ></FormInput>

                        <div>
                            <PrimaryButton @click.native.prevent="login">Log in</PrimaryButton>

                            <div class="flex text-gray-500 mt-2 text-xs justify-between">
                                <a class="hover:underline" :href="route('auth.restore_password')">Lost your password?</a>

                                <span>|</span>

                                <p>New to site? <a :href="route('auth.register')" class="hover:underline">Create Account</a></p>
                            </div>
                        </div>
                    </div>
                </form>
            </template>
        </Panel>
    </section>
</template>

<script>
    import Panel from "../Layout/Panel";
    import FormInput from "../Layout/Form/FormInput";
    import Error from "../Layout/Error";
    import Loading from "../Layout/Loading";
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";

    export default {
        name: "LoginForm",

        components: {PrimaryButton, Loading, Error, FormInput, Panel},

        data() {
            return {
                loading: false,

                error: '',

                form: {
                    email: '',
                    password: ''
                }
            }
        },

        methods: {
            login() {
                this.loading = true;

                this.http().post(this.route('auth.login'), this.form)
                    .then((response) => {
                        this.loading = false;

                        if (!_.isUndefined(response.error)) {
                            this.error = response.error;
                        }

                        if (!_.isUndefined(response.success) && response.success === true) {
                            document.location.href = response.redirect;
                        }
                    })
                    .catch(() => {
                        this.loading = false;
                        this.error = 'Something went wrong. Please contact our support.';
                    });
            }
        }
    }
</script>
