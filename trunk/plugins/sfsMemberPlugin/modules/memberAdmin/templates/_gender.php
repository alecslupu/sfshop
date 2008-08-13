<?php
    echo select_tag(
        'member[gender]',
        options_for_select(
            MemberPeer::getGenders(),
            $member->getGender()
        ),
        array(
            'id' => 'member_gender'
        )
    );
?>
