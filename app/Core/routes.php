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

/* User */
Router::any('users', 'Controllers\User@index');
Router::post('users/add', 'Controllers\User@add');
Router::post('users/edit', 'Controllers\User@edit');
Router::post('users/delete', 'Controllers\User@delete');

/* Management */
Router::any('management', 'Controllers\Management@index');
Router::any('management/leaveRequests', 'Controllers\Management@leaveRequests');


/* Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');

/* If no route found. */
Router::error('Core\Error@index');

/* Turn on old style routing. */
Router::$fallback = false;

/* Execute matched routes. */
Router::dispatch();
