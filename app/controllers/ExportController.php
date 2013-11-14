<?php

class ExportController extends BaseController 
{
    public function top10Latitudes() {
        $averageTemperatures = GraphController::getHeatIndexCorrectedTemperaturesByLatitudeInSouthernHemishphere();
        $xmlReady = array('temperatures' => array());
        
        foreach ($averageTemperatures as $latitude => $temperature) {
            $xmlReady['temperatures'][] = array('latitude' => $latitude, 'value' => $temperature);
        }
        
        $response = Response::make(Formatter::make(json_encode($xmlReady), 'json')->to_xml(), 200);
        
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename="top-10-latitudes.xml"');
        $response->header('Content-Transfer-Encoding', 'binary');
        $response->header('Content-Type', 'text/xml');
        
        return $response;
    }
    
    public function africanVisibility() {
        $response = Response::make(Formatter::make(json_encode(MapsController::runMaps(true)), 'json')->to_xml(), 200);
        
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename="african-visibility.xml"');
        $response->header('Content-Transfer-Encoding', 'binary');
        $response->header('Content-Type', 'text/xml');
        
        return $response;
    }
    
    public function exportData($stn) {
        $response = Response::make(Formatter::make(json_encode(MapsController::getWorldStation($stn, true)), 'json')->to_xml(), 200);
        
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename="' . $stn . '-temperatures.xml"');
        $response->header('Content-Transfer-Encoding', 'binary');
        $response->header('Content-Type', 'text/xml');
        
        return $response;
    }
}