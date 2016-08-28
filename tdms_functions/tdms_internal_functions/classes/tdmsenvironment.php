<?php

class TDMSEnvironment
{

    public static $tdms_startupErrors = [];
    public static $tdms_thePageContent;
    public static $tdms_templateRegistrations = [];
    public static $tdms_configFile = null;

    public function __construct()
    {

        global $tdms_db;
        $tdms_db = new TDMS_DB();

    }

    /**
    * Registers Easy codes. Allows functions to be called in the form [tdms alias (array, of, parameters)]
    * 0 - 1 vars passed = throw error
    * 2 vars passed = Sets registration alias, function, and assumes function may not accept parameter array from easy code.
    * 3 vars passed = Sets registration alias, function, and allows function to accept parameter array from easy code.
    * 4+ throw error
    * @param string alias
    * @param string function name
    * @param boolean accept parameter array?
    */
    public static function tdms_registerEasyCode()
    {
        $paramTypes = '';
        $vars = func_get_args();
        foreach ($vars as &$a) {
            $paramTypes .= gettype($a) . '|';
        }
        if ($paramTypes != '') {
            $paramTypes = substr($paramTypes, 0, - 1);
        }
        switch ($paramTypes) {
            case 'string|string':

                self::$tdms_templateRegistrations[$vars[0]]["func_name"] = $vars[1];
                self::$tdms_templateRegistrations[$vars[0]]["accept_params"] = false;

            break;
            case 'string|string|boolean':

                self::$tdms_templateRegistrations[$vars[0]]["func_name"] = $vars[1];
                self::$tdms_templateRegistrations[$vars[0]]["accept_params"] = $vars[2];

            break;
            default:
                new TDMSError("0001", array(2,3,func_num_args()));
            break;
        }
    }

    /**
    * Checks $_GET parameters
    * 0 vars passed = check for existance of any $_GET params, returns true if populated
    * 1 var  passed = returns value of passed $_GET param, false if not found
    * 2 vars passed = compares passed variables as a key value pair against $_GET params, true if found correct.
    * 3+ throw error
    * @param string key
    * @param string value
    * @return string|boolean value of passed $_GET param, false if not set
    */
    public static function tdms_getParam()
    {
        $tdmsGetParameters;
        $urlParamString = 'tdms-get-params';
        $urlKVDelimiter = "_";
        $paramTypes = '';
        $vars = func_get_args();
        foreach ($vars as &$a) {
            $paramTypes .= gettype($a) . '|';
        }
        if ($paramTypes != '') {
            $paramTypes = substr($paramTypes, 0, - 1);
        }
        if (isset($_GET[$urlParamString]) && !empty($_GET[$urlParamString])) {
            $rawParams = explode("/", $_GET[$urlParamString]);

            foreach ($rawParams as $kvset) {
                if (strpos($kvset, $urlKVDelimiter) !== false) {
                    $refinedParams = explode($urlKVDelimiter, $kvset);
                    $tdmsGetParameters[$refinedParams[0]] = $refinedParams[1];
                } else {

                    $tdmsGetParameters['page'] = $kvset;
                }
            }

            foreach ($_GET as $key => $value) {
                if ($key != $urlParamString) {
                    $tdmsGetParameters[$key] = $value;
                }
            }

        } else {
            foreach ($_GET as $key => $value) {
                $tdmsGetParameters[$key] = $value;
            }
        }
        switch ($paramTypes) {
            case '':
                if (!empty($tdmsGetParameters)) {
                    return true;
                } else {
                    return false;
                }
            break;
            case 'string':
                if (isset($tdmsGetParameters[$vars[0]]) && !empty($tdmsGetParameters[$vars[0]])) {
                    $paramVal = strtolower($tdmsGetParameters[$vars[0]]);
                    return $paramVal;
                } else {
                    return false;
                }
            break;
            case 'string|string':
                if (isset($tdmsGetParameters[$vars[0]])
                && !empty($tdmsGetParameters[$vars[0]])
                && ($tdmsGetParameters[$vars[0]] == $vars[1])) {
                    return true;
                } else {
                    return false;
                }
            break;
            default:
                new TDMSError("0001.1", array(0,2,func_num_args()));
            break;
        }
    }

    /**
    * [[Description]]
    */
    public static function tdms_postParam()
    {
        return "this works";
    }

    /**
    * [[Description]]
    */
    public static function tdms_formatPath($path) //06281996
    {
        return "this works";
    }

    /**
    * [[Description]]
    */
    public function tdms_displayPublic()
    {

    }

    /**
    * [[Description]]
    */
    public function tdms_displayAdmin()
    {

    }

    /**
    * [[Description]]
    */
    public function tdms_loadSidebar()
    {

    }

    /**
    * [[Description]]
    */
    public static function tdms_setThePageContent()
    {
        $initiative = 'no-page';

        if (self::tdms_getParam('setup') && self::tdms_setupErrorsExist()) {
            $initiative = 'setup';
        }

        switch ($initiative) {
            case 'setup':
            switch (self::tdms_getParam('setup')) {
                case '1':
                    self::$tdms_thePageContent['body'] = TDMS_SERVER_ROOT . "/tdms_setup/setup_db.php";
                break;
                case '2':
                    self::$tdms_thePageContent['body'] = TDMS_SERVER_ROOT . "/tdms_setup/setup_db_form.php";
                break;
                case '3':
                    self::$tdms_thePageContent['body'] = TDMS_SERVER_ROOT . "/tdms_setup/setup_admin_login.php";
                break;
                case '4':
                    self::$tdms_thePageContent['body'] = TDMS_SERVER_ROOT . "/tdms_setup/setup_db.php";
                break;
                default:
                    http_response_code(404); //06281996
                break;
            }

            break;
            case 'read-page':
                if (true) {
                    //06281996
                }
            break;
            default:
                http_response_code(404); //06281996
            break;
        }
    }

