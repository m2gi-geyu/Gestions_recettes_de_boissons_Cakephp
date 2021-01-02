<?php // la base de données, les tables et insère les données 
function Test($link,$requete)
	{ 
		$resultat=mysqli_query($link,$requete) or die("$requete : ".mysqli_error($link));
		return($resultat);
	}

class SqlDB{

	// création de table et insérer les données
	public function RecettesSql()
	{ 
		//connexion de sql et insérer les données
		$mysqli=mysqli_connect('127.0.0.1', 'root', '') or die("Erreur de connexion");
		$base="Regions";
		$Sql="
				DROP DATABASE IF EXISTS $base;
				CREATE DATABASE $base;
				USE $base;
				CREATE TABLE region (id INT AUTO_INCREMENT PRIMARY KEY, lib VARCHAR(255) NOT NULL);
				CREATE TABLE departement (id INT AUTO_INCREMENT PRIMARY KEY, region INT NOT NULL, lib VARCHAR(255) NOT NULL);
				
				INSERT INTO region VALUES (1, 'Lorraine');
				INSERT INTO region VALUES (2, 'Alsace');
				
				INSERT INTO departement VALUES (1, 1, 'Moselle');
				INSERT INTO departement VALUES (2, 1, 'Meurthe-et-Moselle');
				INSERT INTO departement VALUES (3, 1, 'Vosges');
				INSERT INTO departement VALUES (4, 1, 'Meuse');
				
				INSERT INTO departement VALUES (5, 2, 'Bas-Rhin');
				INSERT INTO departement VALUES (6, 2, 'Haut-Rhin')";
				
		include 'Donnees.inc.php';
		
		//option de premier categorie
		foreach($Hierarchie as $categorie=>$sous_categorie){
			foreach($sous_Hierarchie as $sous_categorie=>$contenu_categorie){
				if($sous_categorie=='sous-categorie')
				{
					echo "$contenu_categorie"
					/*foreach($contenu_categorie as $sous_categorie=>$contenu_categorie){
					$Sql .=	'INSERT INTO sous-categorie VALUES (6, 2, 'Haut-Rhin')' ;
					}*/
				}
				if($sous_categorie=='super-categorie')
				{
					$Sql .=	'INSERT INTO super-categorie VALUES (6, 2, 'Haut-Rhin')' ;
				}
			}
		}
				
				
				
		$query = "SELECT * FROM region";
			
		
			
		foreach(explode(';',$Sql) as $Requete) Test($mysqli,$Requete);

		$resultat = $mysqli->query($query);

		mysqli_close($mysqli);

		while($nuplet = $resultat->fetch_assoc())
			{ 
				echo "\t".$nuplet["lib"]."\n";
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