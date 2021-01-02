<!-- File: templates/recettes/view.php -->

<h1><?= h($recette->title) ?></h1>
<p><?= h($recette->body) ?></p>
<p><small>Created: <?= $recette->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $recette->slug]) ?></p>