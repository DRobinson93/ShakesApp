shakes app


//-model -controller -r = resource
php artisan make:model Todo -mc

todo: 
	:write more validation
	:write validation error logic on front end 
	:setup permissions
	:add reactions to tests for relations and make sure reactions exists in return 
	:add sort by rating, newest and such  to home pg (use session)
    : reactions store return just needs success.. not id
    :write tests for /shake/{shake}/reaction/sumTxt
    :redis
    :validate can only delete own shake 
    :allow edit shake ingredients?
git commit -a -m ""
