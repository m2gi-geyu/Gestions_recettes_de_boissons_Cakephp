<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class SousRecettesTable extends Table
{
    public function initialize(array $config):void
    {
        $this->setTable('sousRecettes');
    }

}