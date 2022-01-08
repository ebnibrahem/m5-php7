<?php
##############################
# SMTP config
#############################

/*local environment*/
if ($_SERVER['HTTP_HOST'] == "localhost") {
   define('mail_host', 'HOST');
   define('mail_user', ' USER');
   define('mail_pass', '');
   define('mail_from', ' USER');
   define('mail_port', 25);
} else {

   /*Online environment*/
   define('mail_host', '');
   define('mail_user', '');
   define('mail_pass', '');
   define('mail_from', '');
   define('mail_port', 25);
}

$GLOBALS['email_set_addReplyTo'] = "";
