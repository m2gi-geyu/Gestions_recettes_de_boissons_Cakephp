<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Recette extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}