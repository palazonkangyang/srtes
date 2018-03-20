<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineitemEoq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('ams_lineitem_eoq', function(Blueprint $table) {
    		$table->increments('id');
    		$table->integer('app_id');
                $table->datetime('created_at');
    		$table->timestamp('updated_at');              
    		$table->string('item_company',255);
                $table->string('item_paymentterm',255);         
                $table->decimal('item_subtotal', 10, 2);
    		$table->decimal('item_gst', 10, 2);
                $table->decimal('item_total', 10, 2);
    	});
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
