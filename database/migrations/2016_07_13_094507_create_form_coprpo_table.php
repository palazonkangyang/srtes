<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormCoprpoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ams_form_coprpo', function(Blueprint $table) {
    		$table->increments('id');
    		$table->integer('app_id');
                $table->datetime('created_at');
    		$table->timestamp('updated_at');
                
    		$table->string('pr_no',255);
                $table->string('po_no',255);
                $table->string('grn_no',255);
                $table->string('inv_no',255);
                $table->string('desc_purchased',255);
                $table->text('reasons');
                $table->string('vendor',255);                
                $table->decimal('amount', 10, 2);
               
             
               
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('ams_form_coprpo');
    }
}
