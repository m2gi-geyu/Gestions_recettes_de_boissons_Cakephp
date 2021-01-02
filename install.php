<?php // la base de donnees, les tables et insere les donnees 
function Test($link,$requete)
	{ 
		$resultat=mysqli_query($link,$requete) or die("$requete : ".mysqli_error($link));
		return($resultat);
	}

function replace_specialChar($strParam){
	$regex = "/\/|\～|\，|\。|\！|\？|\“|\”|\【|\】|\『|\』|\：|\；|\《|\》|\’|\‘|\ |\·|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
    return preg_replace($regex,"",$strParam);
}	
	
class SqlDB{



	// creation de table et inserer les donnees
	public function RecettesSql()
	{ 
	
	
		//connexion de sql et inserer les donnees
		$mysqli=mysqli_connect('127.0.0.1', 'root', '') or die("Erreur de connexion");
		$base="boisson_db";
		$Sql="	DROP DATABASE IF EXISTS $base;
				CREATE DATABASE $base;
				USE $base;";

		include 'Donnees.inc.php';
		
		
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
					$Sql .= "INSERT INTO sous_categorie VALUES ('$Content1','$Content2');";
				}
			}
			
	/*		//s'il existe super-categorie dans ce array
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
					$Sql .= "INSERT INTO super_categorie VALUES ('$Content1','$Content2');";
				}
			}*/
		}	
	/*

		$Sql .= 'CREATE TABLE Recettes (num_recette INT NOT NULL,titre VARCHAR(255) NOT NULL,ingredients VARCHAR(255) NOT NULL,preparation TEXT ,pre_index INT NOT NULL,sous_recettes  VARCHAR(255) NOT NULL );' ;
		//array Recettes
		foreach($Recettes as $index=>$contenu_recettes){
			foreach($contenu_recettes['index'] as $pre_index=>$sous_recettes)
			{
				//echo $contenu_recettes['titre'].'<br>';
				//echo $contenu_recettes['ingredients'].'<br>';
				//echo $contenu_recettes['preparation'].'<br>';
				//echo $pre_index.'<br>';
				//echo $sous_recettes.'<br>';
				
				// supprimer " ' " commme " Partie d'orange " pour eviter bug
				$titre =mysqli_real_escape_string($mysqli,$contenu_recettes['titre']);

				$ingredients=replace_specialChar($contenu_recettes['ingredients']);

				$preparation=replace_specialChar($contenu_recettes['preparation']);

				$sous_recettes = addslashes($sous_recettes);
				if ( get_magic_quotes_gpc ()){  // s'il n'y a pas de "'" dedans
					  $$sous_recettes = stripslashes ( $sous_recettes ); 
				}
				$Sql .= "INSERT INTO Recettes VALUES ('$index','$titre','$ingredients','$preparation','$pre_index','$sous_recettes');";
			}
			
		}	*/
				
		$Sql = substr($Sql,0,strlen($Sql)-1); 
				
		$query = "SELECT * FROM region";
				
		foreach(explode(';',$Sql) as $Requete) Test($mysqli,$Requete);

		$resultat = $mysqli->query($query);
		
		$query2 = "SELECT * FROM sous_categorie";
		
		$resultat2 = $mysqli->query($query2);

		mysqli_close($mysqli);

		while($nuplet = $resultat->fetch_assoc())
			{ 
				echo "\t".$nuplet["lib"]."\n";
			}
			
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
		$base="Regions";
		$Sql="
			USE $base";
		
		foreach(explode(';',$Sql) as $Requete) Test($mysqli,$Requete);		
		
		$query = "SELECT * FROM departement";
				


		$resultat = $mysqli->query($query);

		mysqli_close($mysqli);
		
		while($nuplet = $resultat->fetch_assoc())
			{ 
				echo "\t".$nuplet["lib"]."\n";
			}
	}
}
?>