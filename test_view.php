<?php
$_SERVER['APP_ENV'] = 'local';
$_SERVER['APP_KEY'] = 'base64:8TvgTBwbxDlM7G3/dkqQMgwRInOG730VqZeoR1RUKq8=';

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Http\Kernel::class);

try {
    $compiled = $app->make('view')
        ->getEngineResolver()
        ->resolve('blade')
        ->getCompiler()
        ->compileString(file_get_contents(__DIR__ . '/resources/views/blog/index.blade.php'));

    file_put_contents(__DIR__ . '/compiled_test.php', $compiled);
    echo "Compilation successful\n";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
