<?php

use App\DataStatistik;
use Illuminate\Database\Seeder;

class DataStatistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(['shortlinkgenerate', 'shortlinkcustom'])->each(function ($data) {
            DataStatistik::create([
                'nama' => $data,
                'nilai' => 0,
            ]);
        });
    }
}
