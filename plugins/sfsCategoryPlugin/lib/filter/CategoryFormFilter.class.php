<?php

/**
 * Category filter form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class CategoryFormFilter extends BaseCategoryFormFilter
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
