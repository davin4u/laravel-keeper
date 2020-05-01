export const routex = {
    methods: {
        route(route, props) {
            props = props || {};

            if (! _.isUndefined(window.routes[route])) {
                let url = window.routes[route];

                for (let key in props) {
                    if (props.hasOwnProperty(key)) {
                        url = url.replace('{' + key + '}', props[key]);
                    }
                }

                return url;
            }

            return '';
        },

        isRoute(route, props, lang) {
            let url = this.routex(route, props, lang);

            return window.document.location.href.indexOf(url) !== -1;
        },

        routeHas(part) {
            return window.document.location.href.indexOf(part) !== -1;
        }
    }
};