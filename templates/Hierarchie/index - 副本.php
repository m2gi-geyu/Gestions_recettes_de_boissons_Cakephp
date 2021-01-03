



<html>
	<head>
		<title>Navigation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
	
	<body>
	
		<?php 
		
				foreach ($Hierarchie as $SousHierarchie)
				{
					if(is_null($SousHierarchie->super)){
						echo '<option value="'.$SousHierarchie->sous.'">'.$SousHierarchie->sous.'</option>';
					}
				}
		?>	
	
		<form name="formulaire">
			<select id="Ingredient" name="ingredients" onChange="choixIngredient()">
		<?php 
			$c.='<form name="formulaire">
			<select id="Ingredient" name="ingredients" onChange="choixIngredient()">';
			
			
			$j=0;
			foreach ($Hierarchie as $SousHierarchie)
			{
				if(is_null($SousHierarchie->super)){
					echo '<option value="'.$SousHierarchie->sous.'">'.$SousHierarchie->sous.'</option>';
					$c.='<option value="'.$SousHierarchie->sous.'">'.$SousHierarchie->sous.'</option>';
					$array[$j]=$SousHierarchie->sous;
				}
				$j++;	
			}
			echo '</select>';
			
			
			$c.='</select>';
			
			echo $c;
			echo print_r($array);
		?>

		
		<?php 
		/*	$i=0;
			while(!is_null($SousHierarchie->sous)&&$i<5){
				echo '<form name="formulaire">
			<select id="Ingredient" name="ingredients" onChange="choixIngredient()">';
				$j=0;
				foreach ($Hierarchie as $SousHierarchie)
				{
					if(in_array($SousHierarchie->nom,$array)){echo '<option value="'.$SousHierarchie->sous.'">'.$SousHierarchie->sous.'</option>';}
					$array2[$j]=$SousHierarchie->nom;
					$j++;
				}
				$i++;
				echo '</select>';
				$array=$array2;
				echo print_r($array);
			}*/
			
		?>
		<?= $this->Form->submit(__('Login'), ['action' => 'view', $_GET['choix']]); ?>
		
			<script type="text/javascript">
				function choixIngredient(){
					var mySelect=document.getElementById("Ingredient").value;
					var tab=document.getElementById('sous_categorie_liste');
					//tab.innerHTML+='<select id="Ingredient" name="sous_categories" onChange="choixIngredient()"><option value="1">Moselle</option><option value="1">Mosell</option> \\';
					
					//tab.innerHTML+='<option value="1">Mosell</option></select>';
					//	<?php $b =  'jj'; ?>
					//	var data=eval(<?php echo json_decode($c);?>);
					tab.value=mySelect;
					
					//tab.innerHTML+='</select>';
			
				}
				
				
			</script>	
			
			<div id="sous_categorie_liste" name="choix" value="null">
			</div>

		</form>
		
	</body>
</html>






