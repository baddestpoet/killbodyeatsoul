<?php

class Application_Form_Quote extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');

        $author = new Zend_Form_Element_Text('author');
        $author->setAttrib('size', 30);
        $author->setLabel("author");
        $this->addElement($author);

        $quote = new Zend_Form_Element_Textarea('quote');
        $quote->setAttrib('cols', 30);
        $quote->setAttrib('rows', 3);
        $quote->setLabel("quote");
        $this->addElement($quote);

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'submit',
        ));
    }
}