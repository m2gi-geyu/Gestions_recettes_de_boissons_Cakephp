
<h1><?= h($Recettes->title) ?></h1>
<p><?= h($Recettes->ingredients) ?></p>
<p><?= h($Recettes->preparation) ?></p>
//<p><?= h($Recettes->index) ?></p>

<p><?= $this->Html->link('Retourner', ['action' => 'index']) ?></p>