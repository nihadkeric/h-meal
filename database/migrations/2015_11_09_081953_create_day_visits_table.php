<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // dnevni vnos
        Schema::create('day_visits', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('number_of_visits');
            $table->date('date_of_visit');
            $table->string('food_code',50);
            $table->string('food_type');
            $table->double('fat', 15, 3);
            $table->double('calories', 15, 3);
            $table->double('carbohydrates', 15, 3);
            $table->double('protein', 15, 3);
            //$table->date('provided');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('day_visits');
    }
}
