<h1>Recettes</h1>

<div class="recette table ">
    <aside class="column">  
        <div class="side-nav">
            <p><?= $this->Html->link('Retourner', ['action' => 'retourner']) ?></p>
        </div>
    </aside>
    <table>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Action</th>
        </tr>
        
        <div class="recettes">
            <?php  foreach ($recettes as $recette): ?>
                <tr>
                    <td>
                        <?= h($recette->id) ?>
                    </td>
                    <td>
                        <?= $this->Html->link($recette->titre, ['action' => 'view', $recette->id]) ?>
                    </td>
                    <td>
                        <?= $this->Form->postLink(
                            'Ajouter Recette Préférée',
                            ['action' => 'add', $recette->id],
                            ['confirm' => 'Are you sure?'])
                        ?>
                    </td>
                </tr>
        </div>
            <?php endforeach; ?>
    </table>    
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
    

</div>