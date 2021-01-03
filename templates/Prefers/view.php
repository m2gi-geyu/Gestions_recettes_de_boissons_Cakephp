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