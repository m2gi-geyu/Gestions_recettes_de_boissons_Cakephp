<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class SousRecette extends Entity
{
    protected $_accessible = [
        '*' => true,
        'idRecette' => true,
    ];
}