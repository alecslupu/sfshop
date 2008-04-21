<tr><td><b><?php echo __('Your Address') ?></b></td></tr>
<tr>
    <td><?php echo $form['address']['country_cid']->renderLabel(); ?></td>
    <td><?php echo $form['address']['country_cid']->render(); ?></td>
    <td><?php echo $form['address']['country_cid']->renderError(); ?></td>
</tr>
<tr>
    <td><?php echo $form['address']['state']->renderLabel(); ?></td>
    <td><?php echo $form['address']['state']->render(); ?></td>
    <td><?php echo $form['address']['state']->renderError(); ?></td>
</tr>
<tr>
    <td><?php echo $form['address']['city']->renderLabel(); ?></td>
    <td><?php echo $form['address']['city']->render(); ?></td>
    <td><?php echo $form['address']['city']->renderError(); ?></td>
</tr>
<tr>
    <td><?php echo $form['address']['street']->renderLabel(); ?></td>
    <td><?php echo $form['address']['street']->render(); ?></td>
    <td><?php echo $form['address']['street']->renderError(); ?></td>
</tr>
<tr>
    <td><?php echo $form['address']['postcode']->renderLabel(); ?></td>
    <td><?php echo $form['address']['postcode']->render(); ?></td>
    <td><?php echo $form['address']['postcode']->renderError(); ?></td>
</tr>
