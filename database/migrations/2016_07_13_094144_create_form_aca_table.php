<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormAcaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ams_form_aca', function(Blueprint $table) {
    		$table->increments('id');
    		$table->integer('app_id');
                $table->datetime('created_at');
    		$table->timestamp('updated_at');
                $table->integer('request_type');
    		$table->string('cheque_payable_to',255);
                $table->string('project_name',255);
                $table->decimal('amount', 10, 2);
    		$table->string('amount_code',255);
                $table->datetime('date_required');
                $table->text('reasons');
                $table->text('description');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::drop('ams_form_aca');
    }
}
