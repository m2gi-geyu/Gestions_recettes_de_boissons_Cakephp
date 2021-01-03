<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Hierarchie extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => true,
        'nom' => true,
		'sous' => true,
		'super' => true,
    ];
}
?>