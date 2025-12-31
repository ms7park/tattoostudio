<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'username', 'password' => 'password'],
                    'userModel' => 'Users',
                    'passwordHasher' => [
                        'className' => 'Default'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'Tattoos',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Tattoos',
                'action' => 'index'
            ],
            'unauthorizedRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'authError' => '이 페이지에 접근하려면 로그인이 필요합니다.',
            'storage' => 'Session'
        ]);
    }
}


