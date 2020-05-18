export const routes = {
    'auth.restore_password': '/password/restore',
    'auth.register': '/register',
    'auth.login': '/login',

    //password groups
    'password_groups.store': '/password-groups/store',
    'password_groups.update': '/password-groups/{id}/update',
    'password_groups.delete': '/password-groups/{id}/delete',

    //projects
    'projects.store': '/projects/store',
    'projects.delete': '/projects/{id}/delete',
    'projects.update': '/projects/{id}/update',

    //passwords
    'passwords.create': '/passwords/create',
    'passwords.store': '/passwords/store',
    'passwords.get': '/passwords/{id}',
    'passwords.update': '/passwords/{id}/update',
    'passwords.delete': '/passwords/{id}/delete'
};