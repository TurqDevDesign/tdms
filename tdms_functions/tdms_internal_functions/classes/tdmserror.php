<?php
class TDMSError
{
    /**
    * Populates a stack trace, which is appended to each custom error log.
    * Last element of trace, the call to the actual TDMSError class, is
    * removed from stack ($i > 1), assuming that the user didn't instantiate
    * the class manually, unless the $logErrorClass param is specifically set to true.
    *
    * @param boolean true to log TDMSError class call in stack, false by default.
    * @return string compiled error stack.
    *
    */
    function debug_backtrace_string($logErrorClass = false) {
        $stack = PHP_EOL . ''; //Assembled ttack trace
        $trace = debug_backtrace(); //Backtrace array
        $traceStep = 1; //Count steps
        unset($trace[0]); //Remove call to this function from stack trace
        $logErrorClass = $logErrorClass ? 0 : 1; //Check param to see if we should log the call to the TDMSError class.
        $args; //Variables passed to last function, exported below.
        $i; //Itteration
        $lastStack; //is it the last stack track? True or false
        $triggerFunc = ''; //The function and parameters that triggered the error
        for($i = count($trace); $i > $logErrorClass; $i-- , $traceStep++) {
            $lastStack = $i == $logErrorClass + 1;
            $stack .= "#" . $traceStep . ' ' . $trace[$i]['file'] ."(" .$trace[$i]['line']."): ";
            if($lastStack && $trace[$i]['args']) {
                $args = var_export($trace[$i]['args'], true);
                $triggerFunc =  substr($args, 7, -1);
                $stack .= PHP_EOL; //If it's the last stack, then we're printing the arguments, put it on
                                   //a new line for cleanliness.
            }
            if(isset($trace[$i]['class'])) {
                $stack .= $trace[$i]['class'] . "->";
            }
            $stack .= $trace[$i]['function'] . "(" . $triggerFunc . ")" . PHP_EOL;

        }
        return $stack;
    }
    /**
    * Constructor for TDMSError class. Takes two parameters.
    * 1 var passed =
    * 2 vars passed =
    * 0 || 3+ vars passed =
    *
    * @param string Unique error number (passed as string to avoid stripping off leading zeros, maintaining consistency).
    * @param array Optional, allows individual cases a means of passing extra parameters from call.
    *
    */
    public function __construct($errNum, $optArray = [])
    {
        $note = '';

        $errOpen = "TDMS Error ($errNum): ";
        switch ($errNum) {
            case 0001:
                $checkOrder = $optArray[2] == ($optArray[0]||$optArray[1]) ? " out of order or as incorrect data types, refer to documentation. ":".";
                $note = $errOpen . "Expected $optArray[0] or $optArray[1] parameters, received " . $optArray[2] . $checkOrder;
            break;
            case 0001.1:
                $checkOrder = ($optArray[2] >= $optArray[0]) && ($optArray[2] <= $optArray[1]) ? " out of order or as incorrect data types, refer to documentation. ":".";
                $note = $errOpen . "Expected " . $optArray[0] . "-" . $optArray[1] . " parameters, received " . $optArray[2] . $checkOrder;
            break;
            case 0001.2:
                $note = $errOpen . "Expected " . $optArray[0] . "-" . $optArray[1] . " parameters, received " . $optArray[2] . ", refer to documentation.";
            break;
            case 0002:
                $note = $errOpen . "File at '" . $optArray[0] . "' not found.";
            break;
            case 0003:
                $note = $errOpen . "Database Connection Error (" . $optArray[0] . ") ". $optArray[1];
            break;
            default:
                error_log("Undefined error number (" . $errNum . "). " . $this->debug_backtrace_string(true));
            break;
        }

        empty($note) ? '' : error_log($note . $this->debug_backtrace_string());

    }

}
