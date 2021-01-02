<?php
namespace App\Controller;

use App\Controller\AppController;

class RecettesController extends AppController
{
    public function initialize():void
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {
        $recettes = $this->Paginator->paginate($this->Recettes->find());
        $this->set(compact('recettes'));
    }

    public function view($slug)
    {
        $recette = $this->recettes->findBySlug($slug)->firstOrFail();
        $this->set(compact('recette'));
    }

    public function add()
    {
        $recette = $this->recettes->newEmptyEntity();
        if ($this->request->is('post')) {
            $recette = $this->recettes->patchEntity($recette, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $recette->user_id = 1;

            if ($this->recettes->save($recette)) {
                $this->Flash->success(__('Your recette has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your recette.'));
        }
        $this->set('recette', $recette);
    }

    public function AfficherRecette(){
        // partie de sql
		require 'Model/install.php';

		$sql=new SqlDB();
		$sql->RecettesSql();
		$sql->Test2();
		
		$prem_choix="";
		
		//utilisation de fichie Donnees_inc
		include 'Donnees.inc.php';
					
		//option de premier categorie
		foreach($Hierarchie as $categorie=>$sous_categorie){
			$prem_choix .= '<option value="'.$categorie.'">'.$categorie.'</option>';
        }
        

	}
    }

}
?>

	
}

/**
 * Controleur
 */
class Controleur
{
    protected $_controller;
    protected $_action;
    protected $_view;

    // construct de controleur
    public function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_view = new View($controller, $action);
    }

    // assigner value
    public function assign($name, $value)
    {
        $this->_view->assign($name, $value);
    }

    // mettre a jour view
    public function render()
    {
        $this->_view->render();
    }
}