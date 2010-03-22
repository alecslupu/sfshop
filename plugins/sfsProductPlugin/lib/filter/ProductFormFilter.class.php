<?php

/**
 * Product filter form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
class ProductFormFilter extends BaseProductFormFilter
{
    public function configure()
    {
        $this->mergeForm(new ProductI18nFormFilter);
    }

    public function getFields()
    {
        $form = new ProductI18nFormFilter;
        return array_merge(
            $form->getFields(),
            parent::getFields()
        );
    }
}
