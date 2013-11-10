<?php

use Helpers\Variables;

class MainController extends BaseController {
    protected $layout = 'layouts.master';

	public function showMain()
	{
        $c = new Variables();
        $content = array('toHeatIndex' => $c->toHeatIndex(60, 50), 'getAtmosphere' => $c->getAtmosphere(1033.4));
        $this->layout->content = View::make('test')->with($content);
		/*echo $c->toHeatIndex(60, 50);
		echo $c->getAtmosphere(1033.4);*/
		//return View::make('main');
	}
}