    /**
    * [[Description]]
    */
    public static function tdms_checkIfVal($checkVar)
    {

        if(isset($checkVar) && !empty($checkVar) && $checkVar != (null || ''))
        {

            return $checkVar;

        } else {

            return false;

        }

    }
    /**
    * Helper for tdms_setupErrorsExist.
    * Takes string to add to $tdms_startupErrors array.
    *
    * @param string Name of error
    */
    public static function tdms_populateStartupError($errorName) {

        in_array($errorName, self::$tdms_startupErrors) ? '' : self::$tdms_startupErrors[] = $errorName;

    }
    /**
    * Passes any errors to $tdms_startupErrors array.
    */
    public static function tdms_checkSetupErrors()
    {

        //Golbal database connection var
        global $tdms_db, $tdms_configFile;

        //Does config file exist? If not then add 'config' to error list,
        //if it does then set global $tdms_configFile (config path) var.
        if(!TDMSConfig::tdms_configExists())
        {
            self::tdms_populateStartupError('config');
        } else {

            $tdms_configFile = TDMSConfig::tdms_configExists();

        }

        //Test database connection, if theres no connection then add 'database' to error list.
        if(!$tdms_db->test())
        {
            self::tdms_populateStartupError('database');
        }

    }
    /**
    * Determines if errors have been passed to $tdms_startupErrors array.
    */
    public static function tdms_setupErrorsExist()
    {
        //For now, just see if we populated any errors and return true or false.
        //In the future we may traverse the $tdms_startupErrors array
        //to selectively run startup pages.
        if (count(self::$tdms_startupErrors) > 0
        && !empty(self::$tdms_startupErrors)) {
            return true;
        } else {
            return false;
        }
    }

    /**
    * [[Description]]
    */
    public static function tdms_handleEasyCodes($assembledPage)
    {

        function tdms_convertParamsToArray($params)
        {

            $paramsArray;

            if(TDMSEnvironment::tdms_checkIfVal($params))
            {

                $placeholderArray = explode(',', substr($params, 2, - 1));
                $paramsArray = array_map('trim',$placeholderArray);

            } else {

                $paramsArray = '';

            }

            return $paramsArray;
        }

        function tdms_pregCallback($matches)
        {

            $replacer;
            $alias = trim($matches[3]);
            $regExists = TDMSEnvironment::tdms_checkIfVal(TDMSEnvironment::$tdms_templateRegistrations[$alias]);

            if(TDMSEnvironment::tdms_checkIfVal(TDMSEnvironment::$tdms_templateRegistrations) && $regExists)
            {
                $registration = TDMSEnvironment::$tdms_templateRegistrations[$alias];

                if($registration['accept_params'] && TDMSEnvironment::tdms_checkIfVal($matches[5]))
                {

                    $replacer = call_user_func_array($registration['func_name'], tdms_convertParamsToArray($matches[5]));

                } else {

                    $replacer = call_user_func($registration['func_name']);

                }

            } else {

                $replacer = $matches[0];

            }

            return $replacer;

        }

        $pattern = "/(\[tdms)(\s+)([\w\.-]+)(\s*)(\s+\([\s\w\.\-\,]+\))?(\s*)\]/";
        $formattedOutput = preg_replace_callback($pattern, 'tdms_pregCallback', $assembledPage);

        return $formattedOutput;

    }

    /**
    * [[Description]]
    */
    public static function tdms_loadPageContent()
    {

        if (isset(self::$tdms_thePageContent['header']) && !empty(self::$tdms_thePageContent['header'])) {
            $tdms_pageHeader = self::$tdms_thePageContent['header'];
        } else {
            $tdms_pageHeader = null;
        }
        if (isset(self::$tdms_thePageContent['body']) && !empty(self::$tdms_thePageContent['body'])) {
            $tdms_pageBody = self::$tdms_thePageContent['body'];
        } else {
            $tdms_pageBody = null;
        }
        if (isset(self::$tdms_thePageContent['footer']) && !empty(self::$tdms_thePageContent['footer'])) {
            $tdms_pageFooter = self::$tdms_thePageContent['footer'];
        } else {
            $tdms_pageFooter = null;
        }

        //Start Output buffer to capture content before display.
        //This allows us to regex the assembled page before sending to client.
        //With this, we can apply registered Easy Codes, without breaking any PHP
        //that may have been in the user's page.
        ob_start();
            isset($tdms_pageHeader) ? include_once $tdms_pageHeader : '';
            isset($tdms_pageBody)   ? include_once $tdms_pageBody : '';
            isset($tdms_pageFooter) ? include_once $tdms_pageFooter : '';

            $unformattedOutput = ob_get_contents();
            $formattedOutput   = self::tdms_handleEasyCodes($unformattedOutput);
        ob_end_clean();

        return $formattedOutput;

    }

}
