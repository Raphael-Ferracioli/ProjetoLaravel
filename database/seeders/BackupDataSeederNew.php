<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Specialty;

class BackupDataSeederNew extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ler o arquivo de backup
        $backup_file = base_path('backup_completo_2025-11-25_14-50-08.json');
        
        if (!file_exists($backup_file)) {
            $this->command->error("Arquivo de backup não encontrado: $backup_file");
            return;
        }

        $backup_content = file_get_contents($backup_file);
        $backup_data = json_decode($backup_content, true);

        if ($backup_data === null) {
            $this->command->error("Erro ao decodificar o arquivo de backup JSON.");
            return;
        }

        $this->command->info("Backup carregado com sucesso!");

        // Importar specialties primeiro (tabela base)
        if (isset($backup_data['specialties']) && !empty($backup_data['specialties']['data'])) {
            $this->command->info("Importando especialidades...");
            
            foreach ($backup_data['specialties']['data'] as $specialtyData) {
                try {
                    Specialty::create([
                        'name' => $specialtyData['name'],
                        'slug' => $specialtyData['slug'],
                        'description' => $specialtyData['description'] ?? null,
                        'is_active' => (bool) ($specialtyData['is_active'] ?? true),
                        'created_at' => $specialtyData['created_at'] ?? now(),
                    ]);
                    
                    $this->command->info("Especialidade importada: " . $specialtyData['name']);
                    
                } catch (\Exception $e) {
                    $this->command->error("Erro ao importar especialidade " . ($specialtyData['name'] ?? 'N/A') . ": " . $e->getMessage());
                }
            }
        }

        // Importar password_resets
        if (isset($backup_data['password_resets']) && !empty($backup_data['password_resets']['data'])) {
            $this->command->info("Importando password_resets...");
            
            foreach ($backup_data['password_resets']['data'] as $resetData) {
                try {
                    DB::table('password_resets')->insert([
                        'email' => $resetData['email'],
                        'token' => $resetData['token'],
                        'expires_at' => $resetData['expires_at'],
                        'created_at' => $resetData['created_at'] ?? now(),
                    ]);
                    
                } catch (\Exception $e) {
                    $this->command->error("Erro ao importar password_reset: " . $e->getMessage());
                }
            }
            
            $count = count($backup_data['password_resets']['data']);
            $this->command->info("Importados $count registros para password_resets");
        }

        $this->command->info("Importação de dados complementares concluída!");
    }
}