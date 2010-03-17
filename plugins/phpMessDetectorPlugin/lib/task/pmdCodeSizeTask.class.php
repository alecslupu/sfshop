<?php
class pmdCodeSizeTask extends pmdBaseTask {
  protected function configure() {
    parent::configure();

    $this->namespace        = 'pmd';
    $this->name             = 'codesize';
    $this->briefDescription = 'Measures code complexity of a symfony project';
    $this->detailedDescription = <<<EOF
EOF;
  }

  protected function execute($arguments = array(), $options = array()) 
  {
    $this->analyze('codesize');
  }
}
