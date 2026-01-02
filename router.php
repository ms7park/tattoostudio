<?php
/**
 * PHP 내장 서버용 라우터 스크립트
 * 프로젝트 루트를 웹루트로 사용하면서 webroot로 요청을 라우팅
 */

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);

// 정적 파일 요청 처리 (CSS, JS, 이미지 등)
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$/i', $requestPath)) {
    // webroot에서 정적 파일 찾기
    $filePath = __DIR__ . '/webroot' . $requestPath;
    if (file_exists($filePath) && is_file($filePath)) {
        return false; // PHP 내장 서버가 파일을 직접 제공
    }
}

// webroot/index.php로 라우팅
$indexPath = __DIR__ . '/webroot/index.php';
if (file_exists($indexPath)) {
    // 경로 정보 수정
    $_SERVER['SCRIPT_NAME'] = '/webroot/index.php';
    $_SERVER['PHP_SELF'] = '/webroot/index.php';
    $_SERVER['DOCUMENT_ROOT'] = __DIR__;
    $_SERVER['REQUEST_URI'] = str_replace('/webroot', '', $_SERVER['REQUEST_URI']);
    
    // webroot/index.php 실행
    chdir(__DIR__);
    
    // 오류 표시 활성화
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    try {
        require $indexPath;
    } catch (\Throwable $e) {
        http_response_code(500);
        echo '<h1>Error:</h1>';
        echo '<pre>';
        echo 'Message: ' . htmlspecialchars($e->getMessage()) . "\n";
        echo 'File: ' . $e->getFile() . "\n";
        echo 'Line: ' . $e->getLine() . "\n";
        echo "\nStack Trace:\n";
        echo htmlspecialchars($e->getTraceAsString());
        echo '</pre>';
    }
    return true;
}

// 파일을 찾을 수 없으면 404
http_response_code(404);
echo "404 Not Found";
return true;

