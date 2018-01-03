<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineitemAlTsw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ams_lineitem_al_tsw', function(Blueprint $table) {
    		$table->increments('id');
    		$table->integer('app_id');
                $table->datetime('created_at');
    		$table->timestamp('updated_at');              
 
                $table->string('item_name',255);  
                $table->string('item_nric',255);  
                $table->string('item_costcentre',255);  
                 $table->string('item_note',255);  
 
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('ams_lineitem_al_tsw');
    }
}
