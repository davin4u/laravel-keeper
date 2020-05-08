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
}