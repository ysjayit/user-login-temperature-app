### User Login Temperature Management Application

This application is used to monitor the temperatures of different cities when the user is logged on to the system.

**Technologies**
- Laravel Framework 8.83.20
- SQLite Database
- Vue.js
- Open Weather API

**Packages and Libraries**
- Laravel Breeze
- Inertia.js

**Features**
- User registration
- User login
- View users login temperature history
- Order temperature history from hottest to cold
- Reset the temperature history to default

**Implementation and Concepts**
- For the frontend, Vue.js combined with Inertia.js and Tailwind CSS used. Inertia.js supports single-page applications (SPAs) using classic server-side routing and controllers. Also it's combined with Laravel Breeze Vue.js setup.
- Temperature related methods like get wheather details from API, temperature conversions are implemented in a dedicated trait for them in order to achieve reusability of methods freely in several independent classes living in different class hierarchies.
- Laravel repository pattern is used achieve abstraction and make the code robust to changes.
- Seperate configuration file included for the temperature related configurations.

**Installation**
- Clone the repository
- Composer install `composer install`
- Copy `.env.example` and change the to `.env`
- Create a sqlite file (Ex: database.sqlite) inside the /database folder in the application.
- Configure the environment settings of database and temperature in above `.env` file.

`DB_CONNECTION=sqlite`
`DB_DATABASE=/absolute/path/to/database.sqlite`

In order to locally use **sqlite** as database, configure `DB_DATABASE` with absolute path to sqlite file created previously.

Also configure the below temperature related parameters.

`NO_OF_CITIES= < Number of cities to capture wheather details >`
`CITY_1={"name":"< Name of the city >","lat":< Latitude of the city >,"lon":< Longitude of the city >}`
`CITY_2={"name":"< Name of the city >","lat":< Latitude of the city >,"lon":< Longitude of the city >}`
`OPENWEATHERMAP_API_Key=< API Key for OpenWeatherMap >`

- Set the application key `php artisan key:generate`
- Run migration `php artisan migrate`
- Run `npm install`
- Run application `php artisan serve`
- Run `npm run dev` or `npm run watch` in a seperate console.

**OpenWeatherMap**
- Documentation for OpenWeatherMap : https://openweathermap.org/api/one-call-api

