<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$names = App\Models\DestinationPrice::pluck('destination_name');
echo json_encode($names, JSON_PRETTY_PRINT);
