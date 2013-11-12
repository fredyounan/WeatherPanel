<?php
class DashboardController extends BaseController 
{
    public function viewDashboard() 
    {
        return View::make('dashboard');
    }
}