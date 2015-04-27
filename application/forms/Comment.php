<?php

class Application_Form_Comment extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');

        $name = new Zend_Form_Element_Text('name');
        $name->addFilter('StripTags');
        $name->addFilter('Alpha');
        $name->setLabel('Name:');
        $name->setRequired(true);
        $this->addElement($name);

        $url = new Zend_Form_Element_Text('url');
        $url->addFilter('StripTags');
        $url->setLabel('URL:');
        $url->setAttrib('size', 35);
        $url->addValidator(new Application_Form_Validator_Url());
        $this->addElement($url);

        $text = new Zend_Form_Element_Textarea('text');
        $text->addFilter('StripTags');
        $text->setLabel('Comment:');
        $text->setAttribs(array(
            'cols' => 40,
            'rows' => 4
        ));
        $text->setRequired(true);
        $this->addElement($text);
        
        $robot = new Zend_Form_Element_Text('robot');
        $robot->addFilter('StripTags');
        $robot->setLabel('please type \'human\' in here to confirm you\'re not a robot:');
        $robot->setRequired(true);
        $this->addElement($robot);

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'submit',
        ));

        $this->addElement('hidden', 'post_id', array(
        ));
        $this->addElement('hidden', 'email', array(
        ));
    }
}