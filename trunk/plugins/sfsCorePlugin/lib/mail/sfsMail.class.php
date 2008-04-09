<?php
/**
 * Class provides functionality for send email.
 *
 * @package    plugins.sfsCorePlugin.lib
 * @subpackage mail
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class sfsMail extends Mail
{
    protected $bodyParams = array();
    
    /**
    * Creates mailer object, sets mail parameters: from, charset and priority.
    *
    * @param  void
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function __construct()
    {
        parent::__construct();

        $this->setFrom(sfConfig::get('app_mail_address_from', 'admin@localhost.com'));
        $this->setPriority(1);
        $this->setCharset('utf8');
        $this->setEncoding('utf8');
    }
    
    /**
    * Sets subject and body from template.
    *
    * @param object $template
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function setTemplate(sfsEmailTemplate $template)
    {
        $this->setSubject($template->getSubject());
        $this->setBody($template->getBody());
    }
    
    /**
    * Assign array with body params to protected variable of class.
    *
    * @param array $bodyParams
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function setBodyParams(array $bodyParams)
    {
        $this->bodyParams = $bodyParams;
    }
    
    /**
    * Gets array with body params.
    *
    * @param void
    * @return array
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getBodyParams()
    {
        return $this->params;
    }
    
    /**
    * Sets mail body.
    *
    * @param array $bodyParams
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function setBody($body)
    {
        $this->mailer->Body = $body;
    }
    
    /**
    * Replaces labels in body on value of body params. Calls parent function send.
    *
    * @param array $bodyParams
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function send()
    {
        $params = $this->getParams();
        
        if (is_array($params) && !empty($params)) {
            foreach($params as $key => $value) {
                $this->mailer->Body = str_replace('%' . $key . '%', $value, $this->mailer->Body);
            }
        }
        
        parent::send();
    }
}