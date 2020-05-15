<template>
    <div class="container h-full mx-auto">
        <AppHeader></AppHeader>

        <div class="flex w-full h-full">
            <div class="w-1/4">
                <AppSideMenu></AppSideMenu>
            </div>

            <div class="w-3/4">
                <AppContentSection></AppContentSection>
            </div>
        </div>
    </div>
</template>

<script>
    import Panel from "./Layout/Panel";
    import AppHeader from "./AppHeader";
    import AppSideMenu from "./AppSideMenu";
    import AppContentSection from "./AppContentSection";
    import {user} from "../mixins/user";

    export default {
        name: "App",

        components: {AppContentSection, AppSideMenu, AppHeader, Panel},

        mixins: [user],

        mounted() {
            // set side menu items
            let data = {
                sideMenuItems: [
                    {name: 'Dashboard', screen: 'dashboard', icon: 'DashboardIcon'},
                    {name: 'Projects', screen: 'projects', icon: 'ProjectsIcon'},
                    {name: 'Passwords', screen: 'passwords', icon: 'LockerClosedIcon'}
                ]
            };

            let userGroups = this.user().getPasswordGroups();

            if (userGroups.length > 0) {
                for (let key in userGroups) {
                    let passwordGroup = userGroups[key];

                    data.sideMenuItems.push({
                        name: passwordGroup.name,
                        screen: 'passwords#password-group:' + passwordGroup.id,
                        icon: passwordGroup.icon || 'FolderIcon'
                    });
                }
            }

            this.$store.commit('updatePageData', data);

            // set current screen
            this.$store.commit('changeScreen', 'dashboard');
        }
    }
</script>

<style>
    @media (min-width: 1280px) {
        .container {
            width: 1170px;
        }
    }
    
    @media (max-width: 900px) {
        .container {
            width: 100%;
        }
    }
</style>
