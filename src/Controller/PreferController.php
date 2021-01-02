<?php

namespace App\Controller;

use App\Controller\AppController;

class PanierController extends AppController
{
    public function initialize():void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {
        $recettes = $this->Paginator->paginate($this->Prefers->find());
        $this->set(compact('prefers'));
    }

    public function view($id)
    {
        $recette = $this->Recettes->get($id);
        $this->set(compact('recettes'));
    }


public function delete($id)
{
    $this->request->allowMethod(['post', 'delete']);
    $prefer = $this->Prefers->find()->where([id==$id]);
    if ($this->Prefers->delete($prefer)) {
        $this->Flash->success(__(' {0}  est enlevé.', $prefer->title));
        return $this->redirect(['action' => 'index']);
    }
}
}
?>