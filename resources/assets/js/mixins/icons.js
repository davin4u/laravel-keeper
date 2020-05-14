import SearchGlassIcon from "../components/Icons/SearchGlassIcon";

export const icons = {
    methods: {
        getIconComponent(name) {
            switch (name) {
                case 'SearchGlassIcon':
                    return SearchGlassIcon;

                default:
                    return null;
            }
        }
    }
};