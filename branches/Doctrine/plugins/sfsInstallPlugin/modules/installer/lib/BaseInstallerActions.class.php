<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nesterukd@gmail.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Base installer actions.
 *
 * @package    plugins.sfsInstallPlugin
 * @subpackage modules.installer
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class BaseInstallerActions extends sfActions
{

  /**
   * This is the action that handles the first step of installer 
   *
   * @param <type> $request
   *
   */
    public function executeIndex($request)
    {

      $this->isValidPhpVersion = version_compare(phpversion(), '5.2.4', '>=');

      $this->unexistsPhpExtensions = array();
      $this->phpExtensions = array('gd', 'mysql', 'curl');
      foreach ($this->phpExtensions as $extension)
      {
        if (!extension_loaded($extension))
          $this->unexistsPhpExtensions[$extension] = true;
      }

      $this->paths = array(
          sfConfig::get('sf_cache_dir'),
          sfConfig::get('sf_data_dir') . '/index/ProductSearchIndex/',
          sfConfig::get('sf_log_dir'),
          sfConfig::get('sf_web_dir') . '/images/thumbnails/original',
          sfConfig::get('sf_web_dir') . '/images/thumbnails/converted',
          sfConfig::get('sf_config_dir') . '/databases.yml',
          sfConfig::get('sf_config_dir') . '/propel.ini'
      );
        
      $unwritablePaths = array();
     
      foreach ($this->paths as $path)
      {
        if (!is_writable($path))
        {
          $unwritablePaths[] = $path;
        }
        $files = sfFinder::type('any')->in($path);
        foreach ($files as $file)
        {
          if (!is_writable($file))
          {
            $unwritablePaths[] = $path;
          }
        }
      }
      $this->unwritablePaths = $unwritablePaths;

      if ($request->isMethod('post'))
      {
        if (
             count($this->unwritablePaths) == 0 &&
             $this->isValidPhpVersion &&
             count($this->unexistsPhpExtensions) == 0
           )
        {
          $this->getUser()->setAttribute('is_checked', true, 'install');
          $this->redirect('@installer_configure');
        }
      }
    }

    public function executeConfigure($request)
    {
      $isChecked = $this->getUser()->getAttribute('is_checked', false, 'install');
      $this->isConfigured = false;
      if ($isChecked) {
        $errors = array();
        if ($this->getUser()->hasFlash('error')) {
          $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
          $errors[] = $this->getUser()->getFlash('error') . ' ' . __('Try again.');
        }
        $this->form = new sfsConfigureForm();
        if ($request->isMethod('post'))
        {
          $data = $request->getParameter('data');
          $this->form->bind($data);
          if ($this->form->isValid())
          {
            $data = $this->form->getValues();
            $dsn = sprintf('mysql:dbname=%s;host=%s %s %s',
                      $data['database_name'],
                      $data['database_host'],
                      $data['database_username'],
                      $data['database_password']
                    );
            chdir(sfConfig::get('sf_root_dir'));

            $dispatcher = $this->getContext()->getEventDispatcher();
            $formatter = new sfAnsiColorFormatter();

            $configureDatabase = new sfPropelConfigureDatabaseTask($dispatcher, $formatter);
            $configureDatabase->run(array($dsn), array('--name=propel'));
          
            $configureDatabase = new sfPropelConfigureDatabaseTask($dispatcher, $formatter);
            $configureDatabase->run(array($dsn), array('--name=session_storage'));

            @ob_start();
            define('STDOUT', fopen('php://stdout', 'w'));
            $application = new sfSymfonyCommandApplication(new sfEventDispatcher(), $formatter, array('symfony_lib_dir' => sfConfig::get('sf_symfony_lib_dir')));
            $application->run();
            @ob_end_clean();

            try {
              $databaseManager = $this->getContext()->getDatabaseManager();
              $databaseManager->loadConfiguration();
              $this->getContext()->getDatabaseConnection('propel');
            }
            catch (Exception $e) {
              $errors[] = $e;
            }

            if (count($this->errors) == 0) {
              $this->getUser()->setAttribute('is_configured', true, 'install');
              $this->isConfigured = true;
             }
          }
          else
          {
            $database = $this->context->getDatabaseManager()->getDatabase('propel');
            $this->form->setDefault('database_name', $database->getParameter('database'));
            $this->form->setDefault('database_username', $database->getParameter('username'));
            $this->form->setDefault('database_password', $database->getParameter('password'));
          }
        }
        
        $this->errors = $errors;
      }
      else
      {
        $this->redirect('@installer_index');
      }
    }

    public function executeLoadSql($request)
    {
        if ($request->isXmlHttpRequest()) {

            $formatter = new sfAnsiColorFormatter();
            chdir(sfConfig::get('sf_root_dir'));

            @ob_start();
            define('STDOUT', fopen('php://stdout', 'w'));
            $application = new sfSymfonyCommandApplication(new sfEventDispatcher(), $formatter, array('symfony_lib_dir' => sfConfig::get('sf_symfony_lib_dir')));
            $task = $application->getTaskToExecute('install:insert-sql');
            $task->run(array(), array());
            $application->run();
            @ob_end_clean();

            $this->getUser()->setAttribute('is_sql_loaded', true, 'install');
            return $this->renderText(sfsJSONPeer::createResponseSuccess(array()));
        }
        else {
            return sfView::NONE;
        }
    }
    public function executeLoadData($request)
    {
        if ($request->isXmlHttpRequest()) {
           $formatter = new sfAnsiColorFormatter();
            chdir(sfConfig::get('sf_root_dir'));

            @ob_start();
            define('STDOUT', fopen('php://stdout', 'w'));
            $application = new sfSymfonyCommandApplication(new sfEventDispatcher(), $formatter, array('symfony_lib_dir' => sfConfig::get('sf_symfony_lib_dir')));
            $task = $application->getTaskToExecute('propel:data-load');
            $task->run(array('install'), array());
            $application->run();
            @ob_end_clean();
            
            $this->getUser()->setAttribute('is_data_loaded', true, 'install');
            return $this->renderText(sfsJSONPeer::createResponseSuccess(array()));
        }
        else {
            return sfView::NONE;
        }
    }

    public function executeFinished()
    {
        $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
        $sfUser = $this->getUser();

        $isDataLoaded = $sfUser->getAttribute('is_data_loaded', false, 'install');
        $isSqlLoaded = $sfUser->getAttribute('is_sql_loaded', false, 'install');

        $error = '';

        if (!$isSqlLoaded) {
            $error = __('Sql is not loaded.');
        }

        if (!$isDataLoaded) {
            $error.= ' ' . __('Data is not loaded.');
        }

        if ($error != '') {
            $this->getUser()->setFlash('error', $error);
            $this->redirect('@installer_configure');
        }

        return sfView::SUCCESS;
    }
}
