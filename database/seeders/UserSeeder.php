<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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

        // Restaurar dados da tabela users
        if (isset($backup_data['users']) && !empty($backup_data['users']['data'])) {
            $this->command->info("Importando usuários do backup...");
            
            foreach ($backup_data['users']['data'] as $userData) {
                try {
                    // Verificar se o usuário já existe pelo email
                    $existingUser = User::where('email', $userData['email'])->first();
                    if ($existingUser) {
                        $this->command->warn("Usuário já existe: " . $userData['email']);
                        continue;
                    }

                    // Criar usuário sem definir ID (deixa o auto-increment fazer o trabalho)
                    $user = User::create([
                        'name' => $userData['name'] ?? '',
                        'email' => $userData['email'] ?? '',
                        'email_verified_at' => $userData['email_verified_at'] ?? null,
                        'password' => $userData['password_hash'] ?? Hash::make('123456'),
                        'phone' => $userData['phone'] ?? null,
                        'whatsapp' => $userData['whatsapp'] ?? null,
                        'facebook' => $userData['facebook'] ?? null,
                        'instagram' => $userData['instagram'] ?? null,
                        'linkedin' => $userData['linkedin'] ?? null,
                        'description' => $userData['description'] ?? null,
                        'photo_url' => $userData['photo_url'] ?? null,
                        'address' => $userData['address'] ?? null,
                        'city' => $userData['city'] ?? null,
                        'state' => $userData['state'] ?? null,
                        'cep' => $userData['cep'] ?? null,
                        'is_active' => isset($userData['is_active']) ? (bool)$userData['is_active'] : true,
                        'remember_token' => $userData['remember_token'] ?? null,
                        'created_at' => $userData['created_at'] ?? now(),
                        'updated_at' => $userData['updated_at'] ?? now(),
                    ]);

                    $this->command->info("Usuário importado: " . $user->name . " (Novo ID: " . $user->id . ", Email: " . $user->email . ")");
                    
                } catch (\Exception $e) {
                    $this->command->error("Erro ao importar usuário " . ($userData['name'] ?? 'N/A') . ": " . $e->getMessage());
                }
            }
            
            $this->command->info("Importação de usuários concluída!");
        } else {
            $this->command->warn("Nenhum dado de usuário encontrado no backup.");
        }
    }
}
