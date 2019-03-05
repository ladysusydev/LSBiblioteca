<?php
/**
 * Configuration
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

define('_LS', 1);

/**
 * Class that allows me to define the environment variables of the system
 */
class LSConfig
{
    /**
     * Server URL
     */ 
    public $baseUrl = 'http://localhost';
    
    /**
     * Server
     */ 
    public $server = 'localhost';

    /**
     * System name
     */ 
    public $appName = 'Sistema Biblioteca';
    
    /**
     * Security Hash
     */ 
    public $hashKey = '5037a60152ac0';

    /**
     * User of database
     */ 
    public $user = 'root';
    
    /**
     * Database password
     */ 
    public $password = 'linuxOS';
    
    /**
     * ID root
     */ 
    public $userRoot = 1;

    /**
     * Database
     */ 
    public $database = 'biblioteca';
    
    /**
     * Prefix of tables in the database
     */ 
    public $dbprefix = 'ls_';

    /**
     * Language of the application
     */ 
    public $language = 'en-US';
    
    /**
     * State of trace
     */ 
    public $trace = false;

    /**
     * Template defined
     */ 
    public $template = 'ladysusy';
    
    /**
     * Timezone
     */
    public $timezone = 'America/El_Salvador';
    
    /**
     * Ubication
     */
    public $locale = 'es_ES';
    
    /**
     * Version of the application
     */ 
    public $version = '1.2.0';

    /**
     * Application channel
     */ 
    public $channel = 'development';
}
