<template>
    <div>
        <div class="w-full mb-2">
            <div class="flex border-b border-gray-300">
                <div class="p-2 w-1/4 font-bold">Project name</div>

                <div class="p-2 w-2/4 font-bold">URL</div>

                <div class="p-2 w-1/4"></div>
            </div>

            <div v-for="project in projects" class="flex border-b border-gray-300">
                <div class="p-2 w-1/4">{{ project.name }}</div>

                <div class="p-2 w-2/4">
                    <a class="text-gray-600" :href="project.url">{{ project.url }}</a>
                </div>

                <div class="p-2 w-1/4">
                    <PrimaryButton @click.native.prevent="edit(project)" size="sm">edit</PrimaryButton>

                    <DangerButton @click.native.prevent="deleteProject(project)" size="sm">delete</DangerButton>
                </div>
            </div>
        </div>

        <PrimaryButton @click.native.prevent="create">Add new project</PrimaryButton>

        <ConfirmationModal
                v-if="deleting"
                @confirm="confirmProjectDelete"
                @cancel="deleting = null"
        >
            <p class="text-xl text-red-600">WARNING</p>
            <p>You are going to delete the project</p>
            <p><span class="text-red-600">ALL</span> passwords attached to this project will be removed as well.</p>
            <p>Are you sure?</p>
        </ConfirmationModal>
    </div>
</template>

<script>
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";
    import {user} from "../../mixins/user";
    import DangerButton from "../Layout/Buttons/DangerButton";
    import ConfirmationModal from "../Layout/Modal/ConfirmationModal";

    export default {
        name: "ProjectsPage",

        components: {ConfirmationModal, DangerButton, PrimaryButton},

        mixins: [user],

        data() {
            return {
                error: '',

                deleting: null
            }
        },

        computed: {
            projects() {
                return this.user().getProjects();
            }
        },

        methods: {
            create() {
                this.$store.commit('changeScreen', 'projects.create');
            },

            edit(project) {
                this.$store.commit('changeScreen', 'projects.edit#id:' + project.id);
            },

            deleteProject(project) {
                this.deleting = project;
            },

            confirmProjectDelete() {
                if (!this.deleting) {
                    return;
                }

                this.http().post(this.route('projects.delete', {id: this.deleting.id}))
                    .then((response) => {
                        this.deleting = null;

                        this.processResponse(response);
                    })
                    .catch(() => {
                        this.deleting = null;

                        this.error = 'Something went wrong. Please contact our support.';
                    });
            },

            processResponse(response) {
                if (!_.isUndefined(response.user) && response.success === true) {
                    this.$store.commit('setUser', response.user);
                }
                else if (!_.isUndefined(response.error)) {
                    this.error = response.error;
                }
                else {
                    this.error = 'Something went wrong. Please contact our support.';
                }
            }
        }
    }
</script>
