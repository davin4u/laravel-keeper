<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <Panel class="ml-4 h-full">
        <template v-slot:header>
            {{ currentScreenTitle }}
        </template>

        <template v-slot:body>
            <component :is="currentScreenComponent"></component>
        </template>
    </Panel>
</template>

<script>
    import Panel from "./Layout/Panel";
    import DashboardPage from "./Dashboard/DashboardPage";
    import CreatePasswordPage from "./Passwords/CreatePasswordPage";
    import ProjectsPage from "./Projects/ProjectsPage";
    import CreateProjectPage from "./Projects/CreateProjectPage";
    import PasswordsPage from "./Passwords/PasswordsPage";

    export default {
        name: "AppContentSection",

        components: {Panel},

        computed: {
            currentScreenComponent() {
                switch (this.$store.state.screen) {
                    case 'dashboard': return DashboardPage;

                    // passwords
                    case 'passwords': return PasswordsPage;
                    case 'passwords.create': return CreatePasswordPage;

                    // projects
                    case 'projects': return ProjectsPage;
                    case 'projects.create': return CreateProjectPage;

                    default: return null;
                }
            },

            currentScreenTitle() {
                switch (this.$store.state.screen) {
                    case 'dashboard': return 'Dashboard';

                    // passwords
                    case 'passwords': return 'Passwords';
                    case 'passwords.create': return 'Create new password';

                    // projects
                    case 'projects': return 'Projects';
                    case 'projects.create': return 'Create new project';

                    default: return null;
                }
            }
        },
    }
</script>
