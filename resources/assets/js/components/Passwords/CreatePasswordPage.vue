<template>
    <div class="relative">
        <Error v-if="error">{{ error }}</Error>

        <Loading v-if="loading"></Loading>

        <form role="form" method="POST" :action="route('passwords.store')">
            <div class="flex mb-4">
                <FormSelect v-model="form.project_id"
                            :name="'project_id'"
                            :placeholder="'Project'"
                            :label="'Select a project'"
                            :options="projects"
                            class="w-1/2 mr-1"
                ></FormSelect>

                <FormSelect v-model="form.group_id"
                            :name="'group_id'"
                            :placeholder="'Password group'"
                            :label="'Select a password group'"
                            :options="groups"
                            class="w-1/2 ml-1"
                ></FormSelect>
            </div>

            <FormInput v-model="form.name"
                       :name="'name'"
                       :type="'text'"
                       :placeholder="'Password name'"
                       :label="'Password name'"
                       :error="form.errors.name"
                       class="mb-4"
            ></FormInput>


            <div class="flex w-full mb-4">
                <FormInput v-model="form.username"
                           :name="'username'"
                           :type="'text'"
                           :placeholder="'Username'"
                           :label="'Username/Login'"
                           :error="form.errors.username"
                           class="w-1/2 mr-1"
                ></FormInput>


                <PasswordInput v-model="form.password"
                           :name="'password'"
                           :type="'password'"
                           :placeholder="'Password'"
                           :label="'Password'"
                           :error="form.errors.password"
                           class="w-1/2 ml-1"
                ></PasswordInput>
            </div>

            <FormTextArea v-model="form.full_description"
                          :name="'full_description'"
                          :placeholder="'Password description'"
                          :error="form.errors.full_description"
            ></FormTextArea>

            <div class="mt-4">
                <PrimaryButton @click.native.prevent="create">Create</PrimaryButton>
            </div>
        </form>
    </div>
</template>

<script>
    import Error from "../Layout/Error";
    import Loading from "../Layout/Loading";
    import FormInput from "../Layout/Form/FormInput";
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";
    import FormSelect from "../Layout/Form/FormSelect";
    import FormTextArea from "../Layout/Form/FormTextArea";
    import {user} from "../../mixins/user";
    import PasswordInput from "../Layout/Form/PasswordInput";

    export default {
        name: "CreatePasswordPage",

        components: {PasswordInput, FormTextArea, FormSelect, PrimaryButton, FormInput, Loading, Error},

        mixins: [user],

        data() {
            return {
                loading: false,

                error: '',

                form: {
                    project_id: 0,
                    group_id: 0,
                    name: '',
                    username: '',
                    password: '',
                    full_description: '',

                    errors: {
                        name: '',
                        username: '',
                        password: '',
                        full_description: ''
                    }
                }
            }
        },

        computed: {
            projects() {
                let items = [];

                let userProjects = this.user().getProjects();

                if (userProjects.length > 0) {
                    for (let k in userProjects) {
                        items.push({
                            name: userProjects[k].name,
                            value: userProjects[k].id
                        });
                    }
                }

                return items;
            },

            groups() {
                let items = [];

                let userGroups = this.user().getPasswordGroups();

                if (userGroups.length > 0) {
                    for (let k in userGroups) {
                        items.push({
                            name: userGroups[k].name,
                            value: userGroups[k].id
                        });
                    }
                }

                return items;
            }
        },

        methods: {
            create() {
                this.loading = true;

                let data = {
                    project_id: this.form.project_id,
                    group_id: this.form.group_id,
                    name: this.form.name,
                    username: this.form.username,
                    password: this.form.password,
                    full_description: this.form.full_description
                };

                this.http().post(this.route('passwords.store'), data)
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
                    this.$store.commit('setUser', response.user);
                    this.$store.commit('changeScreen', 'passwords');
                }
            },

            processErrors(errors) {
                let fields = ['name', 'username', 'password', 'full_description'];

                for (let key in fields) {
                    if (!errors.hasOwnProperty(fields[key])) {
                        this.form.errors[fields[key]] = '';

                        continue;
                    }

                    this.form.errors[fields[key]] = errors[fields[key]][0] || '';
                }
            }
        }
    }
</script>
