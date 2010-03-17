<?php

class pmdBaseTask extends sfBaseTask {
  protected function configure() {
  }

  protected function execute($arguments = array(), $options = array()) {
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
                  '*cache*',
                  '*web*',
                  '*symfony*'
                ))->
                in($dir);
    return $files;
  }
}