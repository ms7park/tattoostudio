<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Tattoo extends Entity
{
    protected $_accessible = [
        'title' => true,
        'description' => true,
        'image_path' => true,
        'created' => true,
        'modified' => true,
    ];
}

