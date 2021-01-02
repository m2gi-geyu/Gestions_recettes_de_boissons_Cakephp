<!-- File: templates/Rrecettes/index.php  (delete links added) -->

<h1>Recettes</h1>
<p><?= $this->Html->link("Add Recette Préférée", ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Action</th>
        <th>Index</th>
        <th>Action</th>
    </tr>

<!-- Here's where we iterate through our $recettes query object, printing out recette info -->

<?php foreach ($recettes as $recette): ?>
    <tr>
        <td>
            <?= $this->Html->link($recette->title, ['action' => 'view', $recette->slug]) ?>
        </td>
        <td>
             <?= $this->Html->link($recette->title, ['action' => 'view', $recette->slug]) ?>        </td>
        <td>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'add', $recette->slug],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
<?php endforeach; ?>

</table>