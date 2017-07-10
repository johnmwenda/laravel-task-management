## Task Management App ##
This web application allows supervisors and their juniors to easily collaborate in managing their day to day tasks

### How to setup on server ###
- clone the repository
- run *composer install*

### How to setup for local development ###
- clone the repository
- run *composer install*
- Install NodeJS
- Install Gulp globally by running - npm install -g gulp
- run *gulp && gulp watch* - this will create a local server on port localhost:3000. Ensure Laravel development server is running so as to enable API calls to the server

### Seeding database ###
- Run php artisan migrate --seed to migrate the database tables and seed some information

### Demo ###
Seeding the database with the above command will create the following users and respective roles
1. Alice Kiprop - alice@gmail.com - role "department head"

CUSTOM README
remove testing suite from package.json... used for FrontEnd testing.. i dont think i will use it for now
"phantomjs-prebuilt": "^2.1.6",
"karma": "^0.13.22",
"karma-babel-preprocessor": "~4.0.0",
"karma-browserify": "^4.0.0",
"karma-chrome-launcher": "^0.2.3",
"karma-jasmine": "^0.3.8",
"karma-ngannotate-preprocessor": "^0.1.2",
"karma-phantomjs-launcher": "^1.0.0",
"laravel-elixir-karma": "^0.2.2",

the backend only does API. Attached please find the API Spec