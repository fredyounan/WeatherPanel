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

Route::group(array('before' => 'auth'), function()
{
    Route::get('data/malaysia', 'GraphController@viewAverageMalaysianGraph');
    
    Route::get('/', 'DashboardController@viewDashboard');
});

Route::get('login', 'AuthController@viewLogin');
Route::post('login', 'AuthController@doLogin');
Route::get('data/africa', 'MapsController@runMaps');
Route::get('data/africa/{stn}', 'MapsController@getData');
Route::get('data/world', 'MapsController@runWorld');
Route::get('data/world/{stn}', 'MapsController@getWorldStation');

Route::get('logout', 'AuthController@doLogout');


/*Route::group(array('before' => 'auth', function()
{
    Route::get('data/malaysia', function()
    {
        $warmsteTemps = DB::select("
            SELECT stations.name, AVG( temp ) as average 
            FROM  `measurements` 
            LEFT OUTER JOIN stations
            USING (`stn` ) 
            WHERE stations.country =  'MALAYSIA'
            GROUP BY measurements.stn
            LIMIT 0 , 30
        ");

        $ticks = array();
        $s1 = array();

        foreach ($warmsteTemps as $temp => $data) { 
            $ticks[] = $data->name;
            $s1[] = $data->average;
        }*/

		/*$c = new Variables();
        $content = array('toHeatIndex' => $c->toHeatIndex(60, 50), 'getAtmosphere' => $c->getAtmosphere(1033.4));
		echo $c->toHeatIndex(60, 50);
		echo $c->getAtmosphere(1033.4);*/
		/*return View::make('graph')->with(array('ticks' => implode("', '", $ticks), 's1' => implode(', ', $s1)));
    });
    
    Route::get('/', function()
    {
        return View::make('dashboard');
    });
}));

Route::post('login', function()
{
    if (Auth::attempt( array('username' => Input::get('username'), 'password' => Input::get('password'))))
    {
	   return Redirect::to('/');
    }
});

Route::get('login', function() 
{
    if (Auth::check()) 
    {
        return Redirect::to('/');
    }
    
    return View::make('login');
});*/