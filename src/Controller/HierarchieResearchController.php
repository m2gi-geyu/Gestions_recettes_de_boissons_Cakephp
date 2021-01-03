<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


class HierarchieResearchController extends AppController
{
    public function initialize():void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {
        $prefers = $this->Paginator->paginate($this->Prefers->find());
        $this->set(compact('HierarchieResearch'));
    }
}
?>