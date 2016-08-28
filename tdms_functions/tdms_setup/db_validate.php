<?php 

    $connectionIsSuccessful;

    if(isset($_POST['db_name']) /* && validateForm() */)
    {
        
        $connectionIsSuccessful = true;
        print_r($_POST);
    
        
    } else {
        
        
        $connectionIsSuccessful = false;
        
    }
    

    if($connectionIsSuccessful)
    {

        $db_form_name = "submitDBInfoToConfig";
        $db_form_value = "Submit and Continue";

    } else {
        
        $db_form_name = "checkConnection";
        $db_form_value = "Check Connection";
        
    }

?>