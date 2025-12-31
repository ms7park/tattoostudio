<?php
/**
 * 관리자 계정 생성 스크립트
 * 
 * 사용 방법:
 * php config/create_admin.php username password
 * 
 * 예시:
 * php config/create_admin.php admin mypassword
 */

require dirname(__DIR__) . '/vendor/autoload.php';

use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Utility\Security;

require_once dirname(__DIR__) . '/config/paths.php';
require_once ROOT . DS . 'vendor' . DS . 'cakephp' . DS . 'cakephp' . DS . 'src' . DS . 'Core' . DS . 'functions.php';

Configure::config('default', new PhpConfig(CONFIG));
Configure::load('app', 'default', false);
Security::setSalt(Configure::read('Security.salt'));

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

// 데이터베이스 연결 설정
$dbConfig = Configure::read('Datasources.default');
// url이 null이면 제거
if (isset($dbConfig['url']) && $dbConfig['url'] === null) {
    unset($dbConfig['url']);
}
ConnectionManager::setConfig('default', $dbConfig);

// 명령줄 인자 확인
$username = $argv[1] ?? null;
$password = $argv[2] ?? null;

if (!$username || !$password) {
    echo "사용법: php config/create_admin.php <username> <password>\n";
    echo "예시: php config/create_admin.php admin mypassword\n";
    exit(1);
}

try {
    $usersTable = TableRegistry::getTableLocator()->get('Users');
    
    // 기존 사용자 확인
    $existingUser = $usersTable->find()
        ->where(['username' => $username])
        ->first();
    
    if ($existingUser) {
        // 기존 사용자를 관리자로 업데이트
        $existingUser->password = $password;
        $existingUser->role = 'admin';
        if ($usersTable->save($existingUser)) {
            echo "✅ 사용자 '$username'가 관리자로 업데이트되었습니다.\n";
        } else {
            echo "❌ 사용자 업데이트 실패\n";
            exit(1);
        }
    } else {
        // 새 관리자 계정 생성
        $user = $usersTable->newEntity([
            'username' => $username,
            'password' => $password,
            'role' => 'admin'
        ]);
        
        if ($usersTable->save($user)) {
            echo "✅ 관리자 계정 '$username'가 생성되었습니다.\n";
        } else {
            echo "❌ 계정 생성 실패:\n";
            foreach ($user->getErrors() as $field => $errors) {
                foreach ($errors as $error) {
                    echo "  - $field: $error\n";
                }
            }
            exit(1);
        }
    }
} catch (\Exception $e) {
    echo "❌ 오류 발생: " . $e->getMessage() . "\n";
    echo "데이터베이스 연결 및 users 테이블이 올바르게 설정되었는지 확인하세요.\n";
    exit(1);
}

