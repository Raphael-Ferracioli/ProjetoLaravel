<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Specialty;

class UserSpecialtiesSeeder extends Seeder
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

        // Criar um mapeamento dos IDs antigos para os novos (baseado no email)
        $users = User::all();
        $email_to_id = [];
        foreach ($users as $user) {
            $email_to_id[$user->email] = $user->id;
        }

        // Importar user_specialties
        if (isset($backup_data['user_specialties']) && !empty($backup_data['user_specialties']['data'])) {
            $this->command->info("Importando relacionamentos user_specialties...");
            
            foreach ($backup_data['user_specialties']['data'] as $relationData) {
                try {
                    // Encontrar o usuário pelo ID antigo no backup de users
                    $oldUserId = $relationData['user_id'];
                    $userEmail = $this->findUserEmailByOldId($backup_data['users']['data'], $oldUserId);
                    
                    if (!$userEmail || !isset($email_to_id[$userEmail])) {
                        $this->command->warn("Usuário não encontrado para ID antigo: $oldUserId");
                        continue;
                    }
                    
                    $newUserId = $email_to_id[$userEmail];
                    $specialtyId = $relationData['specialty_id'];
                    
                    // Verificar se a especialidade existe
                    if (!Specialty::find($specialtyId)) {
                        $this->command->warn("Especialidade não encontrada: $specialtyId");
                        continue;
                    }
                    
                    // Inserir relacionamento
                    DB::table('user_specialties')->insertOrIgnore([
                        'user_id' => $newUserId,
                        'specialty_id' => $specialtyId,
                        'created_at' => $relationData['created_at'] ?? now(),
                    ]);
                    
                } catch (\Exception $e) {
                    $this->command->error("Erro ao importar relacionamento user_specialty: " . $e->getMessage());
                }
            }
            
            $count = count($backup_data['user_specialties']['data']);
            $this->command->info("Processados $count relacionamentos user_specialties");
        }
    }
    
    private function findUserEmailByOldId($usersData, $oldId)
    {
        foreach ($usersData as $userData) {
            if ($userData['id'] == $oldId) {
                return $userData['email'];
            }
        }
        return null;
    }
}