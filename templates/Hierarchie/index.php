



<html>
	<head>
		<title>Navigation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
	
	<body>
	
		<?php 
			error_reporting(0); 
		
				foreach ($Hierarchie as $SousHierarchie)
				{
					if(is_null($SousHierarchie->super)){
						echo '<option value="'.$SousHierarchie->sous.'">'.$SousHierarchie->sous.'</option>';
					}
				}
		?>	
	
		<form name="formulaire">
			<select id="Ingredient" name="ingredients" onChange="change(this.value);">

			
		<?php 
			$c.='<form name="formulaire">
			<select id="Ingredient" name="ingredients" onChange="choixIngredient()">';
			foreach ($Hierarchie as $SousHierarchie)
			{
				if(is_null($SousHierarchie->super)){
					echo '<option value="'.$SousHierarchie->sous.'">'.$SousHierarchie->sous.'</option>';
					$c.='<option value="'.$SousHierarchie->sous.'">'.$SousHierarchie->sous.'</option>';
				}
					
			}
			echo '</select>';
			
			
			$c.='</select>';
			
			echo $c
			

		?>

		function change(val){
			switch (val){
                            case Fruit : echo 'test';
                                        break;
                            case 2 : echo 'test2';
                                        break;
                   }
		}

		
		<?php 
			$i=0;
			while(!is_null($SousHierarchie->sous)&&$i<5){
				echo '<form name="formulaire">
			<select id="Ingredient" name="ingredients" onChange="choixIngredient()">';
			
				foreach ($Hierarchie as $SousHierarchie)
				{
					if(is_null($SousHierarchie->super)){
						echo '<option value="'.$SousHierarchie->sous.'">'.$SousHierarchie->sous.'</option>';
					}
					
				}
				$i++;
				echo '</select>';
			}
			
		?>

		
			<script type="text/javascript">
				function choixIngredient(){
					var mySelect=document.getElementById("Ingredient").value;
					var tab=document.getElementById('sous_categorie_liste');
					//tab.innerHTML+='<select id="Ingredient" name="sous_categories" onChange="choixIngredient()"><option value="1">Moselle</option><option value="1">Mosell</option> \\';
					
					//tab.innerHTML+='<option value="1">Mosell</option></select>';
						<?php $b =  'jj'; ?>
						var data=eval(<?php echo json_encode($c);?>);
					tab.innerHTML+=data;
					
					//tab.innerHTML+='</select>';
			
				}
				
				
			</script>	
			
			<div id="sous_categorie_liste">
			</div>

		</form>
	</body>
</html>






