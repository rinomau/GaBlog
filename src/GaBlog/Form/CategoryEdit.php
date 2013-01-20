<?php

namespace GaBlog\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class CategoryEdit
    extends Form
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Nome',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'options' => array(
                'label' => 'Descrizione',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'tag',
            'options' => array(
                'label' => 'Tag',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));

        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('Submit')
            ->setAttributes(array(
                'type'  => 'submit',
            ));

        $this->add($submitElement, array(
            'priority' => -100,
        ));

        $this->add(array(
            'name' => 'categoryId',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'type' => 'hidden',
                'value' => 1
            ),
        ));
        $this->add(array(
            'name' => 'userId',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'type' => 'hidden'
            ),
        ));
    }
}