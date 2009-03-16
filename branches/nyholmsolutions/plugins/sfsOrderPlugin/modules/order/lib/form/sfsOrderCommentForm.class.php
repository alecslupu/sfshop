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
 * Order comment form.
 *
 * @package    plugin.sfsOrderPlugin
 * @subpackage modules.order.lib.form
 * @author     Dmitry Nesteruk <nesterukd@gmail.com>
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfsOrderCommentForm extends OrderItemForm
{
    public function configure()
    {
        $this->setWidgets(
            array(
                'comment' => new sfWidgetFormTextarea()
             )
        );
        
        $validatorComment = new sfValidatorString(
            array(
                'required'   => false,
                'max_length' => 255,
            ),
            array(
                'max_length' => 'Comment can not be more 255 characters',
            )
        );
        
        $this->setValidators(
            array(
                'comment' => $validatorComment
            )
        );
        
        $this->getWidgetSchema()->setNameFormat('data[%s]');
        $this->defineSfsListFormatter();
        parent::configure();
    }
}