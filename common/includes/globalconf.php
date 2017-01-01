<?php

class GlobalConf
{
    public $conf;
    public static $attempts;


    public function __construct()
    {
        require(dirname(__DIR__).'/config.php');
        require(dirname(__DIR__).'/globalcon.php');
        $this->ip_address = $ip_address;
        $this->login_timeout = $login_timeout;
        $this->timeout_minutes = $timeout_minutes;
        $this->base_url = $base_url;
        $this->signin_url = $signin_url;
        $this->max_attempts = $max_attempts;
        $this->mod_ldap = $mod_ldap;
    }

    public function addAttempt()
    {
        $attempts++;
    }
    public function resetAttempts()
    {
        $attempts = 0;
    }
}
