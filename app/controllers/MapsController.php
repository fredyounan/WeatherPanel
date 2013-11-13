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
            $s1[] = '["' . $data[2] . '",' . $data[10] . ']';
			}
        }
		
		
		
		return View::make('graph')->with(array('graphName' => 'Temperature for ' . $result[0]->name, 's1' => implode(', ', $s1)));
	}
	
    public function runMaps() 
    {
		$data = DB::select("SELECT stations.name, stations.stn, stations.longitude, stations.latitude FROM stations 
		WHERE stn IN (655360, 642100, 627720, 621760, 671970, 681100, 646500, 636120, 600010, 684240);");
		
		 $ts = strtotime(date('Y-m-d'));
    $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
    $o = array(date('Y-m-d', $start),
                 date('Y-m-d', strtotime('next saturday', $start)));
				
				
				
				 
		$stations = array();		 
		$parse = new Parse();		 
				 
		foreach($data as $value)
		{
			
			$stations[] = $parse->parseFile((string)$value->stn . ".txt");
		}
		
		var_dump($stations);
		
		//return View::make('maps')->with(array('o' => json_encode($data)));
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