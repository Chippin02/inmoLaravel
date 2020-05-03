<?php

use Illuminate\Database\Seeder;

use App\Property_types;

class Property_TypesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $property_type = new Property_types();
        $property_type->name = 'Casa';
        $property_type->save();
        $property_type = new Property_types();
        $property_type->name = 'Piso';
        $property_type->save();
        $property_type = new Property_types();
        $property_type->name = 'Estudio';
        $property_type->save();
        $property_type = new Property_types();
        $property_type->name = 'Local';
        $property_type->save();
        $property_type = new Property_types();
        $property_type->name = 'Plaza aparcamiento';
        $property_type->save();
    }
}
