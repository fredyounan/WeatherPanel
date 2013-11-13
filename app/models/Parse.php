<?php

class Parse {

	public function parseFile($file)
	{
		$result = array();
	
		$s = file_get_contents(public_path() . "/data/" . $file);
		$arr = explode("\n", $s);
		foreach($arr as $line)
		{
			if (!empty($line))
			{
				$result[] = explode(",", $line);
			}
		}
		
		return $result;
	}
	
}