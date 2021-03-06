<?php
class UserSeeder
extends DatabaseSeeder
{
    public function run()
    {
        $users = [
            [
                "username" => "admin",
                "password" => Hash::make("admin"),
                "email"    => "admin@unwdmi.com"
            ]
        ];
		
        foreach ($users as $user)
        {
            User::create($user);
        }
    }
}