<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        RoleSeeder::run();

        \App\Models\User::factory(2)->create()->each(function ($user){

            $user->assignRole('SuperAdmin');
        });
        \App\Models\User::factory(3)->create()->each(function ($user){

            $user->assignRole('Administrator');
        });
        \App\Models\User::factory(5)->create()->each(function ($user){

            $id = $user->id;

            $Student = new Student();
            $Student->user_id = $id;
            $Student->first_name = 'student'.$id;
            $Student->last_name = "lastname";
            $Student->email = 'sanpleemal'.$id.'@gmail.com';
            $Student->gender = "male";
            $Student->dob = Carbon::now()->format('y-m-d');
            $Student->address = "sample address Sri Lanka";
            $user->studentDetails()->save($Student);

            $user->assignRole('student');
        });


    }
}
