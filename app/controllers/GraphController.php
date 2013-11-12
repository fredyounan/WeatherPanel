<?php
use Helpers\Variables;

/*
WNDDIR
SLP
TIME
CLDC
DEWP
PRCP
DATE
WDSP
SNDP
VISIB
TEMP = 10
STN
FRSHTT
STP
*/

class GraphController extends BaseController {
    public function viewAverageMalaysianGraph() 
    {
        $today = date('Y-m-d');
        
        $malaysianStations = Station::where('country', '=', 'MALAYSIA')->lists('stn', 'name');
        $averageTemperatures = array();
        
        foreach ($malaysianStations as $stationName => $station) {
            $measurements = Parse::parseFile($station . '.txt');
            
            // Lege bestanden overslaan
            if (empty($measurements)) continue;
            
            $totalTemperature = 0;
            $measurementCount = 0;
            
            foreach ($measurements as $measurement) {
                if ($measurement[6] != $today) continue; 
                
                $measurementCount++;
                $totalTemperature += $measurement[10];
            }
            
            $averageTemperatures[$stationName] = ($totalTemperature / $measurementCount);
        }
        
		arsort($averageTemperatures);
        var_dump($averageTemperatures);
        /*$warmsteTemps = DB::select("
            SELECT stations.name, measurements.date, AVG( temp ) as average 
            FROM  `measurements` 
            LEFT OUTER JOIN stations
            USING (`stn` ) 
            WHERE stations.country =  'MALAYSIA'
            GROUP BY measurements.stn, measurements.date
            ORDER BY average desc
            LIMIT 0, 30
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
		//return View::make('graph')->with(array('graphName' => 'Average temperatures per city &raquo; Malaysia', 'ticks' => implode("', '", $ticks), 's1' => implode(', ', $s1)));
    }
}