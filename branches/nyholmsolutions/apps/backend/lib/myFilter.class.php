<?php

class myFilter extends sfFilter {
  /**
   *   Execute
   *
   */
  public function execute ($filterChain) {
    // Code to execute before the action execution
    //
    //sfContext::getInstance()->getUser()->init();



    // Execute next filter in the chain
    $filterChain->execute();

    

    // Code to execute after the action execution, before the rendering
    //
    //sfContext::getInstance()->getUser()->setCulture(authUser::getDesktop()->getLanguageIso());
    
    
    
  }

}

