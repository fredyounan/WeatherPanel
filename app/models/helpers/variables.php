<?php

namespace Helpers;

class Variables
{

	public function getAtmosphere($bar)
	{
		return ($bar * 0.99) / 1000;
	}

	public function toHeatIndex($temperature, $dewpoint)
	{
		// declare some variables
		$tmpf = $temperature;
		$ctmpf = $tmpf;
		$dwpf = $dewpoint;

		// start doing the math
		$tmpf = ($tmpf * (9/5)) + 32;
		$dwpf = ($dwpf *( 9/5)) + 32;
		$dwpc = 5 / 9 * ($dwpf - 32);
		$tmpc = 5 / 9 * ($tmpf - 32);
		$e = 6.112 * (exp((17.67 * $dwpc) / ($dwpc + 243.5)));
		$es = 6.112 * (exp((17.67 * $tmpc) / ($tmpc + 243.5)));
		$relh = ($e / $es) * 100;
		$heatb = 61 + ($tmpf - 68) * 1.2 + $relh *.094;
		$t2 = pow($tmpf,2);
		$t3 = pow($tmpf,3);
		$r2 = pow($relh,2);
		$r3 = pow($relh,3);
		$heata = 17.423 + 0.185212 * $tmpf + 5.37941 * $relh - 0.100254 * $tmpf * $relh +
			0.941695 * (pow(10,-2)) * $t2 + 0.728898 * (pow(10,-2)) * $r2 +
			0.345372 * (pow(10,-3)) * $t2 * $relh - 0.814971 * (pow(10,-3)) * $tmpf * $r2 +
			0.102102 * (pow(10,-4)) * $t2 * $r2 - 0.38646 * (pow(10,-4)) * $t3 +
			0.291583 * (pow(10,-4)) * $r3 + 0.142721 * (pow(10,-5)) * $t3 * $relh +
			0.197483 * (pow(10,-6)) * $tmpf * $r3 - 0.218429 * (pow(10,-7)) * $t3 * $r2 +
			0.843296 * (pow(10,-9)) * $t2 * $r3 - 0.481975 * (pow(10,-10)) * $t3 * $r3;
			
		$heat = ($heata - 32) * (5 / 9);
		$heat= ($ctmpf < 21.11) ? $ctmpf : $heat;
		return number_format($heat, 2);
	}
}