<?php
use Helpers\Variables;

class MapsController extends BaseController 
{
    public function runMaps() 
    {
		$data = DB::select("SELECT DISTINCT stations.name, stations.stn, stations.longitude, stations.latitude FROM stations 
		WHERE stations.latitude >= -45 
		AND stations.latitude <= 30 
		AND stations.longitude >= -20 
		AND stations.longitude <= 50;");
		
		return View::make('maps')->with(array('o' => json_encode($data)));
    }
	
	public function getData($stn)
	{
		$result = DB::select("SELECT name FROM stations WHERE stn = ?", array($stn));
		
		$o = new Parse();
		$arr = $o->parseFile((string)$stn . ".txt");
		var_dump($arr);
		
		//return View::make('data')->with(array('name' => $result[0]->name));
	}
}