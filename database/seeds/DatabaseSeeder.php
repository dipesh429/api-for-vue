<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     

    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $tables = ['users'];

        foreach($tables as $table){
        	DB::table($table)->truncate();
        }

        factory(User::class,15)->create();
    }
}
