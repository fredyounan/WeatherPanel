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
    public static function getHeatIndexCorrectedTemperaturesByLatitudeInSouthernHemishphere()
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
        
        return $averageTemperatures;
    }
    
    public function top10Latitudes() {
        $averageTemperatures = self::getHeatIndexCorrectedTemperaturesByLatitudeInSouthernHemishphere();
        
        foreach ($averageTemperatures as $latitude => $temperature) {
            $s1[] = '["' . $latitude . '",' . $temperature . ']';
        }
        
        return View::make('latitude')->with(array('temperatures' => array_slice($averageTemperatures, 0, 10, true)));
    }
}