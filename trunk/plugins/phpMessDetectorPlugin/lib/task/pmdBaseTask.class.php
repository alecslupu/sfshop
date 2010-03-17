<?php

class pmdBaseTask extends sfBaseTask 
{
  protected function configure()
  {
  }

  protected function execute($arguments = array(), $options = array()) 
  {
  }

  protected function getPathsToSearch($dir = '')
  {
    if ('' == $dir)
    {
      $dir = sfConfig::get('sf_root_dir');
    }
    $files = sfFinder::type('file')->
                name('*.php')->
                sort_by_name()->
                discard(array(
                  '*.yml',
                  '*.txt',
                  '*.yml',
                  '*.sql',
                  '*.xml',
                  '*.log',
                ))->
                in($dir);
    return $files;
  }
  
  protected function analyze($type = null, $paths_to_search = null)
  {
    if ( is_null($type) )
    {
      throw new sfException('a test type should be provided (codesize , naming, unusuedcode )');
    }
    if ( is_null($paths_to_search) )
    {
      $files = $this->getPathsToSearch();
    }
    else
    {
      $files = $this->getPathsToSearch($paths_to_search);
    }
    $iterator = 0;
    $total = count($files);

    $time = microtime(true);
    foreach ($files as $file) 
    {
      $phpmd = new PHP_PMD();
      $opts = new PHP_PMD_TextUI_CommandLineOptions(array(
                      ' ',$file, 'text', $type,
      ));

      $renderer = $opts->createRenderer();

      $stream = fopen(sfConfig::get('sf_log_dir').'/pmd_' . $type . '.log', 'a+');
      $renderer->setWriter(new PHP_PMD_Writer_Stream($stream));

      $ruleSetFactory = new PHP_PMD_RuleSetFactory();
      $ruleSetFactory->setMinimumPriority($opts->getMinimumPriority());

      $iterator++;
      
      //$this->logSection('pmd-' . $type, $iterator . ' / '. $total.' Analizing: ' . $file);

      $phpmd->processFiles(
              $file,
              $type,
              array($renderer),
              $ruleSetFactory
      );

      if ($iterator % 10 == 0)
      {
        $this->logSection('mem-' . $type, memory_get_usage() . ' | Time: ' . ( microtime(true) - $time ));
        $time = microtime(true); 
      }
    }
  }
}
