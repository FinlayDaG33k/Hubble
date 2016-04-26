<?php
class MCServerStatus {
 
    public $server;
    public $online, $motd, $online_players, $max_players;
    public $error = "OK";
 
    function __construct($url, $port = '25565') {
 
        $this->server = array(
            "url" => $url,
            "port" => $port
        );
 
        if ( $sock = @stream_socket_client('tcp://'.$url.':'.$port, $errno, $errstr, 1) ) {
 
            $this->online = 2;
 
            fwrite($sock, "\xfe");
            $h = fread($sock, 2048);
            $h = str_replace("\x00", '', $h);
            $h = substr($h, 2);
            $data = explode("\xa7", $h);
            unset($h);
            fclose($sock);
 
            if (sizeof($data) == 3) {
                $this->output = "MOTD: " . $data[0] . ";;Online Players: ".$data[1].";;Max Players: ". $data[2] . ";;";
            }
            else {
				$this->online = 1;
                $this->output = "Cannot retrieve server info.";
            }
 
        }else {
            $this->online = 0;
            $this->output = "Cannot connect to server.";
        }
 
    }
 
}
?>