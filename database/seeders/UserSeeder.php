<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $person = Person::updateOrCreate(['document_number' => '1234567890'], [
            'name' => 'Admin',
            'document_type' => 'Cédula de ciudadanía',
            'telephone' => '3102443465',
            'email' => 'admin@gmail.com',
          ]);
        $person_id = $person->id;

        $user = User::updateOrCreate(['person_id' => $person_id], [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
          ]);

        $role = Role::updateOrCreate(['name' => 'admin'], [
        'guard_name' => 'web'
        ]);


        $user->assignRole($role);
    }
}
