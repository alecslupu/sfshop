<div id="wrapper">
    <div id="header">
        <br/>
        <?php include_component('core', 'selectLanguage'); ?>
        <h1 class="logo">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo link_to('ADMIN PANEL', '@homepage') ?></h1>
        <div id="header-in">
            <p><?php include_partial('coreAdmin/navigation_bar'); ?></p>
        </div>
        <ul id="auth_bar">
            <li>
                <?php include_partial('coreAdmin/auth_bar'); ?>
            </li>
        </ul>
    </div>
    <div class="bar"></div>
    <div class="content_block">
