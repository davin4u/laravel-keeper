<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <Panel class="ml-4 h-full">
        <template v-slot:header>
            {{ currentScreenTitle }}
        </template>

        <template v-slot:body>
            <component :is="currentScreenComponent" :options="componentOptions"></component>
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
    import EditPasswordPage from "./Passwords/EditPasswordPage";
    import EditProjectPage from "./Projects/EditProjectPage";

    export default {
        name: "AppContentSection",

        components: {Panel},

        computed: {
            currentScreenComponent() {
                let screenState = this.$store.state.screen || '';

                if (screenState.indexOf('#') !== -1) {
                    screenState = screenState.split('#')[0];
                }

                switch (screenState) {
                    case 'dashboard': return DashboardPage;

                    // passwords
                    case 'passwords': return PasswordsPage;
                    case 'passwords.create': return CreatePasswordPage;
                    case 'passwords.edit': return EditPasswordPage;

                    // projects
                    case 'projects': return ProjectsPage;
                    case 'projects.create': return CreateProjectPage;
                    case 'projects.edit': return EditProjectPage;

                    default: return null;
                }
            },

            componentOptions() {
                let screenState = this.$store.state.screen || '';

                if (screenState.indexOf('#') !== -1) {
                     let optionsString = screenState.split('#')[1] || '';

                     if (optionsString.indexOf(':') !== -1) {
                         let options = {};
                         let parsed = optionsString.split(':');

                         options[parsed[0]] = parsed[1];

                         return options;
                     }
                }

                return {};
            },

            currentScreenTitle() {
                let screenState = this.$store.state.screen || '';

                if (screenState.indexOf('#') !== -1) {
                    screenState = screenState.split('#')[0];
                }

                switch (screenState) {
                    case 'dashboard': return 'Dashboard';

                    // passwords
                    case 'passwords': return 'Passwords';
                    case 'passwords.create': return 'Create new password';
                    case 'passwords.edit': return 'Edit password';

                    // projects
                    case 'projects': return 'Projects';
                    case 'projects.create': return 'Create new project';
                    case 'projects.edit': return 'Edit project';

                    default: return null;
                }
            }
        },
    }
</script>
