<?php

use Helpers\Variables;

class MainController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showMain()
	{
		$c = new Variables();
		echo $c->toHeatIndex(60, 50);
		echo $c->getAtmosphere(1033.4);
		//return View::make('main');
		
	}

}