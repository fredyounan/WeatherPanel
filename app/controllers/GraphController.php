<?php
use Helpers\Variables;

class GraphController extends BaseController 
{
    public function viewAverageMalaysianGraph() 
    {
        $warmsteTemps = DB::select("
            SELECT stations.name, AVG( temp ) as average 
            FROM  `measurements` 
            LEFT OUTER JOIN stations
            USING (`stn` ) 
            WHERE stations.country =  'MALAYSIA'
            GROUP BY measurements.stn
            LIMIT 0 , 30
        ");

        $ticks = array();
        $s1 = array();

        foreach ($warmsteTemps as $temp => $data) { 
            $ticks[] = $data->name;
            $s1[] = $data->average;
        }

		/*$c = new Variables();
        $content = array('toHeatIndex' => $c->toHeatIndex(60, 50), 'getAtmosphere' => $c->getAtmosphere(1033.4));
		echo $c->toHeatIndex(60, 50);
		echo $c->getAtmosphere(1033.4);*/
		return View::make('graph')->with(array('ticks' => implode("', '", $ticks), 's1' => implode(', ', $s1)));
    }
}