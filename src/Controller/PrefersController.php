<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


class PrefersController extends AppController
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
        $this->set(compact('prefers'));
    }

    public function view($idRecette)
    {
        $sousRecettes = TableRegistry::get('sousRecettes');
        $recettes = TableRegistry::get('recettes');
        $recette = $recettes->find()->where(['id'=>$idRecette])->first();      
        $query = $sousRecettes->find('all')->where(['idRecette'=>$idRecette])->all();  
        $this->set('recette',$recette);
        $this->set('sousRecettes',$query);
    }


    public function delete($id)
    {
     
       return $this->redirect(['action' => 'index']);
        $this->request->allowMethod(['post', 'delete']);
        $prefer = $this->Prefers->find('all')->where(['id'=>$id])->all();   
        if ($this->Prefers->deleteAll(['Prefers.id'=>$id])) {
            $this->Flash->success(__(' Recette {0}  est enlevé.', $prefer->title));
            return $this->redirect(['action' => 'index']);
        }
    }
}
?>