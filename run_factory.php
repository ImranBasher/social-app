<?php
User::factory()->count(50)->create();
require 'vendor/autoload.php';

use App\Models\User;

// Bootstrapping Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

// Run the factory command
User::factory()->count(50)->create();
