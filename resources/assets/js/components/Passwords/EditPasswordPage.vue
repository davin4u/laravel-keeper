<template>
    <div class="relative">
        <Error v-if="error">{{ error }}</Error>

        <Loading v-if="loading"></Loading>

        <form role="form" method="POST" :action="route('passwords.store')">
            <div class="flex">
                <FormSelect v-model="form.project_id"
                            :name="'project_id'"
                            :placeholder="'Project'"
                            :options="projects"
                            class="w-1/2 mr-1 mb-2"
                ></FormSelect>

                <FormSelect v-model="form.group_id"
                            :name="'group_id'"
                            :placeholder="'Password group'"
                            :options="groups"
                            class="w-1/2 ml-1 mb-2"
                ></FormSelect>
            </div>

            <FormInput v-model="form.name"
                       :name="'name'"
                       :type="'text'"
                       :placeholder="'Password name'"
                       :error="form.errors.name"
                       class="mb-2"
            ></FormInput>

            <FormInput v-model="form.username"
                       :name="'username'"
                       :type="'text'"
                       :placeholder="'Username'"
                       :error="form.errors.username"
                       class="mb-2"
            ></FormInput>

            <FormInput v-model="form.password"
                       :name="'password'"
                       :type="'password'"
                       :placeholder="'Password'"
                       :error="form.errors.password"
                       class="mb-2"
            ></FormInput>

            <FormTextArea v-model="form.full_description"
                          :name="'full_description'"
                          :placeholder="'Password description'"
                          :error="form.errors.full_description"
            ></FormTextArea>

            <div>
                <PrimaryButton @click.native.prevent="update">Save</PrimaryButton>

                <DangerButton @click.native.prevent="cancel">Cancel</DangerButton>
            </div>
        </form>
    </div>
</template>

<script>
    import Error from "../Layout/Error";
    import Loading from "../Layout/Loading";
    import FormSelect from "../Layout/Form/FormSelect";
    import FormInput from "../Layout/Form/FormInput";
    import FormTextArea from "../Layout/Form/FormTextArea";
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";
    import {user} from "../../mixins/user";
    import DangerButton from "../Layout/Buttons/DangerButton";

    export default {
        name: "EditPasswordPage",

        components: {DangerButton, PrimaryButton, FormTextArea, FormInput, FormSelect, Loading, Error},

        mixins: [user],

        props: ['options'],

        data() {
            return {
                loading: true,

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
            passwordId() {
                return _.get(this.options, ['id'], null);
            },

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
            cancel() {
                this.$store.commit('changeScreen', 'passwords');
            },

            update() {
                this.loading = true;

                let data = {
                    project_id: this.form.project_id,
                    group_id: this.form.group_id,
                    name: this.form.name,
                    username: this.form.username,
                    password: this.form.password,
                    full_description: this.form.full_description
                };

                this.http().post(this.route('passwords.update', {id: this.passwordId}), data)
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
        },

        mounted() {
            if (!_.isNull(this.passwordId)) {
                this.http().get(this.route('passwords.get', {id: this.passwordId}))
                    .then((response) => {
                        this.loading = false;

                        if (!_.isUndefined(response) && !_.isUndefined(response.data)) {
                            this.form.project_id = _.get(response, ['data', 'project', 'id'], 0);
                            this.form.group_id = _.get(response, ['data', 'group_id'], 0);
                            this.form.name = _.get(response, ['data', 'name'], '');
                            this.form.username = _.get(response, ['data', 'username'], '');
                            this.form.password = _.get(response, ['data', 'decrypted_password'], '');
                            this.form.full_description = _.get(response, ['data', 'full_description'], '');
                        }
                    });
            }
        }

    }
</script>
