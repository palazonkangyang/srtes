<?php
use Illuminate\Database\Seeder;

class UrgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('ams_urgency')->insert([
            ['urgency_id' => '1', 'urgency_name' => 'Normal', 'set_time' => '48', 'created_at' => new DateTime()],
            ['urgency_id' => '2', 'urgency_name' => 'Urgent', 'set_time' => '24', 'created_at' => new DateTime()],
    	]);
    }
}