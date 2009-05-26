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
 * Category form.
 *
 * @package    plugin.sfsCategoryPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class CategoryForm extends BaseCategoryForm
{
  public function configure()
  {
      unset(
        $this['id'],
        $this['created_at'],
        $this['updated_at'],
        $this['path'],
        $this['has_child'],
        $this['is_parent_active'],
        $this['is_deleted'],
        $this['is_locked'],
        $this['product2_category_list']
        );
        
     $this->embedI18nForAllCultures(); 
      
  }
}
