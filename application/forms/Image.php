<?php

class Application_Form_Image extends Zend_Form
{
    public function init()
    {
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $renameResize = new Zend_Form_Element_File('renameResize');
        $renameResize->setDestination('../upload');
        $renameResize->setLabel('Rename before resize');
        
        $renameResize->addFilter('Rename', 'rename-resize');
        $renameResize->addFilter(new Skoch_Filter_File_Resize(array(
            'width' => 200,
            'height' => 300,
            'keepRatio' => true,
        )));
        
        $this->addElement($renameResize);
        
        
        $resizeRename = new Zend_Form_Element_File('resizeRename');
        $resizeRename->setDestination('../upload');
        $resizeRename->setLabel('Resize before rename');
        
        $resizeRename->addFilter(new Skoch_Filter_File_Resize(array(
            'width' => 200,
            'height' => 300,
            'keepRatio' => true,
        )));
        $resizeRename->addFilter('Rename', 'resize-rename');
        
        $this->addElement($resizeRename);
        
        
        $multiResize = new Zend_Form_Element_File('multiResize');
        $multiResize->setDestination('../upload');
        $multiResize->setLabel('Multiple resizes');
        
        $filterChain = new Zend_Filter();
        // Create one big image with at most 600x300 pixel
        $filterChain->appendFilter(new Skoch_Filter_File_Resize(array(
                'width' => 600,
                'height' => 300,
                'keepRatio' => true,
        )));
        // Create a medium image with at most 500x200 pixels
        $filterChain->appendFilter(new Skoch_Filter_File_Resize(array(
                'directory' => '../upload/medium',
                'width' => 500,
                'height' => 200,
                'keepRatio' => true,
        )));
        $multiResize->addFilter('Rename', 'multi-resize');
        $multiResize->addFilter($filterChain);
        
        $this->addElement($multiResize);
        
        
        $submit = new Zend_Form_Element_Submit('submit');
        $this->addElement($submit);
    }
    
    public function process()
    {
        $this->renameResize->receive();
        $this->resizeRename->receive();
        $this->multiResize->receive();
    }
}

