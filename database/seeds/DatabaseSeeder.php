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
    	/*DB::table('permalink')->insert([
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
        ]); */

        /*DB::table('permalink')->insert([
            'pk_permalink'=> 10002,
            'method'=> 'LIST',
            'description'=> 'Sales Orders',
            'route'=> null,
            'type'=> 'B',
            'family'=> 'Reports',
            'indexno'=> 1,
            'stat'=>1
        ]); */


        //unseeded here

        /*DB::table('permalink')->insert([
            'pk_permalink'=> 3000,
            'method'=> null,
            'description'=> 'Posts',
            'route'=> null,
            'icon'=> 'fa fa-newspaper-o',
            'type'=> 'A',
            'family'=> 'Posts',
            'indexno'=> 4,
            'stat'=>1
        ]); 

        DB::table('permalink')->insert([
            'pk_permalink'=> 3001,
            'method'=> 'LIST',
            'description'=> 'Blogs',
            'route'=> 'blogs.index',
            'type'=> 'B',
            'family'=> 'Posts',
            'indexno'=> 0,
            'stat'=>1
        ]); 

        DB::table('permalink')->insert([
            'pk_permalink'=> 3002,
            'method'=> 'POST',
            'description'=> 'Add New',
            'route'=> 'blogs.create',
            'type'=> 'C',
            'family'=> 'blogs.index',
            'indexno'=> 0,
            'stat'=>1
        ]); 

        DB::table('permalink')->insert([
            'pk_permalink'=> 3003,
            'method'=> 'PUT',
            'description'=> 'Edit',
            'route'=> 'blogs.edit',
            'type'=> 'C',
            'family'=> 'blogs.index',
            'indexno'=> 1,
            'stat'=>1
        ]); 


        DB::table('permalink')->insert([
            'pk_permalink'=> 7030,
            'method'=> 'LIST',
            'description'=> 'Tags',
            'route'=> 'tags.index',
            'type'=> 'B',
            'family'=> 'Settings',
            'indexno'=> 3,
            'stat'=>1
        ]);

        DB::table('permalink')->insert([
            'pk_permalink'=> 7031,
            'method'=> 'POST',
            'description'=> 'Add New',
            'route'=> 'tags.create',
            'type'=> 'C',
            'family'=> 'tags.index',
            'indexno'=> 0,
            'stat'=>1
        ]);

        DB::table('permalink')->insert([
            'pk_permalink'=> 7032,
            'method'=> 'PUT',
            'description'=> 'Edit',
            'route'=> 'tags.edit',
            'type'=> 'C',
            'family'=> 'tags.index',
            'indexno'=> 1,
            'stat'=>1
        ]);

        DB::table('permalink')->insert([
            'pk_permalink'=> 7033,
            'method'=> 'DELETE',
            'description'=> 'Delete',
            'route'=> 'tags.delete',
            'type'=> 'C',
            'family'=> 'tags.index',
            'indexno'=> 2,
            'stat'=>1
        ]); */


        /*DB::table('permalink')->insert([
            'pk_permalink'=> 5006,
            'method'=> 'POST',
            'description'=> 'Login-As',
            'route'=> 'users.virtual',
            'type'=> 'C',
            'family'=> 'users.index',
            'indexno'=> 4,
            'stat'=>1
        ]); */

        
        /*DB::table('permalink')->insert([
            'pk_permalink'=> 1050,
            'method'=> 'LIST',
            'description'=> 'Flavors',
            'route'=> 'flavors.index',
            'type'=> 'B',
            'family'=> 'Products',
            'indexno'=> 3,
            'stat'=>1
        ]); 


        DB::table('permalink')->insert([
            'pk_permalink'=> 1051,
            'method'=> 'POST',
            'description'=> 'Add New',
            'route'=> 'flavors.create',
            'type'=> 'C',
            'family'=> 'flavors.index',
            'indexno'=> 0,
            'stat'=>1
        ]); 


        DB::table('permalink')->insert([
            'pk_permalink'=> 1052,
            'method'=> 'PUT',
            'description'=> 'Edit',
            'route'=> 'flavors.edit',
            'type'=> 'C',
            'family'=> 'flavors.index',
            'indexno'=> 1,
            'stat'=>1
        ]); 

        DB::table('permalink')->insert([
            'pk_permalink'=> 1053,
            'method'=> 'DELETE',
            'description'=> 'Delete',
            'route'=> 'flavors.delete',
            'type'=> 'C',
            'family'=> 'flavors.index',
            'indexno'=> 2,
            'stat'=>1
        ]); 


        DB::table('permalink')->insert([
            'pk_permalink'=> 1060,
            'method'=> 'LIST',
            'description'=> 'Group',
            'route'=> 'productgroup.index',
            'type'=> 'B',
            'family'=> 'Products',
            'indexno'=> 4,
            'stat'=>1
        ]); 


        DB::table('permalink')->insert([
            'pk_permalink'=> 1061,
            'method'=> 'POST',
            'description'=> 'Add New',
            'route'=> 'productgroup.create',
            'type'=> 'C',
            'family'=> 'productgroup.index',
            'indexno'=> 0,
            'stat'=>1
        ]); 


        DB::table('permalink')->insert([
            'pk_permalink'=> 1062,
            'method'=> 'PUT',
            'description'=> 'Edit',
            'route'=> 'productgroup.edit',
            'type'=> 'C',
            'family'=> 'productgroup.index',
            'indexno'=> 1,
            'stat'=>1
        ]); 

        DB::table('permalink')->insert([
            'pk_permalink'=> 1063,
            'method'=> 'DELETE',
            'description'=> 'Delete',
            'route'=> 'productgroup.delete',
            'type'=> 'C',
            'family'=> 'productgroup.index',
            'indexno'=> 2,
            'stat'=>1
        ]); */


        /*DB::table('permalink')->insert([
            'pk_permalink'=> 1017,
            'method'=> 'POST',
            'description'=> 'Copy',
            'route'=> 'products.copy',
            'type'=> 'C',
            'family'=> 'products.index',
            'indexno'=> 4,
            'stat'=>1
        ]);  */

        DB::table('permalink')->insert([
            'pk_permalink'=> 1018,
            'method'=> 'POST',
            'description'=> 'Compositions',
            'route'=> 'products.compositions',
            'type'=> 'C',
            'family'=> 'products.index',
            'indexno'=> 5,
            'stat'=>1
        ]);  


    }

}//END class
