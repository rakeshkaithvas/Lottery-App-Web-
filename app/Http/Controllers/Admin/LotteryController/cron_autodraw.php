<?php

use App\Http\Controllers\Admin\LotteryController\LotteryController;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Define a log file path
$logFile = __DIR__ . '/storage/logs/cron_autodraw.log';

// Write a timestamp to the log to confirm execution
file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Cron started\n", FILE_APPEND);

try {
    $controller = new LotteryController();
    $result = $controller->autoDraw(); // Ensure autoDraw doesn't need a parameter

    // Log success
    file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] autoDraw ran successfully.\n", FILE_APPEND);
    file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Result: " . print_r($result, true) . "\n", FILE_APPEND);
} catch (\Throwable $e) {
    // Log any errors
    file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Error: " . $e->getMessage() . "\n", FILE_APPEND);
}