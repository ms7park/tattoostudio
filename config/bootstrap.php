<?php
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Utility\Security;
use Cake\Datasource\ConnectionManager;

require_once 'paths.php';
require_once ROOT . DS . 'vendor' . DS . 'cakephp' . DS . 'cakephp' . DS . 'src' . DS . 'Core' . DS . 'functions.php';

Configure::config('default', new PhpConfig(CONFIG));
Configure::load('app', 'default', false);

// Security salt 설정
Security::setSalt(Configure::read('Security.salt'));

// 데이터베이스 연결 설정
try {
    $dbConfig = Configure::read('Datasources.default');
    if ($dbConfig) {
        // url이 null이면 제거
        if (isset($dbConfig['url']) && $dbConfig['url'] === null) {
            unset($dbConfig['url']);
        }
        ConnectionManager::setConfig('default', $dbConfig);
    }
} catch (\Exception $e) {
    // 데이터베이스 연결 실패 시에도 애플리케이션이 작동하도록 함
    // 로그에 기록하거나 무시
}

