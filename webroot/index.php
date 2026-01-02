<?php
/**
 * CakePHP index.php
 */
// Check platform requirements
// 프로젝트 루트 경로를 절대 경로로 설정
$rootDir = dirname(__DIR__);
$rootDir = realpath($rootDir) ?: $rootDir;

// 작업 디렉토리를 프로젝트 루트로 변경
chdir($rootDir);

error_reporting(E_ALL);
ini_set('display_errors', '1');

require $rootDir . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Application;
use Cake\Http\Server;

try {
    // Bind your application to the server.
    $configPath = $rootDir . DIRECTORY_SEPARATOR . 'config';
    $server = new Server(new Application($configPath));

    // Run the request/response through the application and emit the response.
    $server->emit($server->run());
} catch (\Throwable $e) {
    // CakePHP 에러 핸들러를 우회하여 실제 오류 표시
    http_response_code(500);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Error</title></head><body>';
    echo '<h1>Application Error</h1>';
    echo '<pre style="background: #f5f5f5; padding: 20px; border: 1px solid #ddd; overflow: auto;">';
    echo 'Message: ' . htmlspecialchars($e->getMessage()) . "\n\n";
    echo 'File: ' . $e->getFile() . "\n";
    echo 'Line: ' . $e->getLine() . "\n\n";
    echo 'Root Dir: ' . $rootDir . "\n";
    echo 'Config Path: ' . $configPath . "\n\n";
    echo "Stack Trace:\n";
    echo htmlspecialchars($e->getTraceAsString());
    echo '</pre></body></html>';
    exit(1);
}
