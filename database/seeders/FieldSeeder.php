<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Field;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = ([
            'Aarde en Milieu',
            'Economie en Bedrijf',
            'Exact en Informatica',
            'Gedrag en Maatschappij',
            'Gezondheid',
            'Interdisciplinair',
            'Kunst en Cultuur',
            'Onderwijs en Opvoeding',
            'Recht en Bestuur',
            'Taal en Communicatie',
            'Techniek',
        ]);

        foreach ($fields as $field) {
            Field::firstOrCreate(['name' => $field]);
        }
    }
}
