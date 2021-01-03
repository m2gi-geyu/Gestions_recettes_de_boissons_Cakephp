<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class PrefersTable extends Table
{
    public function initialize(array $config):void
    {
        $this->setTable('prefers');
        $this->setPrimaryKey('id');

    }

}
?>