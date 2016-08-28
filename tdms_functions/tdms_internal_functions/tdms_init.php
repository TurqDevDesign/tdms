<?php

// SPL Autoload function for autoloading classes
require TDMS_INTERNAL . 'autoload.php';

//Global $tdms_db variable
$tdms_db;

$tdms = new TDMSEnvironment();

$tdms->tdms_checkSetupErrors();

if ($tdms->tdms_setupErrorsExist()) {

    if(TDMSEnvironment::tdms_getParam('setup')){
        TDMSEnvironment::tdms_setThePageContent();
    } else {
        echo '<script type="text/javascript">
              window.location.href = \'http://' . TDMS_BASE_URL . '/setup_1\'' . ';
              </script>';
    }
} else {
    TDMSEnvironment::tdms_setThePageContent();
}
