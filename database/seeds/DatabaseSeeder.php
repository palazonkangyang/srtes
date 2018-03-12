<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(RequestSeeder::class);
        $this->call(UrgencySeeder::class);
        $this->call(FormsSeeder::class);
        Model::reguard();
    }
}