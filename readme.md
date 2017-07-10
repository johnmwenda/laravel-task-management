## Task Management App ##
This web application allows supervisors and their juniors to easily collaborate in managing their day to day tasks

### How to setup on server ###
- clone the repository
- run *composer install*

### How to setup for local development ###
- clone the repository
- run *composer install*
- Install NodeJS
- Install Gulp globally by running - *npm install -g gulp*
- run *gulp && gulp watch* - this will create a local server on port localhost:3000. Ensure Laravel development server is running so as to enable API calls to the server

### Seeding database ###
- Run *php artisan migrate --seed* to migrate the database tables and seed some information

### Demo ###
Seeding the database with the above command will create the following users and respective roles

1. Alice Kiprop - alice@gmail.com - role "department head"
1. Brenda Wambui - brenda@gmail.com - role "normal"
1. Victor Macharia - victor@gmail.com - role "normal"

### API Spec ###
The entire back end is completely API Based. You will see the API Specification file in this folder, called ApiSpec.json