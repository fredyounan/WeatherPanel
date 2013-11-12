<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

use Helpers\Variables;

Route::get('/', /*array('before' => 'auth'*, */function()
{
    $warmsteTemps = DB::select("SELECT stations.name, AVG( temp ) as average 
FROM  `measurements` 
LEFT OUTER JOIN stations
USING (  `stn` ) 
WHERE stations.country =  'MALAYSIA'
GROUP BY measurements.stn
LIMIT 0 , 30");

    $ticks = array();
    $s1 = array();

    foreach ($warmsteTemps as $temp => $data) { 
        $ticks[] = $data->name;
        $s1[] = $data->average;
    }
		/*$c = new Variables();
        $content = array('toHeatIndex' => $c->toHeatIndex(60, 50), 'getAtmosphere' => $c->getAtmosphere(1033.4));
		echo $c->toHeatIndex(60, 50);
		echo $c->getAtmosphere(1033.4);*/
		return View::make('main')->with(array('ticks' => implode("', '", $ticks), 's1' => implode(', ', $s1)));
});//);


Route::post('login', function()
{
   if (Auth::attempt( array('username' => Input::get('username'), 'password' => Input::get('password'))))
   {
	   return Redirect::to('/');
   }
	
});

//Route::get('/', 'MainController@ShowMain');
Route::get('login', function()
{
    return View::make('login');
});

