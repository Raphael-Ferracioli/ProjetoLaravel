<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BackupDataSeeder extends Seeder
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

        // Desabilitar verificação de chaves estrangeiras temporariamente
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Restaurar tabelas específicas (excluindo users que já tem seeder próprio)
        $tables_to_restore = ['specialties', 'user_specialties', 'password_resets'];

        foreach ($tables_to_restore as $table) {
            if (isset($backup_data[$table]) && !empty($backup_data[$table]['data'])) {
                $this->command->info("Importando dados da tabela: $table");
                
                // Primeiro, criar a tabela se ela não existir (usando a estrutura do backup)
                try {
                    if (isset($backup_data[$table]['structure'])) {
                        DB::statement("DROP TABLE IF EXISTS `$table`");
                        DB::statement($backup_data[$table]['structure']);
                        $this->command->info("Estrutura da tabela $table criada");
                    }
                } catch (\Exception $e) {
                    $this->command->warn("Erro ao criar estrutura da tabela $table: " . $e->getMessage());
                }

                // Inserir os dados
                foreach ($backup_data[$table]['data'] as $row) {
                    try {
                        DB::table($table)->insert($row);
                    } catch (\Exception $e) {
                        $this->command->warn("Erro ao inserir registro na tabela $table: " . $e->getMessage());
                    }
                }
                
                $count = count($backup_data[$table]['data']);
                $this->command->info("Importados $count registros para a tabela $table");
            } else {
                $this->command->warn("Nenhum dado encontrado para a tabela: $table");
            }
        }

        // Reabilitar verificação de chaves estrangeiras
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info("Importação de dados complementares concluída!");
    }
}
