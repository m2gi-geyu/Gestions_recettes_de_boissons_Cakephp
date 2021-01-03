<?php // la base de donnees, les tables et insere les donnees 
//tester et executer

namespace App\Model;

use Cake\Core\App;

function Test($link,$requete)
	{ 
		//init execute time
		ini_set("max_execution_time",180000);
		set_time_limit(0);
		
		//test
		$resultat=mysqli_query($link,$requete) or die("$requete : ".mysqli_error($link));
		return($resultat);
	}
	
//remplacer les symboles special
function replace_specialChar($strParam){
	if(check_str($strParam)){
		$regex = "/\/|\～|\，|\。|\！|\？|\“|\”|\【|\】|\『|\』|\：|\；|\《|\》|\’|\‘|\ |\·|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
		return preg_replace($regex," ",$strParam);
	}
	return $strParam;
}
	
//tester si il y a les symboles special
function check_str($str){
	$res = preg_match("/\/|\～|\，|\。|\！|\？|\“|\”|\【|\】|\『|\』|\：|\；|\《|\》|\’|\‘|\ |\·|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/", $str);
	return $res ? TRUE : FALSE;
}
	
class install{



	// creation de table et inserer les donnees
	public function RecettesSql()
	{ 
	
	
		//connexion de sql et inserer les donnees
		$mysqli=mysqli_connect('127.0.0.1', 'root', '') or die("Erreur de connexion");
		$base="boisson_db";
		$Sql="
				DROP DATABASE IF EXISTS $base;
				CREATE DATABASE $base;
				USE $base;";

		include 'Donnees.inc.php';
		
		//create table
		$Sql .= 'CREATE TABLE Hierarchie (id INT PRIMARY KEY AUTO_INCREMENT ,nom VARCHAR(255) NOT NULL,sous VARCHAR(255), super VARCHAR(255));';
		$Sql .= 'CREATE TABLE HierarchieResearch(id INT PRIMARY KEY AUTO_INCREMENT,nom VARCHAR(255) NOT NULL);' ;
		
		//array Hierarchie
		foreach($Hierarchie as $categorie=>$contenu_categorie){
			
			// supprimer " ' " commme " Partie d'orange " pour eviter bug
			$Content1 = addslashes($categorie);
			if ( get_magic_quotes_gpc ()){  // s'il n'y a pas de "'" dedans
				$Content1 = stripslashes ( $Content1 ); 
			}
			
			//s'il existe sous-categorie dans ce array
			if(array_key_exists('sous-categorie', $contenu_categorie)){				
				foreach($contenu_categorie['sous-categorie'] as $numero=>$sous_categorie)
				{
					// supprimer " ' " commme " Partie d'orange " pour eviter bug
					$Content2 = addslashes($sous_categorie);
					if ( get_magic_quotes_gpc ()){  // s'il n'y a pas de "'" dedans
						$Content2 = stripslashes ( $Content2 ); 
					}
					
					if(array_key_exists('super-categorie', $contenu_categorie)){
						foreach($contenu_categorie['super-categorie'] as $numero=>$super_categorie)
						{
							// supprimer " ' " commme " Partie d'orange " pour eviter bug
							$Content3 = addslashes($super_categorie);
							if ( get_magic_quotes_gpc ()){  // s'il n'y a pas de "'" dedans
							   $Content3 = stripslashes ( $Content3 ); 
							}
							
							//inserer table
							$Sql .= "INSERT INTO Hierarchie(nom,sous,super) VALUES ('$Content1','$Content2','$Content3');";
						}
					}else{
							
							//inserer table sans super_categorie
							$Sql .= "INSERT INTO Hierarchie(nom,sous) VALUES ('$Content1','$Content2');";
					}
				}
			}
			else{
				if(array_key_exists('super-categorie', $contenu_categorie)){
					foreach($contenu_categorie['super-categorie'] as $numero=>$super_categorie)
					{
						// supprimer " ' " commme " Partie d'orange " pour eviter bug
						$Content3 = addslashes($super_categorie);
						if ( get_magic_quotes_gpc ()){  // s'il n'y a pas de "'" dedans
							$Content3 = stripslashes ( $Content3 ); 
						}
							
						//inserer table
						$Sql .= "INSERT INTO Hierarchie(nom,super) VALUES ('$Content1','$Content3');";
					}
				}else{
							
					//inserer table sans super_categorie
					$Sql .= "INSERT INTO Hierarchie(nom) VALUES ('$Content1');";
				}
			}
		}	
	
		//create table
		$Sql .= 'CREATE TABLE Recettes (id INT NOT NULL,titre VARCHAR(255) NOT NULL,ingredients TEXT NOT NULL,preparation TEXT );' ;
		$Sql .= 'CREATE TABLE Prefers (id INT  NOT NULL,titre VARCHAR(255) NOT NULL,idRecette INT);' ;
		$Sql .= 'CREATE TABLE SousRecettes (idRecette INT NOT NULL,pre_index INT NOT NULL,nom  VARCHAR(255));' ;
		

		//array Recettes
		$id=0;
		foreach($Recettes as $index=>$contenu_recettes){
			$titre =mysqli_real_escape_string($mysqli,$contenu_recettes['titre']);
			$ingredients=replace_specialChar($contenu_recettes['ingredients']);
			$preparation=replace_specialChar($contenu_recettes['preparation']);
			$Sql .= "INSERT INTO Recettes VALUES ('$id','$titre','$ingredients','$preparation');";
			$id++;
			foreach($contenu_recettes['index'] as $pre_index=>$sous_recettes)
			{
				$sous_recettes = addslashes($sous_recettes);
				if ( get_magic_quotes_gpc ()){  // s'il n'y a pas de "'" dedans
					  $$sous_recettes = stripslashes ( $sous_recettes ); 
				}
				
				//inserer table

				$Sql .= "INSERT INTO SousRecettes VALUES ('$index','$pre_index','$sous_recettes');";
			}
		}	
		
		//table users pour connexion
		$Sql .= 'CREATE TABLE users (id INT(11) PRIMARY KEY AUTO_INCREMENT,identifiant VARCHAR(255) UNIQUE NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255), prenom VARCHAR(255), sexe VARCHAR(255),AdrElectonique VARCHAR(255), DateNaissance DATE, AdressePostale VARCHAR(255), telephone VARCHAR(255));' ;
		
		//supprimer denriere ; pour eviter query null
		$Sql = substr($Sql,0,strlen($Sql)-1); 
				
		//tester et executer
		foreach(explode(';',$Sql) as $Requete) Test($mysqli,$Requete);

		mysqli_close($mysqli);


	}

	
	// select from BD
	public function Test2()
	{ 
		//connexion de sql
		$mysqli=mysqli_connect('127.0.0.1', 'root', '') or die("Erreur de connexion");
		$base="boisson_db";
		$Sql="
			USE $base";
		
		foreach(explode(';',$Sql) as $Requete) Test($mysqli,$Requete);		
		
		$query = "SELECT * FROM Hierarchie";
				
		$resultat = $mysqli->query($query);

		mysqli_close($mysqli);
		
		while($nuplet = $resultat->fetch_assoc())
		{ 
			echo "\t".$nuplet["nom"]."\n";
		}
		
		return $resultat;
	}
	
	// select from BD
	public function DeleteSearch()
	{ 
		//connexion de sql
		$mysqli=mysqli_connect('127.0.0.1', 'root', '') or die("Erreur de connexion");
		$base="boisson_db";
		$Sql="
			USE $base";
		
		foreach(explode(';',$Sql) as $Requete) Test($mysqli,$Requete);		
		
		//$query = "DROP TABLE HierarchieResearch;";
		$query = 'delete From HierarchieResearch;' ;
		$query .= "INSERT INTO HierarchieResearch VALUES ('441','Aliment')";
		
		foreach(explode(';',$query) as $Requete) Test($mysqli,$Requete);
		//$resultat = $mysqli->query($query);

		mysqli_close($mysqli);
		
	}
}
?>