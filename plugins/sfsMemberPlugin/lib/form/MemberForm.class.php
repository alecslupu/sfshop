<?php

/**
 * Member form.
 *
 * @package    form
 * @subpackage members
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class MemberForm extends BaseMemberForm
{
    public function configure()
    {
        $this->defineSfsListFormatter();
    }
}
