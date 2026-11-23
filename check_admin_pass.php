<?php
require __DIR__ . '/public/config/database.php';
$stmt = $pdo->query('SELECT id, username, email, full_name, password_hash FROM admins');
$admins = $stmt->fetchAll();
foreach ($admins as $a) {
    echo "ID: " . $a['id'] . "\n";
    echo "Username: " . $a['username'] . "\n";
    echo "Email: " . $a['email'] . "\n";
    echo "Full Name: " . $a['full_name'] . "\n";
    echo "Hash: " . $a['password_hash'] . "\n";
    // Check common passwords
    $common = ['admin', 'admin123', 'password', 'password123', 'adminciamis', 'dispar123', '123456', '12345678'];
    foreach ($common as $p) {
        if (password_verify($p, $a['password_hash'])) {
            echo "-> MATCHED PASSWORD: " . $p . "\n";
        }
    }
    echo "---------------------------\n";
}
unlink(__FILE__);
