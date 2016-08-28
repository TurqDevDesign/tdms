<?php
class TDMS_DB
{
    protected $tdms_host;
    protected $tdms_username;
    protected $tdms_password;
    protected $tdms_dbName;
    protected $tdms_port;
    public    $tdms_paramStatus; // true if all db params are successfully populated

    public function __construct()
    {

        global $tdms_configFile;

        $this->tdms_host     = TDMSConfig::tdms_getJSONValue($tdms_configFile, array('tdms_database', 'databaseHost'), false);
        $this->tdms_username = TDMSConfig::tdms_getJSONValue($tdms_configFile, array('tdms_database', 'databaseUserame'), false);
        $this->tdms_password = TDMSConfig::tdms_getJSONValue($tdms_configFile, array('tdms_database', 'databasePassword'), false);
        $this->tdms_dbName   = TDMSConfig::tdms_getJSONValue($tdms_configFile, array('tdms_database', 'databaseName'), false);
        $this->tdms_port     = TDMSConfig::tdms_getJSONValue($tdms_configFile, array('tdms_database', 'databasePort'), false);

        //sets $tdms_paramStatus
        //$tdms_paramStatus simply preemptively determines if all params are set,
        //this allows us to possibly save some computing time later by circumventing
        //the connection attempts if the parameters weren't even populated
        if($this->tdms_host && $this->tdms_username && $this->tdms_password && $this->tdms_dbName && $this->tdms_port) {

            $tdms_paramStatus = true;

        } else {

            $tdms_paramStatus = false;

        }

    }
    /**
    * [[Description]]
    */
    public function test($optionals = array())
    {

        $success;

        $optionals = array_filter($optionals);

        $defaults = array(
            'host' => $this->tdms_host,
            'user' => $this->tdms_username,
            'pass' => $this->tdms_password,
            'name' => $this->tdms_dbName,
            'port' => $this->tdms_port
        );

        $params = array_replace($defaults, $optionals);

        $initiateTest = new mysqli();

        //echo "<pre style='text-align:left'>";
        //var_dump($initiateTest);

        if ($initiateTest->connect_error) {
            new TDMSError("0003", array($initiateTest->connect_errno,$initiateTest->connect_error));
            return false;
        } else {
            if($initiateTest)
            {
                $initiateTest->close();
                return true;
            } else {
                return false;
            }
        }
        error_log($initiateTest);


    }
    /**
    * [[Description]]
    */
    public function write()
    {
        $this->build();
    }
    /**
    * [[Description]]
    */
    public function connect()
    {
    }
    /**
    * [[Description]]
    */
    private function build()
    {
        $sql = 'MySQL_QUERY
        CREATE TABLE IF NOT EXISTS ' . $this->configVal('dbName') . ' (
        title VARCHAR(150),
        bodytext TEXT,
        created	VARCHAR(100)
        )';
        echo $sql;
        //return mysql_query($sql);
    }
    /**
    * [[Description]]
    */
    public function fail()
    {
    }
    /**
    * [[Description]]
    */
    public static function reach()
    {
        $vars = func_get_args();
        $vars = array_filter($vars);
        if(count($vars) > 6 || count($vars) < 1)
        {
            new TDMSError("0001.2", array(1,6,func_num_args()));
            return false;
        } else {
            $mysqli = new mysqli(...$vars);
            if ($mysqli->connect_error) {
                new TDMSError("0003", array($mysqli->connect_errno,$mysqli->connect_error));
                return false;
            } else {
                if($mysqli)
                {
                    $mysqli->close();
                    return true;
                } else {

                    return false;

                }

            }
        }
    }
}
