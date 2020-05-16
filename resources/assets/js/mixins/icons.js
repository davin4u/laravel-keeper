import SearchGlassIcon from "../components/Icons/SearchGlassIcon";
import UserIcon from "../components/Icons/UserIcon";
import LockerClosedIcon from "../components/Icons/LockerClosedIcon";
import DashboardIcon from "../components/Icons/DashboardIcon";
import FolderIcon from "../components/Icons/FolderIcon";
import ProjectsIcon from "../components/Icons/ProjectsIcon";
import CogIcon from "../components/Icons/CogIcon";

export const icons = {
    data() {
        return {
            appIconsList: [
                'SearchGlassIcon', 'UserIcon', 'LockerClosedIcon', 'DashboardIcon',
                'FolderIcon', 'ProjectsIcon', 'CogIcon'
            ]
        }
    },

    methods: {
        getIconComponent(name) {
            switch (name) {
                case 'SearchGlassIcon':
                    return SearchGlassIcon;

                case 'UserIcon':
                    return UserIcon;

                case 'LockerClosedIcon':
                    return LockerClosedIcon;

                case 'DashboardIcon':
                    return DashboardIcon;

                case 'FolderIcon':
                    return FolderIcon;

                case 'ProjectsIcon':
                    return ProjectsIcon;

                case 'CogIcon':
                    return CogIcon;

                default:
                    return null;
            }
        },

        getAppIcons() {
            return this.appIconsList;
        }
    }
};