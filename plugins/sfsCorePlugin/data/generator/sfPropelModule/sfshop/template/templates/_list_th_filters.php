[?php $list_fields = $configuration->getValue('list.display') ?]
[?php foreach ($configuration->getFormFilterFields($filters) as $name => $field): ?]
    <th>
    [?php if(isset($list_fields[$name]) and ! ((isset($filters[$name]) && $filters[$name]->isHidden()) || (!isset($filters[$name]) && $field->isReal()))): ?]
      [?php include_partial('<?php echo $this->getModuleName() ?>/filters_field', array(
        'name'       => $name,
        'attributes' => $field->getConfig('attributes', array()),
        'label'      => $field->getConfig('label'),
        'help'       => $field->getConfig('help'),
        'form'       => $filters,
        'field'      => $field,
        'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
      )) ?]
    [?php endif; ?]
    </th>
[?php endforeach; ?]