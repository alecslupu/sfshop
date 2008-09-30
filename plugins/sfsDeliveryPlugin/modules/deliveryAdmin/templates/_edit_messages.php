<?php if ($form->getErrorSchema()->getErrors()): ?>
<div class="form-errors">
<h2><?php echo __('The form is not valid because it contains some errors.') ?></h2>
<dl>
<?php foreach ($form->getErrorSchema()->getErrors() as $name => $error): ?>
    <?php if ($name != 'params'): ?>
        <dt><?php echo ucfirst($name) ?></dt>
        <dd><?php echo $error ?></dd>
    <?php else: ?>
        <?php preg_match_all('/(.*?)\[(.*?)\]/s', $error, $res) ?>
        
        <?php if (is_array($res) && count($res) > 0): ?>
            <?php foreach ($res[1] as $key => $field): ?>
                
                <?php if ($form->getWidgetSchema()->getLabel($field) != ''): ?>
                    <dt><?php echo ucfirst($form->getWidgetSchema()->getLabel($field)) ?></dt>
                <?php else: ?>
                    <dt><?php echo ucfirst($form->getWidgetSchema()->getFormFormatter()->generateLabelName($field)) ?></dt>
                <?php endif; ?>
                
                <dd><?php echo $res[2][$key] ?></dd>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>
</dl>
</div>
<?php elseif ($sf_user->hasFlash('notice')): ?>
<div class="save-ok">
<h2><?php echo __($sf_user->getFlash('notice')) ?></h2>
</div>
<?php endif; ?>
