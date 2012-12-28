<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $imageForm = new Application_Form_Image();
        
        if ($this->getRequest()->isPost()) {
            if ($imageForm->isValid($this->getRequest()->getPost())) {
                $imageForm->process();
            }
        }
        
        $this->view->form = $imageForm;
    }

    public function indexAction()
    {
        // action body
    }


}

