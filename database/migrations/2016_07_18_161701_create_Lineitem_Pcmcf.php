<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineitemPcmcf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ams_lineitem_pcmcf', function(Blueprint $table) {
    		$table->increments('id');
    		$table->integer('app_id');
                $table->datetime('created_at');
    		$table->timestamp('updated_at');              
 
                $table->string('item_desc',255);         
                $table->decimal('item_total', 10, 2);
    		$table->string('item_note',255);
                $table->datetime('item_date');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
           Schema::drop('ams_lineitem_pcmcf');
    }
}
