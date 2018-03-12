<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormIrfiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('ams_form_irfi', function(Blueprint $table) {
    		$table->increments('id');
    		$table->integer('app_id');
                $table->datetime('created_at');
    		$table->timestamp('updated_at');
                
    		$table->string('goods',255);
                $table->string('services',255);
                $table->decimal('estimate_value', 10, 2);             
                $table->integer('type_source');
                $table->string('funding_desc',255);
                $table->integer('type_reason');
                $table->string('reason_desc',255);
                $table->text('detailed_information',255);
                $table->string('vendor_company',255);
                $table->string('vendor_person',255);
                $table->string('vendor_contact',255);
                $table->datetime('date_required');
                
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::drop('ams_form_irfi');
    }
}
