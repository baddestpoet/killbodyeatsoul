<?php

class Application_Form_Post extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
        $this->setAction('newstuff');

        //Add choose file element
        $file = new Zend_Form_Element_File('file', array(
            'label'      => 'file',
        ));
        $this->addElement($file);

        // Add a title element
        $this->addElement('text', 'title', array(
            'label'      => 'title',
            'size'		 => '60',
            'required'   => true
        ));

        // Add a text element
        $this->addElement('textarea', 'text', array(
            'label'      => 'text',
            'rows'		 => '10',
            'cols'		 => '60',
        ));

        $this->addElement('textarea', 'tags', array(
            'label'      => 'tags',
            'rows'		 => '2',
            'cols'		 => '40',
            'required'   => true
        ));

        // Add a title element
        $this->addElement('text', 'pic', array(
            'label'      => 'pic',
            'size'       => '1',
            'value'      => '1',
            'required'   => true
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'submit',
        ));
    }
}
