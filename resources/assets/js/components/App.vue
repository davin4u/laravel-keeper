<template>
    <div class="container h-full mx-auto">
        <AppHeader></AppHeader>

        <div class="flex w-full">
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

    export default {
        name: "App",

        components: {AppContentSection, AppSideMenu, AppHeader, Panel},

        mounted() {
            // set side menu items
            let data = {
                sideMenuItems: [
                    {name: 'Dashboard', screen: 'dashboard'},
                    {name: 'Projects', screen: 'projects'}
                ]
            };

            if (!_.isUndefined(this.$store.state.user) && !_.isUndefined(this.$store.state.user.password_groups)) {
                for (let key in this.$store.state.user.password_groups) {
                    let passwordGroup = this.$store.state.user.password_groups[key];

                    data.sideMenuItems.push({
                        name: passwordGroup.name,
                        screen: 'passwords#password-group:' + passwordGroup.id
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
