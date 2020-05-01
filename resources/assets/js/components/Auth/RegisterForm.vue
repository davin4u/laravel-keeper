<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <section class="mt-20">
        <Panel>
            <template v-slot:header>Create Account</template>

            <template v-slot:body>
                <form role="form" method="POST" :action="route('auth.register')">
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

                    <FormInput v-model="form.password_confirmation"
                               :name="'password_confirmation'"
                               :type="'password'"
                               :placeholder="'Confirm password'"
                    ></FormInput>

                    <div>
                        <Button @click.native.prevent="login">Register</Button>

                        <div class="flex text-gray-500 mt-2 text-xs justify-between">
                            <p>Already a member? <a :href="route('auth.login')" class="hover:underline">Log in</a></p>
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
        name: "RegisterForm",

        components: {Button, FormInput, Panel},

        data() {
            return {
                form: {
                    email: '',
                    password: '',
                    password_confirmation: ''
                }
            }
        }
    }
</script>
