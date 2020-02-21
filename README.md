shakes app using laravel and vue js
-unit tested
-users can log in, create/rate/delete shakes
-eloquent used, relationships used for models
-migrations used for database 
-factories and seeding used
-bootstrap 4 used for css, also custom scss used
-permissions set up using laravel permission v3: https://docs.spatie.be/laravel-permission/v3/introduction/


Commands:
php artisan migrate:fresh --seed
//-model -controller -r = resource
php artisan make:model Todo -mc

todo: 
	:write more validation
	:write validation error logic on front end 
	:setup permissions
	:add reactions to tests for relations
    :write tests for /shake/{shake}/reaction/sumTxt
    :redis
    :allow edit shake ingredients?
    :front end automated testing
git commit -a -m ""
