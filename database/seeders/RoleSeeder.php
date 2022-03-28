<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role([
            'id' => 1,
            'name' => 'SuperAdmin'
            ]);

            $role->save();

          $role = new Role([
            'id' => 2,
            'name' => 'Administrator'
            ]);

          $role->save();

          $role = new Role([
            'id' => 3,
            'name' => 'student'
          ]);

          $role->save();
    }
}
