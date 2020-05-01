export const http = {
    methods: {
        http(callback) {
            let _requestChanged = !_.isUndefined(callback) ? callback : null;

            return {
                _requestChanged: _requestChanged,

                get(url) {
                    if (!_.isNull(this._requestChanged) && !_.isUndefined(this._requestChanged)) {
                        return Promise.race([
                            this.getRequest(url),
                            this._requestChanged()
                        ]);
                    }

                    return fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    }).then(response => response.json())
                },

                getRequest(url) {
                    return fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    }).then(response => response.json())
                },

                post(url, data) {
                    if (!_.isNull(this._requestChanged) && !_.isUndefined(this._requestChanged)) {
                        return Promise.race([
                            this.postRequest(url, data),
                            this._requestChanged
                        ]);
                    }

                    return this.postRequest(url, data);
                },

                postRequest(url, data) {
                    let formData = _.assign({}, data);

                    return fetch(url, {
                        method: 'POST',
                        mode: 'cors',
                        cache: 'no-cache',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        referrer: 'no-referrer',
                        body: JSON.stringify(formData),
                    }).then(response => response.json());
                }
            };
        }
    }
};