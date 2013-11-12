<?php
use Helpers\Variables;

class MapsController extends BaseController 
{
    public function runMaps() 
    {
		$data = DB::select("SELECT DISTINCT measurements.visib, stations.name, stations.longitude, stations.latitude FROM measurements, stations 
		WHERE measurements.stn = stations.stn 
		AND stations.latitude >= -45 
		AND stations.latitude <= 30 
		AND stations.longitude >= -20 
		AND stations.longitude <= 50;");
		
		return View::make('maps')->with(array('o' => json_encode($data)));
    }
}