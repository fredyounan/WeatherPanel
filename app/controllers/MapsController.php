<?php
use Helpers\Variables;

class MapsController extends BaseController 
{
	public function runWorld()
	{
		$data = DB::select("SELECT stations.name, stations.stn, stations.longitude, stations.latitude FROM stations");
		
		return View::make('worldmap')->with(array('o' => json_encode($data)));
	}
	
	public function getWorldStation($stn)
	{
		$result = DB::select("SELECT name FROM stations WHERE stn = ?", array($stn));
		
		$o = new Parse();
		$arr = $o->parseFile((string)$stn . ".txt");
		
		$ticks = array();
        $s1 = array();

       foreach ($arr as $data) {
			if ($data[6] == date('Y-m-d'))
			{
			//echo $data[6] . ' ' . $data[2] . "\n";

            $s1[] = '["' . $data[2] . '",' . $data[10] . ']';
			}
        }
		
		
		
		return View::make('graph')->with(array('graphName' => 'Temperature for ' . $result[0]->name, 's1' => implode(', ', $s1)));
	}
	
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