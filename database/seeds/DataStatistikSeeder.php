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
        collect(['shortlinkgenerate', 'shortlinkcustom', 'shortlinkakses'])->each(function ($data) {
            DataStatistik::query()->create([
                'nama' => $data,
                'nilai' => 0,
            ]);
        });
    }
}
