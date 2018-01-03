<?php
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('ams_type_request')->insert([
            ['created_id' => 2, 'order_number'=>'1', 'name' => 'Financial Matters', 'created_at' => new DateTime()],
            ['created_id' => 2, 'order_number'=>'2', 'name' => 'Pay Matters', 'created_at' => new DateTime()],
            ['created_id' => 2, 'order_number'=>'3', 'name' => 'Overseas Travel', 'created_at' => new DateTime()],
            ['created_id' => 2, 'order_number'=>'4', 'name' => 'HR Matters', 'created_at' => new DateTime()],
            ['created_id' => 2, 'order_number'=>'5', 'name' => 'Administration Matters', 'created_at' => new DateTime()],
    		['created_id' => 2, 'order_number'=>'6', 'name' => 'IT Matters', 'created_at' => new DateTime()],
    		['created_id' => 2, 'order_number'=>'7', 'name' => 'Course Matters', 'created_at' => new DateTime()],
    		['created_id' => 2, 'order_number'=>'8', 'name' => 'Others', 'created_at' => new DateTime()]
    	]);
    }
}