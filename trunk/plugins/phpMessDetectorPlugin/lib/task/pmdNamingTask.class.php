<?php
class pmdNamingTask extends pmdBaseTask 
{
  protected function configure() 
  {
    parent::configure();

    $this->namespace        = 'pmd';
    $this->name             = 'naming';
    $this->briefDescription = 'A naming rule of a symfony project';
    $this->detailedDescription = <<<EOF
EOF;
  }

  protected function execute($arguments = array(), $options = array()) 
  {
    $this->analyze('naming');
  }
}
