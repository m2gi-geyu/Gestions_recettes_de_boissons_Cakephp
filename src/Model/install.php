<?php // la base de donnees, les tables et insere les donnees 
//tester et executer
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
		return preg_replace($regex,"",$strParam);
	}
	return $strParam;
}
	
//tester si il y a les symboles special
function check_str($str){
	$res = preg_match("/\/|\～|\，|\。|\！|\？|\“|\”|\【|\】|\『|\』|\：|\；|\《|\》|\’|\‘|\ |\·|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/", $str);
	return $res ? TRUE : FALSE;
}
	
class SqlDB{



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
		$Sql .= 'CREATE TABLE sous_categorie (nom VARCHAR(255) NOT NULL,sous VARCHAR(255) NOT NULL);' ;
		$Sql .= 'CREATE TABLE super_categorie (nom VARCHAR(255) NOT NULL,super VARCHAR(255) NOT NULL);' ;
		
		//array Hierarchie
		foreach($Hierarchie as $categorie=>$contenu_categorie){
			//s'il existe sous-categorie dans ce array
			if(array_key_exists('sous-categorie', $contenu_categorie)){				
				foreach($contenu_categorie['sous-categorie'] as $numero=>$sous_categorie)
				{
					// supprimer " ' " commme " Partie d'orange " pour eviter bug
					$Content1 = addslashes($categorie);
					if ( get_magic_quotes_gpc ()){  // s'il n'y a pas de "'" dedans
					   $Content1 = stripslashes ( $Content1 ); 
					}
					$Content2 = addslashes($sous_categorie);
					if ( get_magic_quotes_gpc ()){  // s'il n'y a pas de "'" dedans
					   $Content1 = stripslashes ( $Content2 ); 
					}
					
					//inserer table
					$Sql .= "INSERT INTO sous_categorie VALUES ('$Content1','$Content2');";
				}
			}
			
			//s'il existe super-categorie dans ce array
			if(array_key_exists('super-categorie', $contenu_categorie)){
				foreach($contenu_categorie['super-categorie'] as $numero=>$super_categorie)
				{
					// supprimer " ' " commme " Partie d'orange " pour eviter bug
					$Content1 = addslashes($categorie);
					if ( get_magic_quotes_gpc ()){  // s'il n'y a pas de "'" dedans
					   $Content1 = stripslashes ( $Content1 ); 
					}
					$Content2 = addslashes($super_categorie);
					if ( get_magic_quotes_gpc ()){  // s'il n'y a pas de "'" dedans
					   $Content1 = stripslashes ( $Content2 ); 
					}
					
					//inserer table
					$Sql .= "INSERT INTO super_categorie VALUES ('$Content1','$Content2');";
				}
			}
		}	
	
		//create table
		$Sql .= 'CREATE TABLE Recettes (num_recette INT NOT NULL,titre VARCHAR(255) NOT NULL,ingredients VARCHAR(255) NOT NULL,preparation TEXT ,pre_index INT NOT NULL,sous_recettes  VARCHAR(255) NOT NULL );' ;
		$Sql .= 'CREATE TABLE Prefers (num_recette INT NOT NULL,titre VARCHAR(255) NOT NULL,num_prefers INT);' ;
		
		//array Recettes
		foreach($Recettes as $index=>$contenu_recettes){
			foreach($contenu_recettes['index'] as $pre_index=>$sous_recettes)
			{
				// supprimer " ' " commme " Partie d'orange " pour eviter bug
				$titre =mysqli_real_escape_string($mysqli,$contenu_recettes['titre']);
				$ingredients=replace_specialChar($contenu_recettes['ingredients']);
				$preparation=replace_specialChar($contenu_recettes['preparation']);
				$sous_recettes = addslashes($sous_recettes);
				if ( get_magic_quotes_gpc ()){  // s'il n'y a pas de "'" dedans
					  $$sous_recettes = stripslashes ( $sous_recettes ); 
				}
				
				//inserer table
				$Sql .= "INSERT INTO Recettes VALUES ('$index','$titre','$ingredients','$preparation','$pre_index','$sous_recettes');";
				$Sql .= "INSERT INTO Prefers (num_recette,titre) VALUES ('$index','$titre');";
			}
		}	
		
		//supprimer denriere ; pour eviter query null
		$Sql = substr($Sql,0,strlen($Sql)-1); 
				
		//test
		foreach(explode(';',$Sql) as $Requete) Test($mysqli,$Requete);

		$query2 = "SELECT * FROM sous_categorie";
		
		$resultat2 = $mysqli->query($query2);

		mysqli_close($mysqli);

		while($nuplet2 = $resultat2->fetch_assoc())
			{ 
				echo "\t".$nuplet2["nom"]."\n";
			}
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
		
		$query = "SELECT * FROM sous_categorie";
				
		$resultat = $mysqli->query($query);

		mysqli_close($mysqli);
		
		while($nuplet = $resultat->fetch_assoc())
			{ 
				echo "\t".$nuplet["nom"]."\n";
			}
	}
}
?>