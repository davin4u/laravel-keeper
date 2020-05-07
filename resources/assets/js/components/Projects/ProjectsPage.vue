<template>
    <div>
        <div class="w-full mb-2">
            <div class="flex border-b border-gray-300">
                <div class="p-2 w-1/3 font-bold">Project name</div>

                <div class="p-2 w-2/3 font-bold">URL</div>
            </div>

            <div v-for="project in projects" class="flex border-b border-gray-300">
                <div class="p-2 w-1/3">{{ project.name }}</div>

                <div class="p-2 w-2/3">
                    <a class="text-gray-600" :href="project.url">{{ project.url }}</a>
                </div>
            </div>
        </div>

        <PrimaryButton @click.native.prevent="create">Add new project</PrimaryButton>
    </div>
</template>

<script>
    import PrimaryButton from "../Layout/Buttons/PrimaryButton";

    export default {
        name: "ProjectsPage",

        components: {PrimaryButton},

        computed: {
            projects() {
                return _.get(this.$store.state.user, ['projects', 'data'], []);
            }
        },

        methods: {
            create() {
                this.$store.commit('changeScreen', 'projects.create');
            }
        }
    }
</script>
