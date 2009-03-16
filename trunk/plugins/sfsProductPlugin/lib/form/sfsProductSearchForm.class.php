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
 * sfsProductFilter form.
 *
 * @package    plugin.sfsProductPlugin
 * @subpackage lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id$
 */
class sfsProductSearchForm extends BaseProductForm
{
  public function configure()
  {
        $this->setWidgets(
            array(
                'query' => new sfWidgetFormInput()
             )
        );
        
        $validatorQuery = new sfValidatorString(
            array(
                'required'   => true,
                'min_length' => 3
            ),
            array(
                'required'   => 'Query string is a required field',
                'min_length' => 'Query string can not be less 2 characters',
            )
        );
        
        $this->setValidators(
            array(
                'query' => $validatorQuery
            )
        );
        
        $this->defineSfsListFormatter();
        $this->getWidgetSchema()->setNameFormat('data[%s]');
  }
}
