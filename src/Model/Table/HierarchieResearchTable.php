<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class HierarchieResearchTable extends Table
{
    public function initialize(array $config):void
    {
        $this->setTable('hierarchieResearch');
        $this->setPrimaryKey('id');

    }

}
?>