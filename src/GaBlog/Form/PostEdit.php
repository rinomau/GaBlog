<?php 

namespace GaBlog\Form;

use Zend\Form\Form;
use Zend\Form\Element;

/**
 * Form for create and edit post
 * @author Gianluca Arbezzano <gianarb92@gmail.com>
 *
 */
class PostEdit
extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('post');
        $this->setAttribute('method', 'POST');
        $this->setAttribute('action', '/blog/post/add');
        $this->add(array(
                'name' => 'title',
                'options' => array(
                        'label' => 'Title',
                ),
                'attributes' => array(
                        'type' => 'text',
                        'class' => 'span12'
                ),
        ));
        
        $this->add(array(
                'name' => 'content',
                'options' => array(
                        'label' => 'Content',
                ),
                'attributes' => array(
                        'type' => 'textarea',
                        'class' => 'span12',
                        'id' => 'editor',
                ),
        ));
        
        $this->add(array(
                'name' => 'created',
                'options' => array(
                        'label' => 'Created',
                ),
                'attributes' => array(
                        'type' => 'text',
                        'class' => 'datepicker',
                        'disabled' => 'disabled'
                ),
        ));

        $this->add(array(
                'name' => 'description',
                'options' => array(
                        'label' => 'Descrizione',
                ),
                'attributes' => array(
                        'type' => 'textarea',
                        'class' => 'span12'
                ),
        ));

        $this->add(array(
                'name' => 'tag',
                'options' => array(
                        'label' => 'Tag',
                ),
                'attributes' => array(
                        'type' => 'text',
                        'class' => 'span6'
                ),
        ));
        
        $this->add(array(
                'name' => 'status',
                'options' => array(
                        'label' => 'Stato',
                        'value_options' => array(
                                    '0' => 'Draft',
                                    '1' => 'Publish',
                                )
                ),
                'type' => 'Zend\Form\Element\Select',
                'attributes' => array(
                        'class' => 'span12',
                ),
        ));

        $this->add(array(
                'name' => 'categoryId',
                'options' => array(
                        'label' => 'Categoria',
                ),
                'type' => 'Zend\Form\Element\Select',
                'attributes' => array(
                        'class' => 'span12'
                ),
        ));
        $this->add(array(
                'name' => 'userId',
                'type' => 'Zend\Form\Element\Text',
                'options' => array(
                        'label' => 'Utente',
                ),
                'attributes' => array(
                        'class' => 'span12'
                ),
        ));
        
        $this->add(array(
                'name' => 'id',
                'type' => 'Zend\Form\Element\Hidden',
                'attributes' => array(
                        'type' => 'hidden'
                ),
        ));
        
        $submitElement = new Element\Button('submit');
        $submitElement
        ->setLabel('Submit')
        ->setAttributes(array(
                'type'  => 'submit',
                'class' => 'btn'
        ));

        $this->add($submitElement, array(
                'priority' => -100,
        ));
    }
}