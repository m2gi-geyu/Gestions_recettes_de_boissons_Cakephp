


<h1>Hierarchie</h1>


<?php 

			
			$SousHierarchieResearch=array();
			foreach ($HierarchieResearch as $SousHierarchieResearch)
			{
				echo $SousHierarchieResearch->nom.'->';
			}
			
?>


<?= $this->Form->postButton(__('ViderSearch'), ['action' => 'Vider']) ?>

<div class="recette table ">
    <table>
        <tr>
            <th>nom</th>
            <th>sous</th>
            <th>super</th>
        </tr>
		
        <div class="hierarchie">
            <?php  foreach ($Hierarchie as $SousHierarchie):  ?>
				<?php  if($SousHierarchie->nom==$SousHierarchieResearch->nom): ?>
                <tr>
                    <td>
                        <?= h($SousHierarchie->nom) ?>
                    </td>
                    <td>
                        <?= h($SousHierarchie->sous) ?>
                    </td>
                    <td>
                        <?= h($SousHierarchie->super) ?>
                    </td>
					<td>
                        <td>
                        <?= $this->Form->postLink(
                            'Avancer',
                            ['action' => 'add',$SousHierarchie->id],
                            ['confirm' => 'Are you sure?'])
                        ?>
                    </td>
                    </td>
                </tr>
        </div>
				<?php  endif;  ?>
            <?php endforeach; ?>
	</table> 	
	
	<table>		
		<th>id</th>
        <th>nom</th>
	
		<div class="recettes">
            <?php  foreach ($sousrecettes as $presousrecettes):  ?>
				<?php  if($presousrecettes->nom==$SousHierarchieResearch->nom): ?>
					<?php  foreach ($recettes as $prerecettes):  ?>
						<?php  if($prerecettes->id==$presousrecettes->idRecette): ?>
						<tr>
							<td>
								<?= h($prerecettes->titre) ?>
							</td>
							<td>
								<?= h($presousrecettes->nom) ?>
							</td>
							<td>
							</td>
						</tr>
				</div>	
						<?php  endif; ?>
					<?php endforeach; ?>
				<?php  endif;  ?>
            <?php endforeach; ?>
			

    </table>    
</div>





