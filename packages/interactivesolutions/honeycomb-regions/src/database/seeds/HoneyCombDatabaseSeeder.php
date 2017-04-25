<?php
namespace interactivesolutions\honeycombregions\database\seeds;

use Illuminate\Database\Seeder;

class HoneyCombDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ContinentsSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(MunicipalitiesSeeder::class);
    }
}