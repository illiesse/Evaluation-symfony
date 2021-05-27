# FRAMEWORK PHP EVALUATION

The purpose is to develop a web application using Symfony.
It will allow you to manage your films and display them by studio, genre, actor.
We can add films, genres or production studios.

## Installation

git clone https://github.com/illiesse/Evaluation-symfony.git

In .env, you must configure your database version.

To create the database schema with fake datas :
    * symfony console doctrine:database:create
    * symfony console make:migration
    * symfony console doctrine:migrations:migrate
    * symfony console doctrine:fixtures:load

With symfony server:start -d, you can go on the localhost indicated.

You can choose to connect as:
    * admin => email : admin@admin.fr ; password : adminadmin
    * user => email : user@user.fr ; password : useruser

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)