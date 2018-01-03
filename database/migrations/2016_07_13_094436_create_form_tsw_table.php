<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormTswTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('ams_form_tsw', function(Blueprint $table) {
    		$table->increments('id');
    		$table->integer('app_id');
                $table->datetime('created_at');
    		$table->timestamp('updated_at');
                $table->string('designation',255);
    		$table->integer('service_status');
                $table->integer('type_training');
                $table->string('title',255);      
                 $table->string('provider',255); 
                 $table->integer('isfunds');  
                 $table->integer('budget_availability');
                $table->decimal('fee', 10, 2);
                 $table->decimal('funds', 10, 2);         
                $table->text('description');
             
                // will include subtable of attendlist add multiple: Name, NRIC/FIN, Cost Centre (numeric)
                  // will include subtable of dateofprogramme 
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::drop('ams_form_tsw');
    }
}
