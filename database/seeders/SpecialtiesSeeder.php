<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('specialties')->insert([
            [
                'name' => 'Contabilidade Geral',
                'slug' => 'contabilidade-geral',
                'description' => 'Serviços gerais de contabilidade empresarial',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Contabilidade Tributária',
                'slug' => 'contabilidade-tributaria',
                'description' => 'Especialização em impostos e tributos',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Auditoria',
                'slug' => 'auditoria',
                'description' => 'Auditoria interna e externa',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Perícia Contábil',
                'slug' => 'pericia-contabil',
                'description' => 'Perícias judiciais e extrajudiciais',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Consultoria Empresarial',
                'slug' => 'consultoria-empresarial',
                'description' => 'Consultoria em gestão e negócios',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
