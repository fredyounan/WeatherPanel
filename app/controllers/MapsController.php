<?php
use Helpers\Variables;

class MapsController extends BaseController 
{
	public function runWorld()
	{
		$data = DB::select("SELECT stations.name, stations.stn, stations.longitude, stations.latitude FROM stations");
		
		return View::make('worldmap')->with(array('o' => json_encode($data)));
	}
	
	public static function getWorldStation($stn, $asXml = false)
	{
		$result = DB::select("SELECT name FROM stations WHERE stn = ?", array($stn));
		
        if (empty($result)) {
            return App::abort(404, 'Page not found');
        }
        
		$o = new Parse();
		$arr = $o->parseFile((string)$stn . '.txt');
		
        if (empty($arr)) {
            return View::make('graph')->with(array('graphName' => 'Temperature for ' . $result[0]->name, 's1' => false));
        }
        
		$s1 = array();
        $xmlReady = array('station' => array('stn' => $stn, 'temperatures' => array()));

        foreach ($arr as $data) {
            if ($data[6] == date('Y-m-d')) {
                $s1[] = '["' . $data[2] . '",' . $data[10] . ']';
                
                $xmlReady['station']['temperatures'][] = array('date' => $data[2] . ' ' . $data[6], 'value' => $data[10]);
			}
        }
        
        if ($asXml) {
            return $xmlReady;
        }
		
		return View::make('graph')->with(array('stn' => $stn, 'graphName' => 'Temperature for ' . $result[0]->name, 's1' => implode(', ', $s1)));
	}
	
    public static function runMaps($getXml = false) 
    {
		$data = DB::select("
            SELECT stations.name, stations.stn, stations.longitude, stations.latitude 
            FROM stations 
            WHERE stn IN 
                (655360, 642100, 627720, 621760, 671970, 681100, 646500, 636120, 600010, 684240)
        ");
		
		$ts = strtotime(date('Y-m-d'));
        $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
        $o = array(date('Y-m-d', $start), date('Y-m-d', strtotime('next saturday', $start)));
				
		$stations = array();		 
		$parse = new Parse();

        $xmlReady = array('stations' => array());
				 
		foreach($data as $value)
		{
			$stations[$value->stn] = $parse->parseFile((string) $value->stn . ".txt");
		}
		
		$helper = new Variables();
		$dates = $helper->dateRange($o[0], $o[1]);
		
		$count = 0;
		$visibility = 0;
		
        $xmlData = array();
        
		foreach($stations as $stationID => $set)
		{
            $xmlData = array('stn' => $stationID, 'visibilities' => array());
			
            foreach($set as $measurement)
			{
				if (in_array($measurement[6], $dates))
				{
					$count++;
					$visibility += $measurement[9];
                    
                    $xmlData['visibilities'][] = $measurement[9];
				}
			}
            
            if (! empty($xmlData['visibilities'])) {
                $xmlReady['stations'][] = $xmlData;
            }
		}
		
        if ($getXml) {
            return $xmlReady;
        }
        
		return View::make('maps')->with(array('o' => json_encode($data), 'date1' => $o[0], 'date2' => $o[1], 'visib' => number_format($visibility / $count, 2)));
    }
}