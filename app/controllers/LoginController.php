<?php
class LoginController extends BaseController {

	public function DoLogin()
	{
        echo Hash::make('admin');
	}
}