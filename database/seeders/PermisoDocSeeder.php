<?php

namespace Database\Seeders;

use App\Models\PermisoDoc;
use Illuminate\Database\Seeder;

class PermisoDocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermisoDoc::factory(10)->create();
    }
}
