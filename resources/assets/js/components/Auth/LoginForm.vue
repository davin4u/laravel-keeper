<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <section class="mt-20">
        <Panel>
            <template v-slot:header>Login</template>

            <template v-slot:body>
                <form role="form" method="POST">
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
                        <Button>Log in</Button>

                        <div class="flex text-gray-500 mt-2 text-xs justify-between">
                            <a class="hover:underline" :href="route('auth.restore_password')">Lost your password?</a>

                            <span>|</span>

                            <p>New to site? <a :href="route('auth.register')" class="hover:underline">Create Account</a></p>
                        </div>
                    </div>
                </form>
            </template>
        </Panel>
    </section>
</template>

<script>
    import Panel from "../Layout/Panel";
    import FormInput from "../Layout/FormInput";
    import Button from "../Layout/Button";

    export default {
        name: "LoginForm",

        components: {Button, FormInput, Panel},

        data() {
            return {
                form: {
                    email: '',
                    password: ''
                }
            }
        },


    }
</script>
