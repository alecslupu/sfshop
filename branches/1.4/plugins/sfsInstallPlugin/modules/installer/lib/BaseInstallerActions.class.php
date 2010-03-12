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
    
    public function executeIndex($request)
    {
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
        $finder = sfFinder::type('any');
        
        foreach ($this->paths as $path) {
            if (!is_writable($path)) {
                $unwritablePaths[] = $path;
            }
            
            foreach ($finder->in($path) as $path) {
                if (!is_writable($path)) {
                    $unwritablePaths[] = $path;
                }
                
                if (!in_array($path, $this->paths)) {
                    $this->paths[] = $path;
                }
            }
        }
        
        $this->isValidPhpVersion = phpversion() > '5.1' ? true : false;
        
        $this->unexistsPhpExtensions = array();
        $this->phpExtensions = array('gd', 'mysql', 'curl');
        
        foreach ($this->phpExtensions as $extension) {
            if (!in_array($extension, get_loaded_extensions())) {
                $this->unexistsPhpExtensions[] = $extension;
            }
        }
        
        $this->unwritablePaths = $unwritablePaths;
        
        if ($request->isMethod('post')) {
            
            if (count($this->unwritablePaths) == 0 && $this->isValidPhpVersion && count($this->unexistsPhpExtensions) == 0) {
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
             
             require_once(dirname(__FILE__).'/../lib/sfsConfigureForm.class.php');
             
             $errors = array();
             
             if ($this->getUser()->hasFlash('error')) {
                 $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
                 $errors[] = $this->getUser()->getFlash('error') . ' ' . __('Try again.');
             }
             
             $this->form = new sfsConfigureForm();
             
             if ($request->isMethod('post')) {
                 $data = $request->getParameter('data');
                 $this->form->bind($data);
                 
                 if ($this->form->isValid()) {
                     
                     $dsn = 'mysql://';
                     
                     if ($data['database_username'] != '') {
                         $dsn .= $data['database_username'];
                         
                         if ($data['database_password'] != '') {
                             $dsn .= ':' . $data['database_password'] . '@';
                         }
                         else {
                             $dsn .= '@';
                         }
                     }
                     
                     $dsn .= $data['database_host'] . '/';
                     $dsn .= $data['database_name'];
                     
                     $dispatcher = sfContext::getInstance()->getEventDispatcher();
                     
                     $formatter = new sfAnsiColorFormatter();
                     
                     chdir(sfConfig::get('sf_root_dir'));
                     
                     $configureDatabase = new sfConfigureDatabaseTask($dispatcher, $formatter);
                     $configureDatabase->run(array($dsn), array('--name=propel'));
                     
                     $configureDatabase = new sfConfigureDatabaseTask($dispatcher, $formatter);
                     $configureDatabase->run(array($dsn), array('--name=session_storage'));
                     
                     $cacheClear = new sfCacheClearTask($dispatcher, $formatter);
                     $cacheClear->run();
                     
                     try {
                         $databaseManager = sfContext::getInstance()->getDatabaseManager();
                         $databaseManager->loadConfiguration();
                         sfContext::getInstance()->getDatabaseConnection('propel');
                     }
                     catch (Exception $e) {
                         $errors[] = $e;
                     }
                     
                     if (count($this->errors) == 0) {
                         $this->getUser()->setAttribute('is_configured', true, 'install');
                         $this->isConfigured = true;
                     }
                 }
             }
             else {
                 $database = $this->context->getDatabaseManager()->getDatabase('propel');
                 $this->form->setDefault('database_name', $database->getParameter('database'));
                 $this->form->setDefault('database_username', $database->getParameter('username'));
                 $this->form->setDefault('database_password', $database->getParameter('password'));
             }
             
             $this->errors = $errors;
             
         }
         else {
             $this->redirect('@installer_index');
         }
    }
    
    public function executeLoadSql($request)
    {
        if ($request->isXmlHttpRequest()) {
            $this->getContext()->getConfiguration()->loadHelpers(array('Partial'));
            
            $dispatcher = sfContext::getInstance()->getEventDispatcher();
            $formatter = new sfAnsiColorFormatter();
            
            chdir(sfConfig::get('sf_root_dir'));
            
            //FIXME
            slot('build');
            // insert sql
            $insertSql = new sfsInstallInsertSqlTask($dispatcher, $formatter);
            $insertSql->run(array(), array());
            end_slot();
            
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
            $this->getContext()->getConfiguration()->loadHelpers(array('Partial'));
            $dispatcher = sfContext::getInstance()->getEventDispatcher();
            $formatter = new sfAnsiColorFormatter();
            
            chdir(sfConfig::get('sf_root_dir'));
            
            //FIXME
            slot('build');
            // load default data
            $loadData = new sfPropelLoadDataTask($dispatcher, $formatter);
            $loadData->run(array('install'), array());
            end_slot();
            
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
