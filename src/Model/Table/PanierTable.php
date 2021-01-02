<?php
namespace App\Model\Table;

// the Validator class
use Cake\Validation\Validator;

use Cake\ORM\Table;
// the Text class
use Cake\Utility\Text;

class ArticlesTable extends Table
{
    public function initialize(array $config):void
    {
        $this->addBehavior('Timestamp');
    }

    public function beforeSave($event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            // trim slug to maximum length defined in schema
            $entity->slug = substr($sluggedTitle, 0, 191);
        }
    }


/*public function validationDefault(Validator $validator):Cake\Validation\Validator
{
    $validator
        ->notEmpty('title')
        ->minLength('title', 10)
        ->maxLength('title', 255)

        ->notEmpty('body')
        ->minLength('body', 10);

    return $validator;
}*/
}