<?php
/**
 * Routes - all standard routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 *
 * @version 2.2
 * @date updated Sept 19, 2015
 */

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;

/* Define routes. */
/* Leave */
Router::post('leave', 'Controllers\Leave@addLeave');
Router::any('leave', 'Controllers\Leave@index');

/* Authentication */
Router::any('', 'Controllers\Authentication@index');
Router::post('authentication/login', 'Controllers\Authentication@login');
Router::any('authentication/logout', 'Controllers\Authentication@logout');

/* Hours */
Router::any('hours', 'Controllers\Hours@index');
Router::any('hours/registration', 'Controllers\Hours@registration');
Router::any('hours/overview', 'Controllers\Hours@overview');
Router::post('hours/submit', 'Controllers\Hours@submit');

/* User */
Router::any('users', 'Controllers\User@index');
Router::post('users/add', 'Controllers\User@add');
Router::post('users/edit', 'Controllers\User@edit');
Router::post('users/delete', 'Controllers\User@delete');
Router::post('users/getusers', 'Controllers\User@getUsers');
Router::post('users/getroles', 'Controllers\User@getRoles');

/* Management */
Router::any('management', 'Controllers\Management@index');
Router::any('management/leaveRequests', 'Controllers\Management@leaveRequests');
Router::post('management/updateLeave', 'Controllers\Management@updateLeave');

/* Employee */
Router::any('employees', 'Controllers\Employee@index');
Router::post('employees/getemployees', 'Controllers\Employee@getEmployees');
Router::post('employees/getusers', 'Controllers\Employee@getUsers');
Router::post('employees/getstates', 'Controllers\Employee@getStates');
Router::post('employees/getdepartments', 'Controllers\Employee@getDepartments');
Router::post('employees/add', 'Controllers\Employee@add');
Router::post('employees/edit', 'Controllers\Employee@edit');
Router::post('employees/delete', 'Controllers\Employee@delete');

/* Holidays */
Router::any('holidays', 'Controllers\Holiday@index');
Router::any('holidays/getholidays', 'Controllers\Holiday@getHolidays');
Router::post('holidays/add', 'Controllers\Holiday@add');
Router::post('holidays/delete', 'Controllers\Holiday@delete');
Router::post('holidays/edit', 'Controllers\Holiday@update');

/* Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');

/* If no route found. */
Router::error('Core\Error@index');

/* Turn on old style routing. */
Router::$fallback = false;

/* Execute matched routes. */
Router::dispatch();
