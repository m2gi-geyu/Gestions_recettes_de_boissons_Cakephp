<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class SousRecette extends Entity
{
    protected $_accessible = [
        'idRecette' => true,
    ];
}