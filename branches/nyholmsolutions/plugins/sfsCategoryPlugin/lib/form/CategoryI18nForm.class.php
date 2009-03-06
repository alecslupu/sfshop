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
 * CategoryI18n form.
 *
 * @package    plugin.sfsCategoryPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class CategoryI18nForm extends BaseCategoryI18nForm
{
  public function configure()
  {

      $this->widgetSchema['description'] = new sfWidgetFormTextarea(
            array(),
            array(
              'cols'  => 60,
              'rows'  => 5
            )
        );
      $this->widgetSchema['meta_keywords'] = new sfWidgetFormTextarea(
            array(),
            array(
              'cols'  => 100,
              'rows'  => 1
            )
        );
      $this->widgetSchema['meta_description'] = new sfWidgetFormTextarea(
            array(),
            array(
              'cols'  => 100,
              'rows'  => 1
            )
        );      
  }
}
