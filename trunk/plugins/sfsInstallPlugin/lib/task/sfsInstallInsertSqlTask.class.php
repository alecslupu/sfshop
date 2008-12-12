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
 * Inserts SQL for installation process via web.
 *
 * @package    plugin.sfsInstallPlugin
 * @subpackage lib.task
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelInsertSqlTask.class.php 7247 2008-01-31 14:15:49Z fabien $
 */
class sfsInstallInsertSqlTask extends sfPropelBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->aliases = array();
    $this->namespace = 'install';
    $this->name = 'insert-sql';
    $this->briefDescription = 'Uses for inserting SQL in installation process via web';

    $this->detailedDescription = <<<EOF
The [install:insert-sql|INFO] task creates database tables:

  [./symfony install:insert-sql|INFO]

The task connects to the database and executes all SQL statements
found in [config/sql/*schema.sql|COMMENT] files.
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $this->schemaToXML(self::DO_NOT_CHECK_SCHEMA, 'generated-');
    $this->copyXmlSchemaFromPlugins('generated-');
    $this->callPhing('insert-sql', self::DO_NOT_CHECK_SCHEMA);
    $this->cleanup();
  }
}
