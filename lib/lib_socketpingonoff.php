<?php
    function pingServer($domain,$port){
        $starttime = microtime(true);
        $file      = fsockopen ($domain, $port, $errno, $errstr, 1);
        $stoptime  = microtime(true);
        $status    = 0;

        if (!$file) $status = 0;  // Server is down
        else {
            fclose($file);
            $status = 1;
        }
        return $status;
    }
?>