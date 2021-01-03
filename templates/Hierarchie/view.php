<h1>Hierarchie</h1>
<div class="recette table ">
    <table>
        <tr>
            <th>nom</th>
            <th>sous</th>
            <th>super</th>
        </tr>
        
        <div class="recettes">
            <?php  foreach ($Hierarchie as $SousHierarchie): ?>
                <tr>
                    <td>
                        <?= h($SousHierarchie->nom) ?>
                    </td>
                    <td>
                        <?= $this->Html->link($SousHierarchie->sous) ?>
                    </td>
                    <td>
                        <?= $this->Html->link($SousHierarchie->super) ?>
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


<div class="row">
    <aside class="column">
        <div class="side-nav">
            <p><?= $this->Html->link('Retourner', ['action' => 'index']) ?></p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <table>
                <tr>
                    <th><?= __('Titre:') ?></th>
                    <td><?= h($recette->titre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ingredients:') ?></th>
                    <td><?= h($recette->ingredients)?></td>
                </tr>
                <tr>
                    <th><?= __('Preparation:') ?></th>
                    <td><?=h($recette->preparation) ?></td>
                </tr>
                <tr>
                   <th><?= __('SousRecette:') ?></th>
                </tr>
                     <?php  foreach ($sousRecettes as $sousRecette): ?>
                     <tr>
                        <th><?=h ($sousRecette->pre_index).__(':')  ?></th>
                        <td><?=h ($sousRecette->nom) ?></td>
                    </tr>
                     <?php endforeach; ?>
               
            </table>
        </div>
    </div>
</div>
