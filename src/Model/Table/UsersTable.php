<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\ORM\Rule\IsUnique;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        
        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create')
            ->notEmptyString('username')
            ->add('username', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
            ]);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('role')
            ->maxLength('role', 20)
            ->inList('role', ['user', 'admin'])
            ->allowEmptyString('role');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username']));
        return $rules;
    }

    public function beforeSave($event, $entity, $options)
    {
        if ($entity->isNew() || $entity->isDirty('password')) {
            $entity->password = password_hash($entity->password, PASSWORD_DEFAULT);
        }
        return true;
    }
}


