<h1>Recettes Préférées</h1>
<div class="recette table ">
    <table>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>IdRecette</th>
            <th>Action</th>
        </tr>
        
        <div class="prefers">
            <?php  foreach ($prefers as $prefer): ?>
                <tr>
                    <td>
                        <?= h($prefer->id) ?>
                    </td>
                    <td>
                        <?= $this->Html->link($prefer->titre, ['action' => 'view', $prefer->idRecette]) ?>
                    </td>
                    <td>
                          <?= h($prefer->idRecette) ?>
                    </td>
                    <td>
                    <?= $this->Form->postLink(
                        'Delete',
                        ['action' => 'delete', $prefer->id],
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