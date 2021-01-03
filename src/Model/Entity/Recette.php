<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Recette extends Entity
{
    protected $_accessible = [
        'id' => true,
        'titre' => true,
        'ingredients'=>true,
        'preparation'=>true,
    ];


}