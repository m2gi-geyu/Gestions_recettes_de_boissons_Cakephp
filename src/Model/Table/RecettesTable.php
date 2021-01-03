<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class RecettesTable extends Table
{
    public function initialize(array $config):void
    {
        $this->setTable('recettes');
        $this->setPrimaryKey('id');

    }

}
?>