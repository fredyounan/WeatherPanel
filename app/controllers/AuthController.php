<?php
class AuthController extends BaseController 
{
    public function viewLogin() 
    {
        if (Auth::check()) 
        {
            return Redirect::to('/');
        }
    
        return View::make('login');
    }
    
    public function doLogin() 
    {
        if (Auth::attempt( array('username' => Input::get('username'), 'password' => Input::get('password'))))
        {
           return Redirect::to('/');
        }
    }
    
    public function doLogout() 
    {
        Auth::logout();
        return Redirect::to('login');
    }
}