<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\User::create([
          'name' => 'nome1',
          'email' => 'nome1@mail',
          'password' => bcrypt('123123')
        ]);

        \App\User::create([
          'name' => 'nome2',
          'email' => 'nome2@mail',
          'password' => bcrypt('123123')
        ]);

        \App\User::create([
          'name' => 'emanuel',
          'email' => 'emanuel@mail',
          'password' => bcrypt('123123')
        ]);
    }
}
