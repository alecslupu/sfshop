<?php echo select_tag(
    'admin[credential]', 
    options_for_select(
        array('superadmin' => 'superadmin', 'admin' => 'admin'),
        explode(',', $admin->getCredential())
    ), 
    array(
        'multiple' => true,
        'style'    => 'width: 200px'
    )
); ?>