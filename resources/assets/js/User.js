export default class User
{
    constructor(user) {
        this.user = user;
    }

    getPasswordGroups() {
        return _.get(this.user, ['password_groups'], []);
    }

    getProjects() {
        return _.get(this.user, ['projects', 'data'], []);
    }

    getPasswords() {
        return _.get(this.user, ['passwords', 'data'], []);
    }

    getProjectById(id) {
        let projects = this.getProjects();

        if (projects.length > 0) {
            for (let k in projects) {
                if (projects[k].id === parseInt(id)) {
                    return projects[k];
                }
            }
        }

        return null;
    }
}