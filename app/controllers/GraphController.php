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
    public function top10Latitudes() 
    {
        $today = date('Y-m-d');
        
        $southernHemisphereStations = Station::
            where('latitude', '<=', 0)
            ->where('latitude', '>=', -90)
            ->where('longitude', '>=', -180)
            ->where('longitude', '<=', 180)
            ->get();
            
        
        $totalTemperatures = array();
        $totalDewp = array();
        $lengthTemperatures = array();
        
        foreach ($southernHemisphereStations as $pos => $station) {
            $measurements = Parse::parseFile($station->stn . '.txt');
            
            // Lege bestanden overslaan
            if (empty($measurements)) continue;
            
            if (! isset($totalTemperatures[$station->latitude])) {
                $totalTemperatures[$station->latitude] = 0;
                $totalDewp[$station->latitude] = 0;
                $lengthTemperatures[$station->latitude] = 0;
            }
            
            foreach ($measurements as $measurement) {
                if ($measurement[6] != $today) continue; 
                
                $totalTemperatures[$station->latitude] += $measurement[10];
                $totalDewp[$station->latitude] += $measurement[4];
                $lengthTemperatures[$station->latitude]++;
            }
        }
        
        $averageTemperatures = array();
        
        $c = new Variables();
        
		foreach ($totalTemperatures as $latitude => $temperature) {
            $length = $lengthTemperatures[$latitude];
            $averageTemperatures[$latitude] = $c->toHeatIndex($temperature / $length, $totalDewp[$latitude] / $length);
        }
        
        arsort($averageTemperatures);
        
        $limit = 10;
        
        foreach ($averageTemperatures as $latitude => $temperature) {
            $s1[] = '["' . $latitude . '",' . $temperature . ']';
        }
        
        return View::make('latitude')->with(array('temperatures' => array_slice($averageTemperatures, 0, 10, true)));
        
        
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