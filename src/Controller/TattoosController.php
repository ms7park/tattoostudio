<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;

class TattoosController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->Auth->allow(['index']);
    }
    
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // add 액션은 관리자만 접근 가능
        if (in_array($this->request->getParam('action'), ['add'])) {
            $user = $this->Auth->user();
            if (!$user || $user['role'] !== 'admin') {
                $this->Flash->error('이미지 업로드는 관리자만 가능합니다.');
                return $this->redirect(['action' => 'index']);
            }
        }
    }

    public function index()
    {
        try {
            $tattoosTable = TableRegistry::getTableLocator()->get('Tattoos');
            $tattoos = $tattoosTable->find()
                ->order(['created' => 'DESC'])
                ->toArray();
        } catch (\Exception $e) {
            $tattoos = [];
        }

        $this->set(compact('tattoos'));
    }

    public function add()
    {
        $tattoosTable = TableRegistry::getTableLocator()->get('Tattoos');
        $tattoo = $tattoosTable->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            if (!empty($data['image']['tmp_name'])) {
                $uploadPath = WWW_ROOT . 'img' . DS . 'tattoos' . DS;
                
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                $fileName = time() . '_' . basename($data['image']['name']);
                $targetPath = $uploadPath . $fileName;
                
                if (move_uploaded_file($data['image']['tmp_name'], $targetPath)) {
                    $tattoo = $tattoosTable->patchEntity($tattoo, [
                        'title' => $data['title'] ?? '',
                        'description' => $data['description'] ?? '',
                        'image_path' => 'tattoos/' . $fileName,
                    ]);
                    
                    if ($tattoosTable->save($tattoo)) {
                        $this->Flash->success('타투 이미지가 업로드되었습니다.');
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error('저장 중 오류가 발생했습니다.');
                    }
                } else {
                    $this->Flash->error('이미지 업로드에 실패했습니다.');
                }
            } else {
                $this->Flash->error('이미지를 선택해주세요.');
            }
        }
        
        $this->set(compact('tattoo'));
    }
}

