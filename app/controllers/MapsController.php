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

		$test = array();
		
		foreach($arr as $key => $value)
		{
			if (!array_key_exists($value[6], $test))
			{
				$test[$value[6]][0] = (float)$value[9];
				$test[$value[6]][1] = 0;
			}
			else
			{
				$test[$value[6]][0] += (float)$value[9];
				$test[$value[6]][1]++;
				
			}		
		}
		
		var_dump($test);
		
		echo $test["2013-11-12"][0] / $test["2013-11-12"][1];
		
		//return View::make('data')->with(array('name' => $result[0]->name));
	}
}