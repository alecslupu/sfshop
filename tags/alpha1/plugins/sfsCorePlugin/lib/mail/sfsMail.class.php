<?php
/**
 * sfShop, open source e-commerce solutions.
 * (c) 2008 Dmitry Nesteruk <nest@dev-zp.com>
 * 
 * Released under the MIT License.
 * 
 * For the full copyright and license information, please view the LICENSE file.
 */

/**
 * Class provides functionality for send email.
 *
 * @package    plugins.sfsCorePlugin
 * @subpackage lib.mail
 * @author     Dmitry Nesteruk  <nest@dev-zp.com>
 */
class sfsMail extends Mail
{
    protected $bodyParams = array();
    
    /**
    * Creates mailer object, sets mail parameters.
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
        $this->setContentType('text/html');
        
        if (sfConfig::get('app_mail_smtp', false))
        {
            $this->setHostname(sfConfig::get('app_mail_smtp_host'));
            $this->setPort(sfConfig::get('app_mail_smtp_port'));
            $this->setUsername(sfConfig::get('app_mail_smtp_username'));
            $this->setPassword(sfConfig::get('app_mail_smtp_password'));
        }
        
        //$this->setCharset('utf8');
        //$this->setEncoding('utf8');
    }
    
    /**
    * Sets subject and body from template.
    *
    * @param object $template
    * @return void
    * @author Dmitry Nesteruk
    * @access public
    */
    public function setTemplate(EmailTemplate $template)
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
        return $this->bodyParams;
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
        $params = $this->getBodyParams();
        
        if (is_array($params) && !empty($params)) {
            foreach($params as $key => $value) {
                $this->setBody(str_replace('%' . $key . '%', $value, $this->getBody()));
            }
        }
        
        parent::send();
    }
}