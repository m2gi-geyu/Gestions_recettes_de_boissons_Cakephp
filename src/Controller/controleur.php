
<?php
class Control{
	//var $prem_choix;
	

	
	function AfficherControl(){
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
		
		//echo $prem_choix;
		
		
		
		require 'Vue/vue.php';
		require 'Model/modele.php';
		$vue=new Vue();
		$modele=new Modele();
		$data=$modele->Getid('02');
		$vue->Afficher($data);
		$data=$modele->Getid('01');
		$vue->Afficher($data);
		$data=$modele->Getid('03');
		$vue->Afficher($data);
		

	}
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
?>

