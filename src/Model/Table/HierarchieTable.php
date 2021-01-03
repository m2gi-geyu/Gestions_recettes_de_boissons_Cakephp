<?php
namespace App\Model\Table;

use Cake\ORM\Table;
/*
* table Hierarchie dan sql
*/
class HierarchieTable extends Table
{
    public function initialize(array $config): void
    {
		$this->setTable('hierarchie');
		$this->addBehavior('Timestamp');
		$this->setPrimaryKey('id');
    }
}

?>