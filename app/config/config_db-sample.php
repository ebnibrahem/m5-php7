<?php
########################
# Database config
#######################
use M5\MVC\Config;

/* >> Offline*/

if (DEV == "localhost") {
   $config_db = [
      "host"         => "localhost",
      "database"     => "hr",
      "database_en"  => "hr_en",
      "username"     => "root",
      "password"     => "",
      "port"         => 3306
   ];
} else {
   /* >> Online*/

   $config_db = [
      "host"         => "127.0.0.1",
      "database"     => "rafat_hrd_ar",
      "database_en"  => "rafat_db_en",
      "username"     => "rafat_db_user",
      "password"     => "password",
      "port"         => 3306
   ];
}

Config::set("database", $config_db);

/*English version*/
Config::set("db_name_en", 'notepad');
