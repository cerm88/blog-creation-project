<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // Creando un registro manualmente
        App\User::create([
            'name' => 'Carlos Rodríguez',
            'email' => 'i@admin.com',
            'password' => bcrypt('123456')
        ]);

        // Creamos el factory
        factory(App\Post::class, 24)->create();
    }
}
