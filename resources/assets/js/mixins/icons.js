import SearchGlassIcon from "../components/Icons/SearchGlassIcon";
import UserIcon from "../components/Icons/UserIcon";
import LockerClosedIcon from "../components/Icons/LockerClosedIcon";

export const icons = {
    methods: {
        getIconComponent(name) {
            switch (name) {
                case 'SearchGlassIcon':
                    return SearchGlassIcon;

                case 'UserIcon':
                    return UserIcon;

                case 'LockerClosedIcon':
                    return LockerClosedIcon;

                default:
                    return null;
            }
        }
    }
};