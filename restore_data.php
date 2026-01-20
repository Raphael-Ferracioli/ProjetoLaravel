<?php
// Script para restaurar dados do backup
$host = 'vempravilabd.mysql.dbaas.com.br';
$user = 'vempravilabd';
$password = 'A7a4xQ4Tq@';
$database = 'vempravilabd';

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_errno) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

echo "Conectado ao banco com sucesso!\n";
$mysqli->set_charset("utf8mb4");

// Ler o arquivo de backup
$backup_file = 'backup_completo_2025-11-25_14-50-08.json';
if (!file_exists($backup_file)) {
    die("Arquivo de backup não encontrado: $backup_file\n");
}

$backup_content = file_get_contents($backup_file);
$backup_data = json_decode($backup_content, true);

if ($backup_data === null) {
    die("Erro ao decodificar o arquivo de backup JSON.\n");
}

echo "Backup carregado com sucesso!\n\n";

// Restaurar dados da tabela users (adaptando para a nova estrutura)
if (isset($backup_data['users']) && !empty($backup_data['users']['data'])) {
    echo "Restaurando dados da tabela users...\n";
    
    foreach ($backup_data['users']['data'] as $user) {
        // Mapear campos antigos para novos
        $sql = "INSERT INTO users (
            id, name, email, email_verified_at, password, 
            phone, whatsapp, facebook, instagram, linkedin, 
            description, photo_url, address, city, state, cep, 
            is_active, remember_token, created_at, updated_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $mysqli->prepare($sql);
        
        if (!$stmt) {
            echo "Erro ao preparar statement: " . $mysqli->error . "\n";
            continue;
        }
        
        // Mapear campos (alguns podem não existir no backup antigo)
        $id = $user['id'];
        $name = $user['name'] ?? '';
        $email = $user['email'] ?? '';
        $email_verified_at = $user['email_verified_at'] ?? null;
        $password_hash = $user['password_hash'] ?? ($user['password'] ?? '');
        
        // Campos que podem ou não existir no backup antigo
        $phone = $user['phone'] ?? $user['celular'] ?? null;
        $whatsapp = $user['whatsapp'] ?? null;
        $facebook = $user['facebook'] ?? null;
        $instagram = $user['instagram'] ?? null;
        $linkedin = $user['linkedin'] ?? null;
        $description = $user['description'] ?? null;
        $photo_url = $user['photo_url'] ?? null;
        $address = $user['address'] ?? $user['endereco'] ?? null;
        $city = $user['city'] ?? $user['cidade'] ?? null;
        $state = $user['state'] ?? $user['estado'] ?? null;
        $cep = $user['cep'] ?? null;
        $is_active = isset($user['is_active']) ? (bool)$user['is_active'] : true;
        $remember_token = $user['remember_token'] ?? null;
        $created_at = $user['created_at'] ?? date('Y-m-d H:i:s');
        $updated_at = $user['updated_at'] ?? date('Y-m-d H:i:s');
        
        $stmt->bind_param(
            "isssssssssssssssssss",
            $id, $name, $email, $email_verified_at, $password_hash,
            $phone, $whatsapp, $facebook, $instagram, $linkedin,
            $description, $photo_url, $address, $city, $state, $cep,
            $is_active, $remember_token, $created_at, $updated_at
        );
        
        if ($stmt->execute()) {
            echo "  - Usuário ID $id ($name) restaurado com sucesso\n";
        } else {
            echo "  - Erro ao restaurar usuário ID $id: " . $stmt->error . "\n";
        }
        
        $stmt->close();
    }
    
    echo "\nRestauração da tabela users concluída!\n";
} else {
    echo "Nenhum dado de usuário encontrado no backup.\n";
}

// Restaurar outras tabelas se necessário
$tables_to_restore = ['specialties', 'user_specialties', 'password_resets'];

foreach ($tables_to_restore as $table) {
    if (isset($backup_data[$table]) && !empty($backup_data[$table]['data'])) {
        echo "\nRestaurando dados da tabela $table...\n";
        
        foreach ($backup_data[$table]['data'] as $row) {
            $columns = array_keys($row);
            $placeholders = str_repeat('?,', count($columns) - 1) . '?';
            $sql = "INSERT INTO `$table` (`" . implode('`, `', $columns) . "`) VALUES ($placeholders)";
            
            $stmt = $mysqli->prepare($sql);
            if (!$stmt) {
                echo "  - Erro ao preparar statement para $table: " . $mysqli->error . "\n";
                continue;
            }
            
            $values = array_values($row);
            $types = str_repeat('s', count($values));
            $stmt->bind_param($types, ...$values);
            
            if ($stmt->execute()) {
                echo "  - Registro restaurado em $table\n";
            } else {
                echo "  - Erro ao restaurar registro em $table: " . $stmt->error . "\n";
            }
            
            $stmt->close();
        }
    }
}

$mysqli->close();
echo "\nRestauração de dados concluída!\n";
?>