# Laravel passwords manager

Own-hosted passwords manager for those who don't want to keep passwords in cloud platforms.
Developed using Laravel, Vue.js and Tailwind.

## Features
* Ability to create a project
* Ability to create a group
* Password can be attached to project/group
* Group icons
* Easy "copy" button for meaningful things like username, password or project url

## Installation

```
1. git clone https://github.com/davin4u/laravel-keeper.git .
2. composer install
3. configure database connection in .env (if .env doesn't exist run this: cp .env.example .env)
4. php artisan key:generate
5. php artisan migrate
6. npm install
7. npm run production
```

Most probably that is enough but feel free to create issues if something went wrong :)

## Some screenshots
![Main screen](https://i.imgur.com/15DrViS.png)

![Password details](https://i.imgur.com/vD79wDF.png)

![Create new password](https://i.imgur.com/6yF9iSY.png)

## What is next?
* Easy installation with docker
* Environment for teams
* Passwords sharing
* More icons
* Password generation
* Password strength check
* Reminders to change a password
* Preload domain favicons
* Password tags (ssh/admin/ftp/github ... something else)