<?php
class pmdUnusuedCodeTask extends pmdBaseTask 
{
  protected function configure() 
  {
    parent::configure();

    $this->namespace        = 'pmd';
    $this->name             = 'unusued';
    $this->briefDescription = 'Finds out commented code in a symfony project';
    $this->detailedDescription = <<<EOF
EOF;
  }

  protected function execute($arguments = array(), $options = array()) 
  {
    $this->analyze('unusedcode');
  }
}
