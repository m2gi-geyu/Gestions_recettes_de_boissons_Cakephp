<?php

namespace App\Controller;

use App\Model\install;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;

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
		$this->loadModel('HierarchieResearch');
		$this->loadModel('sousrecettes');
		//$this->loadModel('Recettes');
		
		$Hierarchie=$this->Hierarchie->find();
		$HierarchieResearch=$this->HierarchieResearch->find();
		$sousrecettes=$this->sousrecettes->find();
		//$recettes=$this->recettes->find();
		
        $this->set(compact('Hierarchie'));
		$this->set(compact('HierarchieResearch'));
		$this->set(compact('sousrecettes'));
		//$this->set(compact('recettes'));
		
		$recettes = TableRegistry::get('Recettes');
		$recette=$recettes->find();
		$this->set('recettes',$recette);
    }
	
	public function add($id)
    {
		
		$this->request->allowMethod(['post', 'add']);
        $searches = TableRegistry::get('hierarchieResearch');
        $item=$this->Hierarchie->find()->where(['id'=>$id])->first();
        $search=$searches->newEmptyEntity();
        $query = $searches->find('all')->where(['id'=>$id])->all();  
        $searchlast = $searches->find('all')->last(); 
        if(empty($query)){
            $this->Flash->error(__('il est déjà dans recettes préférées'));
            return $this->redirect(['action' => 'index']);
        }
        //$search->id=$item->id;
        $search->nom=$item->sous;
        if ($searches->save($search)) {
            $this->Flash->success(__(' Ajoute réussi.'));
            $query=$searches->find()->all();
            $this->set('searches',$query);
            return $this->redirect(['action' => 'index']);
        }
		
    }
	
	public function vider()
    {
        $this->request->allowMethod(['post', 'vider']);

		$install=new install();
		$install->DeleteSearch();
		$this->Flash->success(__('déja vidé'));
		
		
		$redirect = $this->request->getQuery('redirect', [
				'controller' => 'Hierarchie',
				'action' => 'index',
			]);
		return $this->redirect($redirect);
		
    }

}