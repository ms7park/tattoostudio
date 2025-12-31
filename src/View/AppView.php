<?php
declare(strict_types=1);

namespace App\View;

use Cake\View\View;

class AppView extends View
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadHelper('Html', ['className' => 'App.Html']);
        $this->loadHelper('Form', ['className' => 'App.Form']);
        $this->loadHelper('Flash');
    }
}



