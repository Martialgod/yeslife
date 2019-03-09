<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


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
       
    	//manual seed for permalink
    	DB::table('permalink')->insert([
    		'pk_permalink'=> 7020,
    		'method'=> 'LIST',
    		'description'=> 'Actions',
    		'route'=> 'actions.index',
    		'type'=> 'B',
    		'family'=> 'Settings',
    		'indexno'=> 2,
    		'stat'=>1
		]);

		DB::table('permalink')->insert([
    		'pk_permalink'=> 7021,
    		'method'=> 'POST',
    		'description'=> 'Add New',
    		'route'=> 'actions.create',
    		'type'=> 'C',
    		'family'=> 'actions.index',
    		'indexno'=> 0,
    		'stat'=>1
		]);

		DB::table('permalink')->insert([
    		'pk_permalink'=> 7022,
    		'method'=> 'PUT',
    		'description'=> 'Edit',
    		'route'=> 'actions.edit',
    		'type'=> 'C',
    		'family'=> 'actions.index',
    		'indexno'=> 1,
    		'stat'=>1
		]);

        //delete not applicable
		DB::table('permalink')->insert([
    		'pk_permalink'=> 7023,
    		'method'=> 'DELETE',
    		'description'=> 'Delete',
    		'route'=> 'actions.delete',
    		'type'=> 'C',
    		'family'=> 'actions.index',
    		'indexno'=> 2,
    		'stat'=>0
		]);


        DB::table('permalink')->insert([
            'pk_permalink'=> 5020,
            'method'=> 'LIST',
            'description'=> 'Rewards',
            'route'=> 'rewards.index',
            'type'=> 'B',
            'family'=> 'Users',
            'indexno'=> 2,
            'stat'=>1
        ]);

        DB::table('permalink')->insert([
            'pk_permalink'=> 5021,
            'method'=> 'POST',
            'description'=> 'Add New',
            'route'=> 'rewards.create',
            'type'=> 'C',
            'family'=> 'rewards.index',
            'indexno'=> 0,
            'stat'=>1
        ]);

        DB::table('permalink')->insert([
            'pk_permalink'=> 5022,
            'method'=> 'PUT',
            'description'=> 'Edit',
            'route'=> 'rewards.edit',
            'type'=> 'C',
            'family'=> 'rewards.index',
            'indexno'=> 1,
            'stat'=>1
        ]);



    }

}//END class
