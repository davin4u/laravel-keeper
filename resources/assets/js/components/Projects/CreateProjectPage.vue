<template>
    <div
            class="relative"
            :class="{
                'h-64': loading
            }"
    >
        <Error v-if="error">{{ error }}</Error>

        <Loading v-if="loading"></Loading>

        <form role="form" method="POST" :action="route('projects.store')">
            <FormInput v-model="form.name"
                       :name="'name'"
                       :type="'text'"
                       :placeholder="'Project name'"
                       :error="form.errors.name"
            ></FormInput>

            <FormInput v-model="form.url"
                       :name="'url'"
                       :type="'text'"
                       :placeholder="'URL'"
                       :error="form.errors.url"
            ></FormInput>

            <div>
                <PrimaryButton @click.native.prevent="create">Create</PrimaryButton>
            </div>
        </form>
    </div>
</template>

<script>
    import Loading from "../Layout/Loading";
    import FormInput from "../Layout/Form/FormInput";
    import Error from "../Layout/Error";
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";

    export default {
        name: "CreateProjectPage",

        components: {PrimaryButton, Error, FormInput, Loading},

        data() {
            return {
                loading: false,

                error: '',

                form: {
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
            create() {
                this.loading = true;

                let data = {
                    name: this.form.name,
                    url: this.form.url
                };

                this.http().post(this.route('projects.store'), data)
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
            }
        },

        watch: {
            'form.name': function () {
                this.form.errors.name = '';
            },
            'form.url': function () {
                this.form.errors.url = '';
            }
        }
    }
</script>
