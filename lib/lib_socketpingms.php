<?php
    function pingServer($domain,$port){
        $starttime = microtime(true);
        $file      = fsockopen ($domain, $port, $errno, $errstr, 1);
        $stoptime  = microtime(true);
        $status    = 0;

        if (!$file) $status = -1;  // Server is down
        else {
            fclose($file);
            $status = ($stoptime - $starttime) * 1000;
            $status = floor($status);
        }
        return $status;
    }
?>