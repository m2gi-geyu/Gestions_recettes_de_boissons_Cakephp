<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\install;
use Cake\Core\App;
class SrcController extends AppController
{

	/*
	 * installer les donnees dans donnees.inc
	 */
	public function installer(){
		
		$this->request->allowMethod(['post', 'installer']);
		
		$install=new install();
		$install->RecettesSql();
		$this->Flash->success(__('déja installé'));

        return $this->redirect(['action' => 'index']);
	}

	/*
	 * page basic
	 */
    public function index(){

    }
	
	/*
	 * deplacer à page login
	 */
	public function connexion(){
		
		$redirect = $this->request->getQuery('redirect', [
				'controller' => 'Users',
				'action' => 'login',
			]);

			return $this->redirect($redirect);

        return $this->redirect(['action' => 'index']);
	}
	
	/*
	 * deplacer à page logout
	 */
	public function deconnexion(){
		
		$this->request->allowMethod(['post', 'deconneixon']);
		
		$redirect = $this->request->getQuery('redirect', [
				'controller' => 'Users',
				'action' => 'logout',
			]);
			$this->Flash->success(__('déjà déconnexsion'));
			return $this->redirect($redirect);

        return $this->redirect(['action' => 'index']);
	}
	
	/*
	 * deplacer à page recettes
	 */
	public function recettes(){
		
		$redirect = $this->request->getQuery('redirect', [
				'controller' => 'recettes',
				'action' => 'index',
			]);

			return $this->redirect($redirect);

        return $this->redirect(['action' => 'index']);
	}
	
	/*
	 * deplacer à page prefers
	 */
	public function prefers(){
		
		$redirect = $this->request->getQuery('redirect', [
				'controller' => 'prefers',
				'action' => 'index',
			]);

			return $this->redirect($redirect);

        return $this->redirect(['action' => 'index']);
	}

}
?>