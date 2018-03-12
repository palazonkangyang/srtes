<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormPcmcfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('ams_form_pcmcf', function(Blueprint $table) {
    		$table->increments('id');
    		$table->integer('app_id');
                $table->datetime('created_at');
    		$table->timestamp('updated_at');
                
                $table->string('title',255);
    		$table->string('voucher_no',255);
                $table->string('account_code',255);
                $table->decimal('total', 10, 2);
    		$table->string('project',255);
                $table->datetime('date_required');
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
         Schema::drop('ams_form_pcmcf');
    }
}
