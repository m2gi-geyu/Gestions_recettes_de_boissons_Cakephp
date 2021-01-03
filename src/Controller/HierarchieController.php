<?php

namespace App\Controller;

class HierarchieController extends AppController
{

	
	public function initialize():void
    {
        parent::initialize();

       // $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }
	
	public function index()
    {
       // $Hierarchie = $this->Paginator->paginate($this->Hierarchie->find());
		$Hierarchie=$this->Hierarchie->find();
        $this->set(compact('Hierarchie'));
    }
	

}