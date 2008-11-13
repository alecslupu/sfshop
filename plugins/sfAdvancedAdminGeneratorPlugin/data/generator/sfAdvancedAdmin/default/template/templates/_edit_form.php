[?php echo form_tag('<?php echo $this->getModuleName() ?>/edit', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
<?php foreach ($this->getColumnCategories('edit.display') as $category): ?>
<?php foreach ($this->getColumns('edit.display', $category) as $name => $column): ?>
<?php if (false !== strpos($this->getParameterValue('edit.fields.'.$column->getName().'.type'), 'admin_double_list')): ?>
  'onsubmit'  => 'double_list_submit(); return true;'
<?php break 2; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>
)) ?]

<?php foreach ($this->getPrimaryKey() as $pk): ?>
[?php echo object_input_hidden_tag($<?php echo $this->getSingularName() ?>, 'get<?php echo $pk->getPhpName() ?>') ?]
<?php endforeach; ?>

<?php $first = true ?>
<?php foreach ($this->getColumnCategories('edit.display') as $category): ?>
<?php
  if ($category[0] == '-')
  {
    $category_name = substr($category, 1);
    $collapse = true;

    if ($first)
    {
      $first = false;
      echo "[?php use_javascript(sfConfig::get('sf_prototype_web_dir').'/js/prototype') ?]\n";
      echo "[?php use_javascript(sfConfig::get('sf_admin_web_dir').'/js/collapse') ?]\n";
    }
  }
  else
  {
    $category_name = $category;
    $collapse = false;
  }
?>
<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($category_name)) ?>" class="<?php if ($collapse): ?> collapse<?php endif; ?>">
<?php if ($category != 'NONE'): ?><h2>[?php echo __('<?php echo $category_name ?>') ?]</h2>

<?php endif; ?>

<?php $hides = $this->getParameterValue('edit.hide', array()) ?>
<?php foreach ($this->getColumns('edit.display', $category) as $name => $column): ?>
<?php if (in_array($column->getName(), $hides)) continue ?>
<?php if ($column->isPrimaryKey()) continue ?>
<?php $credentials = $this->getParameterValue('edit.fields.'.$column->getName().'.credentials') ?>
<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
    [?php if ($sf_user->hasCredential(<?php echo $credentials ?>)): ?]
<?php endif; ?>

<!-- changed by nest -->

<?php $criteria = new Criteria();
LanguagePeer::addPublicCriteria($criteria);
$languages = LanguagePeer::getAll($criteria);
?>

<?php if (strpos($column->getName(), '_i18n')): ?>
    
    <?php foreach ($languages as $language): ?>
        <?php $path = 'http://' . $_SERVER['HTTP_HOST'] .'/images/' . sfConfig::get('languages_images_dir', 'languages')
            . '/'
            . strtolower($language->getTitleEnglish()) 
            . '/'
            . 'icon.png';
            $title = $language->getTitleOwn();
         ?>
        <div class="form-row">
          [?php echo label_for('<?php echo $this->getParameterValue("edit.fields.".$column->getName().".label_for", $this->getSingularName()."[".$column->getName()."_".$language->getCulture()."]") ?>', __($labels['<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}']), '<?php if ($column->isNotNull()): ?>class="required" <?php endif; ?>') ?]
          <div class="content[?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() . '_' . $language->getCulture() ?>}')): ?] form-error[?php endif; ?]">
          [?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() . '_' .  $language->getCulture() ?>}')): ?]
            [?php echo form_error('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() . '_' .  $language->getCulture() ?>}', array('class' => 'form-error-msg')) ?]
          [?php endif; ?]
        
          [?php echo image_tag(
            '<?php echo $path ?>',
            array(
                'title' => '<?php echo $title ?>',
                'alt'   => '<?php echo $title ?>',
                'align' => 'top'
            )
          ); ?]
        
          [?php $value = <?php echo $this->getColumnEditTag($column, array('culture' => $language->getCulture(),'control_name' => $this->getSingularName() . '['. $column->getName() . '_' . $language->getCulture() . ']')); ?>; echo $value ? $value : '&nbsp;' ?]
          &nbsp; &nbsp; &nbsp;<?php echo $this->getHelp($column, 'edit') ?>
          </div>
        </div>
    <?php endforeach; ?>

<?php else: ?>
    <div class="form-row">
      [?php echo label_for('<?php echo $this->getParameterValue("edit.fields.".$column->getName().".label_for", $this->getSingularName()."[".$column->getName()."]") ?>', __($labels['<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}']), '<?php if ($column->isNotNull()): ?>class="required" <?php endif; ?>') ?]
      <div class="content[?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?] form-error[?php endif; ?]">
      [?php if ($sf_request->hasError('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}')): ?]
        [?php echo form_error('<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}', array('class' => 'form-error-msg')) ?]
      [?php endif; ?]
    
      [?php $value = <?php echo $this->getColumnEditTag($column); ?>; echo $value ? $value : '&nbsp;' ?]
      <?php echo $this->getHelp($column, 'edit') ?>
      </div>
    </div>
<?php endif ?>

<!-- end -->

<?php if ($credentials): ?>
    [?php endif; ?]
<?php endif; ?>

<?php endforeach; ?>
</fieldset>
<?php endforeach; ?>

[?php include_partial('edit_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]

</form>

<ul class="sf_admin_actions">
<?php
/*
 * WARNING: delete is a form, it must be outside the main form
 */
 $editActions = $this->getParameterValue('edit.actions');
?>
  <?php if (null === $editActions || (null !== $editActions && array_key_exists('_delete', $editActions))): ?>
    <?php echo $this->addCredentialCondition($this->getButtonToAction('_delete', $editActions['_delete'], true), $editActions['_delete']) ?>
  <?php endif; ?>
</ul>