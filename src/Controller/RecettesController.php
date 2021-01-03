<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;

class RecettesController extends AppController
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
     * présenter interface de recettes
     */
    public function index()
    {
        $recettes = $this->Paginator->paginate($this->Recettes->find());
        $this->set(compact('recettes'));
    }


    /**
     * @method view($id)
     * présenter le contenu du recette
     */
    public function view($id)
    {
        $recette = $this->Recettes->find()->where(['id'=>$id])->first();      
        $sousRecettes = TableRegistry::get('sousRecettes');
        $query = $sousRecettes->find('all')->where(['idRecette'=>$id])->all();   
        $this->set('recette',$recette);
        $this->set('sousRecettes',$query);
    }

    /**
     * @method add($id)
     * ajouter la recette préférée
     */
    public function add($id)
    {
        $this->request->allowMethod(['post', 'add']);
        $prefers = TableRegistry::get('prefers');
        $recette=$this->Recettes->find()->where(['id'=>$id])->first();
        $prefer=$prefers->newEmptyEntity();
        $query = $prefers->find('all')->where(['idRecette'=>$id])->all();  
        $preferlast = $prefers->find('all')->last(); 
        if(!empty($query)){
            $this->Flash->error(__('il est déjà dans recettes préférées'));
            return $this->redirect(['action' => 'index']);
        }
        if(empty($preferlast)){
            $prefer->id=0;
        } else{
            $prefer->id=$preferlast->id+1;
        }
        $prefer->titre=$recette->titre;
        $prefer->idRecette=$recette->id;
        if ($prefers->save($prefer)) {
            $this->Flash->success(__(' Ajoute réussi.'));
            $query=$prefers->find()->all();
            $this->set('prefers',$query);
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
