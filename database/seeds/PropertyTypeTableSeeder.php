<?php

use App\Lib\CsvSeeder;
use Illuminate\Support\Facades\DB;

class PropertyTypeTableSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'property_types';
        $this->filename = base_path().'/database/seeds/csvs/property_types.csv';
    }

    public function run()
    {
        // Recommended when importing larger CSVs
        DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        DB::table($this->table)->truncate();

        parent::run();
    }
}
