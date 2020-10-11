<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class employee_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 1000; $i++) {

	    	DB::table('employees')->insert([

                'First Name' => str_random(8),
                'Last Name' => str_random(8),
                'email' => str_random(12).'@mail.com',
                'hobbies' => str_random(8),
                'Gender' => str_random(8)


            ]);


    	}
    }
}
