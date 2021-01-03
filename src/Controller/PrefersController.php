<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


class PrefersController extends AppController
{
    /**
     * initialiser les outils
     */
    public function initialize():void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

     /**
     * @method index()
     * présenter interface de prefers
     */
    public function index()
    {
        //$preferUser=$this->Prefers->find('all')->where(['idUser'=>$idUser])->all();
        $prefers = $this->Paginator->paginate($this->Prefers->find());
        $this->set('prefers',$prefers);
    }

    /**
     * @method view($idRecette)
     * $idRecette:id du idRecette
     * supprimer une prefer associé id
     */
    public function view($idRecette)
    {
        $sousRecettes = TableRegistry::get('sousRecettes');
        $recettes = TableRegistry::get('recettes');
        $recette = $recettes->find()->where(['id'=>$idRecette])->first();      
        $query = $sousRecettes->find('all')->where(['idRecette'=>$idRecette])->all();  
        $this->set('recette',$recette);
        $this->set('sousRecettes',$query);
    }


    /**
     * @method delete($id)
     * $id:id du prefer
     * supprimer une prefer associé id
     */
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $prefer = $this->Prefers->find('all')->where(['id'=>$id])->all();   
        if ($this->Prefers->deleteAll(['Prefers.id'=>$id])) {
            $this->Flash->success(__(' Recette est enlevé.'));
            return $this->redirect(['action' => 'index']);
        }
    }

     /**
     * @method retourner()
     *  retourner le interface user
     */
    public function retourner(){
		$redirect = $this->request->getQuery('redirect', [
            'controller' => 'src',
            'action' => 'index',
        ]);

        return $this->redirect($redirect);
        return $this->redirect(['action' => 'index']);
	}
}
?>