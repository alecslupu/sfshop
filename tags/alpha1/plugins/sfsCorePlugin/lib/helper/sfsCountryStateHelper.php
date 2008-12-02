<?php
function get_states_list_in_js()
{
    $criteriaCountry = new Criteria();
    CountryPeer::addPublicCriteria($criteriaCountry);
    $countries = CountryPeer::getAll($criteriaCountry);
    
    $script = '
        var
            countries_id           = new Array(),
            countries_states_id    = new Array(),
            countries_states_title = new Array();
        ';
    
    $i = 0;
    
    $criteriaState = new Criteria();
    StatePeer::addPublicCriteria($criteriaState);
    
    foreach ($countries as $country) {
        
        $states = StatePeer::getByCountryId($country->getId(), clone $criteriaState, true);
        
        $script.= '
            states_id    = new Array();
            states_title = new Array();
        ';
        
        if (count($states) > 0) {
            $j = 0; 
            
            foreach ($states as $state) {
                $script.= '
                    states_id[' . $j . '] = ' . $state->getId() . '
                    states_title[' . $j . '] = "' . $state->getTitle() . '"';
                $j++;
                
            }
            
            $script.= '
                countries_id[' . $i .']           = "' . $country->getId() .'"
                countries_states_id[' . $i .']    = states_id
                countries_states_title[' . $i .'] = states_title;
            ';
        }
        $i++; 
    }
    
    return $script;
}
?>