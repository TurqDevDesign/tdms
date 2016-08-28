<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

/**
  *
  *  Initializes TDMS environment
  *		Checks tdms_files/tdms_info.json file for plugin/db loading path
  *  	Checks for database connection
  *  		On fail    - Initialize setup and generate configuration file
  *  		On Success - Find default page and load, if not found then proceed with setup
  *
  *  IF sidebar = true THEN load sidebar and request login
  *
**/

    // Directory above public files containing all TDMS fuction/class files non-specific to installation
	define('TDMS_SERVER_ROOT', trim(dirname($_SERVER['DOCUMENT_ROOT'])) . '/tdms_functions');

    // TDMS files specific to installation, in installation directory
	define('TDMS_SITE_ROOT', trim(dirname($_SERVER['SCRIPT_FILENAME'])) . '/tdms_files');

    // General directory for internal TDMS classes and environment files
    define('TDMS_INTERNAL', TDMS_SERVER_ROOT . '/tdms_internal_functions/');

    // General directory for internal TDMS classes and environment files
    define('TDMS_BASE_URL', $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']));

    // Begin environment
	require TDMS_INTERNAL . 'tdms_init.php';


    //TDMSEnvironment::tdms_registerEasyCode("get", "TDMSEnvironment::tdms_getParam", true);
    //TDMSEnvironment::tdms_registerEasyCode("post", 'TDMSEnvironment::tdms_postParam', true);
    //echo TDMSEnvironment::tdms_checkIfVal(TDMSConfig::tdms_getJSONValue('tdms_files/tdms_info.json', array('config', 'configurationFolder')));
    //echo TDMSEnvironment::tdms_checkIfVal(TDMSConfig::tdms_getJSONValue('/' . TDMS_SERVER_ROOT . '/tdms_configurations/tdms_config_template.json', array('_Section_Description')));
    //echo TDMSConfig::tdms_dbReach('a','a','a','a',5);

    //echo TDMSEnvironment::tdms_getParam(page);
    //echo TDMSEnvironment::tdms_getParam(post);
    //echo $_SERVER['PHP_SELF'];

    // Loads sidebar if sidebar=true && tdms_full is not set
    //$tdmsEnvironment->tdms_loadSidebar();

    // Loads page content based on URL params
    echo TDMSEnvironment::tdms_loadPageContent();
    //print_r(TDMSEnvironment::$tdms_startupErrors);
