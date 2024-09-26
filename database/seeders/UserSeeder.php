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
        $role_admin = Role::updateOrCreate(['name' => 'admin'], [
          'guard_name' => 'web'
        ]);
        $role_aprendiz = Role::updateOrCreate(['name' => 'aprendiz'], [
          'guard_name' => 'web'
        ]);
        $role_funcionario = Role::updateOrCreate(['name' => 'funcionario'], [
          'guard_name' => 'web'
        ]);

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
        $user->assignRole($role_admin);

        $person = Person::updateOrCreate(['document_number' => '12345'], [
          'name' => 'Aprendiz Prueba',
          'document_type' => 'Cédula de ciudadanía',
          'telephone' => '3102443465',
          'email' => 'aprendiz@gmail.com',
        ]);
        $person_id = $person->id;

        $user = User::updateOrCreate(['person_id' => $person_id], [
            'name' => 'Aprendiz Prueba',
            'email' => 'aprendiz@gmail.com',
            'password' => Hash::make('aprendiz123')
          ]);
        $user->assignRole($role_aprendiz);

        $person = Person::updateOrCreate(['document_number' => '123456'], [
          'name' => 'Funcionario Prueba',
          'document_type' => 'Cédula de ciudadanía',
          'telephone' => '3102443465',
          'email' => 'funcionario@gmail.com',
        ]);
        $person_id = $person->id;

        $user = User::updateOrCreate(['person_id' => $person_id], [
            'name' => 'Funcionario Prueba',
            'email' => 'funcionario@gmail.com',
            'password' => Hash::make('funcionario123')
          ]);
        $user->assignRole($role_funcionario);

    }


}
