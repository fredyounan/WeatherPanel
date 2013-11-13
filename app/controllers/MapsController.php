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
		
		$helper = new Variables();
		$dates = $helper->dateRange($o[0], $o[1]);
		
		$count = 0;
		
		$visibility = 0;
		
		foreach($stations as $set)
		{
			foreach($set as $measurement)
			{
				if (in_array($measurement[6], $dates))
				{
					$count++;
					$visibility += $measurement[9];
				}
			}
		}
		
		return View::make('maps')->with(array('o' => json_encode($data), 'date1' => $o[0], 'date2' => $o[1], 'visib' => number_format($visibility / $count, 2)));
    }
}