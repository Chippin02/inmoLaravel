<?php

use App\Publication_Types;
use Illuminate\Database\Seeder;

class Publication_TypesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $publication_type = new Publication_types();
        $publication_type->name = 'Venta';
        $publication_type->save();
        $publication_type = new Publication_types();
        $publication_type->name = 'Alquiler';
        $publication_type->save();
    }
}
