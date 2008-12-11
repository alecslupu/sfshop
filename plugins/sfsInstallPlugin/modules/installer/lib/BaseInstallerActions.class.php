<?php

/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
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
 * @author     Dmitry Nesteruk <nest@dev-zp.com>
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
         
         if ($isChecked) {
             
             require_once(dirname(__FILE__).'/../lib/sfsConfigureForm.class.php');
             
             $this->form = new sfsConfigureForm();
             
             if ($request->isMethod('post')) {
                 $data = $request->getParameter('data');
                 $this->form->bind($data);
                 
                 if ($this->form->isValid()) {
                     
                     $this->errors = array();
                     
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
                         $this->errors[] = $e;
                     }
                     
                     if (count($this->errors) == 0) {
                         $this->getUser()->setAttribute('is_configured', true, 'install');
                         $this->redirect('@installer_load');
                     }
                 }
             }
         }
         else {
             $this->redirect('@installer_index');
         }
    }
    
    public function executeLoad()
    {
         $isChecked = $this->getUser()->getAttribute('is_checked', false, 'install');
         $isConfigured = $this->getUser()->getAttribute('is_configured', false, 'install');
         
         if (!$isChecked) {
             $this->redirect('@installer_index');
         }
         elseif (!$isConfigured) {
             $this->redirect('@installer_configure');
         }
         else {
             $dispatcher = sfContext::getInstance()->getEventDispatcher();
             $formatter = new sfAnsiColorFormatter();
             
             chdir(sfConfig::get('sf_root_dir'));
             
             // insert sql
             $insertSql = new sfsInstallInsertSqlTask($dispatcher, $formatter);
             $insertSql->run(array(), array());
             
             // load default data
             $loadData = new sfPropelLoadDataTask($dispatcher, $formatter);
             $loadData->run(array('install'), array());
             
             $this->redirect('@installer_finished');
         }
    }
    
    public function executeFinished()
    {
        return sfView::SUCCESS;
    }
}
