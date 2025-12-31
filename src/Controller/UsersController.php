<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Auth->allow(['logout']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success('로그인되었습니다.');
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error('사용자명 또는 비밀번호가 올바르지 않습니다.');
            }
        }
    }

    public function logout()
    {
        $this->Flash->success('로그아웃되었습니다.');
        return $this->redirect($this->Auth->logout());
    }
}


