<?php
/**
 * 테스트 페이지
 * 
 * 접근 방법:
 * - 올바른 URL: http://localhost:8000/test.php
 * - 잘못된 URL: http://localhost:8000/webroot/test.php (404 오류 발생)
 */

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>테스트 페이지</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .info-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
        }
        .success {
            color: #28a745;
            font-weight: bold;
        }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="info-box">
        <h1>✅ 테스트 페이지</h1>
        <p class="success">PHP가 정상적으로 작동하고 있습니다!</p>
    </div>

    <div class="info-box">
        <h2>서버 정보</h2>
        <ul>
            <li><strong>PHP 버전:</strong> <?php echo phpversion(); ?></li>
            <li><strong>서버 소프트웨어:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'PHP Built-in Server'; ?></li>
            <li><strong>Document Root:</strong> <?php echo $_SERVER['DOCUMENT_ROOT'] ?? 'N/A'; ?></li>
            <li><strong>현재 스크립트:</strong> <?php echo $_SERVER['SCRIPT_NAME'] ?? 'N/A'; ?></li>
        </ul>
    </div>

    <div class="info-box">
        <h2>URL 접근 방법</h2>
        <p><strong>올바른 URL:</strong></p>
        <ul>
            <li><code>http://localhost:8000/test.php</code> ✅</li>
            <li><code>http://localhost:8000/</code> (메인 페이지)</li>
            <li><code>http://localhost:8000/upload</code> (업로드 페이지)</li>
        </ul>
        <p><strong>잘못된 URL:</strong></p>
        <ul>
            <li><code>http://localhost:8000/webroot/test.php</code> ❌ (404 오류)</li>
        </ul>
        <p><em>참고: PHP 내장 서버는 <code>-t webroot</code> 옵션으로 실행되어 webroot가 document root입니다.</em></p>
    </div>

    <div class="info-box">
        <h2>PHP 정보</h2>
        <p><a href="?phpinfo=1">PHP 정보 보기</a></p>
        <?php if (isset($_GET['phpinfo'])): ?>
            <hr>
            <?php phpinfo(); ?>
        <?php endif; ?>
    </div>
</body>
</html>



