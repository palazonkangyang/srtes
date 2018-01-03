<?php
use Illuminate\Database\Seeder;

class FormsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('ams_forms')->insert([
    		['keyword' => 'ADHR', 'name' => 'Ad hoc Request', 'created_at' => new DateTime()],
            ['keyword' => 'RCP', 'name' => 'Request For Color Printing', 'created_at' => new DateTime()],
    		['keyword' => 'RCA', 'name' => 'Request For Certificate of Appreciation', 'created_at' => new DateTime()],
    		['keyword' => 'AREA', 'name' => 'Application For RedCross Email Account', 'created_at' => new DateTime()],
    		['keyword' => 'ARGE', 'name' => 'Application For RedCross Group Email', 'created_at' => new DateTime()],
    		['keyword' => 'CDSAA', 'name' => 'Creation/Deletion For SAGE ACCPAC Account', 'created_at' => new DateTime()],
    		['keyword' => 'RDRA', 'name' => 'Request For Deletion Of RedCross Account', 'created_at' => new DateTime()],
    		['keyword' => 'ATAC', 'name' => 'Application For Temporary Access Card', 'created_at' => new DateTime()],
    		['keyword' => 'HPHCRF', 'name' => 'Haw Par Hall Configuration Request Form', 'created_at' => new DateTime()],
    		['keyword' => 'MJR', 'name' => 'Maintenance Job Request', 'created_at' => new DateTime()],
    		['keyword' => 'PGVBF', 'name' => 'Passenger/Goods Van Booking Form', 'created_at' => new DateTime()]
    	]);
    }
}