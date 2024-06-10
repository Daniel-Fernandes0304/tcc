<?php

/**
 * Configuração do Compoente de Abstração de Banco de Dados
 */
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "10.91.249.10",
    "port" => "3306",
    "dbname" => "aurahealth",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

/**
 * URLs do Projeto
 */
define('CONF_URL_BASE', 'http://www.localhost/tcc2');
define('CONF_VIEW_PATH', __DIR__ . '/../../views/');
define('CONF_VIEW_EXT', 'php');
define('CONF_UPLOAD_DIR', 'storage');
define('CONF_URL_API', 'api.localhost/TCC');




/**
 * Configurações de Senhas
 */
define("CONF_PASSWD_MIN_LEN", 4);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["const" => 10]);

/**
 * SITE
 */
define("CONF_SITE_NAME", "TCC");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "tcc.com.br");
define("CONF_SITE_DESC", "");
define("CONF_SITE_TITLE", "");

/**
 * SOCIAL
 */
define("CONF_SOCIAL_FACEBOOK_APP", "626590460695980");
define("CONF_SOCIAL_FACEBOOK_PAGE", "TCC");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "TCC");
define("CONF_SOCIAL_INSTAGRAM", "TCC");
define("CONF_SOCIAL_GOOGLE_PAGE", "107305124528362639842");
define("CONF_SOCIAL_GOOGLE_AUTHOR", "103958419096641225872");
/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");


/**
 * MESSAGE
 */
define("CONF_MESSAGE_CLASS", "trigger");
define("CONF_MESSAGE_INFO", "info");
define("CONF_MESSAGE_SUCCESS", "success");
define("CONF_MESSAGE_WARNING", "warning");
define("CONF_MESSAGE_ERROR", "error");


/**
 * UPLOAD
 */
// define("CONF_UPLOAD_DIR", "../storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "smtp.hostinger.net");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_USER", "techgroup@gmail.com.br");
define("CONF_MAIL_PASS", "**************************");
define("CONF_MAIL_SENDER", ["name" => "AuraHealth", "address" => "techgroup@gmail.com.br"]);
define("CONF_MAIL_SUPPORT", "techgroup@gmail.com.br");
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");


