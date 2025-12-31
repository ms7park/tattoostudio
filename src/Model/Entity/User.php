<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    protected $_accessible = [
        'username' => true,
        'password' => true,
        'role' => true,
        'created' => true,
        'modified' => true,
    ];

    protected $_hidden = [
        'password',
    ];
}


