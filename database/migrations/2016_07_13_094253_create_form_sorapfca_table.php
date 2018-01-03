<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormSorapfcaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ams_form_sorapfca', function(Blueprint $table) {
    		$table->increments('id');
    		$table->integer('app_id');
                $table->datetime('created_at');
    		$table->timestamp('updated_at');
                 $table->integer('request_type');
    		$table->string('cheque_payable_to',255);
                $table->string('project_name',255);
                $table->decimal('advance_received', 10, 2);
                $table->decimal('total', 10, 2);
                $table->decimal('balance', 10, 2);
    		$table->string('budget_code',255);
                $table->string('deparment',255);
                $table->string('staff',255);
                $table->datetime('date_event');
                $table->text('reasons');
                $table->text('description');
    	});
    }
 
    // will include subtable of itemlist
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('ams_form_sorapfca');
    }
}
