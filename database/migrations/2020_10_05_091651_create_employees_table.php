<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('Email');
            $table->string('Hobbies');
            $table->string('Gender');
            $table->mediumText('Picture');
            $table->timestamps();

        });
        // Schema::create('pictures',function(Blueprint $table2)
        // {
        //     $table2->mediumText('Upload Picture');
        //     $table2->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
        //Schema::dropIfExists('pictures');
    }
}
