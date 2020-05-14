<template>
    <div class="relative">
        <Error v-if="error">{{ error }}</Error>

        <Loading v-if="loading"></Loading>

        <form role="form" method="POST" :action="route('projects.update')">
            <FormInput v-model="form.name"
                       :name="'name'"
                       :type="'text'"
                       :placeholder="'Project name'"
                       :label="'Project name'"
                       :error="form.errors.name"
                       class="mb-4"
            ></FormInput>

            <FormInput v-model="form.url"
                       :name="'url'"
                       :type="'text'"
                       :placeholder="'URL'"
                       :label="'Project URL address'"
                       :error="form.errors.url"
                       class="mb-4"
            ></FormInput>

            <div>
                <PrimaryButton @click.native.prevent="save">Save</PrimaryButton>

                <DangerButton @click.native.prevent="cancel">Cancel</DangerButton>
            </div>
        </form>
    </div>
</template>

<script>
    import Error from "../Layout/Error";
    import Loading from "../Layout/Loading";
    import FormInput from "../Layout/Form/FormInput";
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";
    import DangerButton from "../Layout/Buttons/DangerButton";
    import {user} from "../../mixins/user";

    export default {
        name: "EditProjectPage",

        components: {DangerButton, PrimaryButton, FormInput, Loading, Error},

        props: ['options'],

        mixins: [user],

        data() {
            return {
                loading: false,

                error: '',

                form: {
                    id: '',
                    name: '',
                    url: '',
                    errors: {
                        name: '',
                        url: ''
                    }
                }
            }
        },

        methods: {
            save() {
                this.loading = true;

                let data = {
                    name: this.form.name,
                    url: this.form.url
                };

                this.http().post(this.route('projects.update', {id: this.form.id}), data)
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
                    this.$store.commit('changeScreen', 'projects');
                }
            },

            processErrors(errors) {
                let fields = ['name', 'url'];

                for (let key in fields) {
                    if (!errors.hasOwnProperty(fields[key])) {
                        this.form.errors[fields[key]] = '';

                        continue;
                    }

                    this.form.errors[fields[key]] = errors[fields[key]][0] || '';
                }
            },

            cancel() {
                this.$store.commit('changeScreen', 'projects');
            }
        },

        mounted() {
            let id = _.get(this.options, ['id'], null);

            if (_.isNull(id)) {
                this.error = 'Something went wrong. Please contact our support.';

                return;
            }

            let project = this.user().getProjectById(parseInt(id));

            if (_.isNull(project)) {
                this.error = "It seems you are trying to edit a project which does not exist in your projects list.";

                return;
            }

            this.form.id = _.get(project, ['id']);
            this.form.name = _.get(project, ['name']);
            this.form.url = _.get(project, ['url']);
        }
    }
</script>
