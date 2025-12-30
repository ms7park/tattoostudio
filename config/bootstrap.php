<?php
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Utility\Security;

require_once 'paths.php';
require_once ROOT . DS . 'vendor' . DS . 'cakephp' . DS . 'cakephp' . DS . 'src' . DS . 'Core' . DS . 'functions.php';

Configure::config('default', new PhpConfig(CONFIG));
Configure::load('app', 'default', false);

// Security salt 설정
Security::setSalt(Configure::read('Security.salt'));

