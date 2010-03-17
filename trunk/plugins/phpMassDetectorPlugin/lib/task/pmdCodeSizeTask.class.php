<?php
class pmdCodeSizeTask extends pmdBaseTask {
  protected function configure() {
    parent::configure();

    $this->namespace        = 'pmd';
    $this->name             = 'codecomplexity';
    $this->briefDescription = 'Measures a code complexity of a symfony project';
    $this->detailedDescription = <<<EOF
The [contactLoader|INFO] task does things.
Call it with:

  [php symfony contactLoader|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array()) {

    $files = $this->getPathsToSearch();
      $iterator = 0;
      $total = count($files);
      
      
	$time = microtime();
    foreach ($files as $file) {
	  $phpmd = new PHP_PMD();
     $opts = new PHP_PMD_TextUI_CommandLineOptions(array(
                      ' ',$file, 'text','codesize',
      ));

      $renderer = $opts->createRenderer();


      $stream = fopen(sfConfig::get('sf_log_dir').'/cc.log', 'a+');
      $renderer->setWriter(new PHP_PMD_Writer_Stream($stream));

      $ruleSetFactory = new PHP_PMD_RuleSetFactory();
      $ruleSetFactory->setMinimumPriority($opts->getMinimumPriority());
///
      $iterator++;
      $this->logSection('pmd', $iterator . ' / '. $total.' Analizing: ' . $file);

      $phpmd->processFiles(
              $file,
              'codesize',
              array(clone $renderer),
              clone $ruleSetFactory
      );

      if ($iterator % 10 == 0)
      {
        $this->logSection('mem', memory_get_usage()  . '    | Time: ' . (microtime()-$time));
        $time = microtime();
      }
    }
  }
}
