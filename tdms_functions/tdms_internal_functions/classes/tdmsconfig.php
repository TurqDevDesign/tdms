<?php
class TDMSConfig
{
    public function __construct()
    {
    }
    /**
    * Searches JSON file for value
    * Accepts only 2 parameters.
    * @param Path of json file
    * @param string|array entry of requested JSON value, use an array to return a nested JSON entry
    * @return string|boolean If the requested JSON value is found and is !empty, returns value, otherwise false.
    */
    public static function tdms_getJSONValue($path, $entry, $logErrors = true)
    {
        if(strrpos(trim($path), '/', -strlen(trim($path))) !== false)
        {
            $path = substr(trim($path), 1);
        }
        if(file_exists($path))
        {
            $json = file_get_contents($path);
            $data = json_decode($json,true);
            $newData = $data;
            if(gettype($entry) == 'array')
            {
                foreach($entry as $layer)
                {
                    if(TDMSEnvironment::tdms_checkIfVal($newData[$layer]))
                    {
                        $newData = $newData[$layer];
                    } else {
                        $newData = false;
                    }
                }
            } else if(gettype($entry) == 'string') {
                if(TDMSEnvironment::tdms_checkIfVal($newData[$entry]))
                {
                    $newData = $newData[$entry];
                } else {
                    $newData = false;
                }
            } else {
                $newData = false;
            }
            return $newData;
        } else {
            if($logErrors) {
                new TDMSError("0002", array($path));
                return false;
            }
            return false;
        }
    }
    /**
    * [[Description]]
    */
    public static function tdms_configExists()
    {
        $configPath = self::tdms_getJSONValue('tdms_files/tdms_info.json', array('config', 'configurationFolder'));
        if(TDMSEnvironment::tdms_checkIfVal($configPath) && file_exists('/' . TDMS_SERVER_ROOT . '/tdms_configurations' . $configPath))
        {
            return $configPath;
        } else {
            return false;
        }
    }
    /**
    * [[Description]]
    */
    public function tdms_versionToDate() //06281996 set up version control
    {
        if(true)
        {
            return true;
        } else {
            return false;
        }
    }
}
