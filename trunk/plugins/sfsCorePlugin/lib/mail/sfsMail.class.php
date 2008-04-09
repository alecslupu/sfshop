<?php
/**
 * Class provides solution for send mail.
 *
 * @package    plugins.sfsCorePlugin.lib
 * @subpackage mail
 * @author     Dmitry Nesteruk
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class sfsMail extends Mail
{
    protected $params = array();
    
    public function __construct()
    {
        parent::__construct();

        $this->setFrom(sfConfig::get('app_mail_address_from', 'admin@localhost.com'));
        $this->setPriority(1);
        $this->setCharset('utf8');
        $this->setEncoding('utf8');
    }
    
    public function setTemplate(sfsEmailTemplate $template)
    {
        $this->setSubject($template->getSubject());
        $this->setBody($template->getBody());
    }
    
    public function setParams(array $params)
    {
        $this->params = $params;
    }
    
    public function getParams()
    {
        return $this->params;
    }
    
    public function setBody($body)
    {
        $this->mailer->Body = $body;
        $params = $this->getParams();
        
        if (is_array($params) && !empty($params)) {
            foreach($params as $key => $value) {
                $this->mailer->Body = str_replace('%' . $key . '%', $value, $this->mailer->Body);
            }
        }
    }
}