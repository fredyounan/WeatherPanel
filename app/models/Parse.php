<?php
class Parse 
{
    public static function parseFile($file)
	{
		$result = array();
    
        if (! file_exists(public_path() . '/data/' . $file)) {
            return array();
        }

		$arr = explode("\n", file_get_contents(public_path() . '/data/' . $file));
		
        foreach($arr as $line)
		{
			if (empty($line)) continue;
            
            $parts = explode(',', $line);
            
            if (count($parts) !== 14) continue;
            
            $result[] = $parts;
		}
		
		return $result;
	}
}