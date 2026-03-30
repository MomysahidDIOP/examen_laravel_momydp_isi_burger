<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {
        //on cree les roles

        $rroleGestionnaire = Role::create(['name' => 'gestionnaire']);
        $roleClient = Role::create(['name' => 'client']);

        // compte gestionnaire
        $gestionnaire =User::create([
            'name' => 'Momy Diop',
            'email' =>'momydiop234@gmail.com',
            'password' => Hash::make('momydiop234'),
        ]);
        $gestionnaire->assignRole('gestionnaire');


        //  compte client de test
        $client = User::create([
            'name' => 'moms diop',
            'email'=>'momsd44@gmail.com',
            'password' => Hash::make('momsd44'),

        ]);
        $client->assignRole('client');

    }
}
