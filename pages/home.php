<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/config.inc.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/lang/'. CONF_LANG . '.php');
    session_start();
    

    // establishing the MySQLi connection
    $con = mysqli_connect(CONF_MYSQL_SERVER,CONF_MYSQL_USER,CONF_MYSQL_PASS,CONF_MYSQL_DB);
    
    if (mysqli_connect_errno()){
        echo "MySQLi Connection was not established: " . mysqli_connect_error();
    }
    if(isset($_SESSION['user'])){
    $getid = "select ID, authkey from users where username='".$_SESSION['user']."' LIMIT 1;";
        if($user_row = $con->query($getid)){
            $user_row = $user_row->fetch_row(); // Convert the row to Array
            $user_id = $user_row[0];
			$user_authkey = $user_row[1];
            $getservers = "select * from servers where server_owner='".$user_id."' ORDER BY server_status asc, server_name ASC;";
            if ($servers=mysqli_query($con,$getservers)){
                ?>
				
				You own a total of <?php echo mysqli_num_rows($servers); ?> servers of which <?php $getofflineservers = "select * from servers where server_owner='".$user_id."' AND server_status=0"; $offlineservers=mysqli_query($con,$getofflineservers); echo mysqli_num_rows($offlineservers); ?> are offline
                    <table class="table table-hover">
                        <thead>
                            <th>Server Name</th>
							<th>Server IP</th>
                            <th>Server Port</th>
                            <th>Server Status</th>
							<th>Last Check</th>
							<th>Last Error</th>
							<th>Server Actions</th>
                        </thead>
                <?php
                while ($server = mysqli_fetch_row($servers)){
                    ?>
                        <tr>
                            <td><?php echo htmlentities($server[6]); ?></td>
							<td><?php echo htmlentities($server[2]); ?></td>
                            <td><?php echo htmlentities($server[3]); ?></td>
                            <td>
								<?php if($server[4] == "2"){ ?>
									<button type="button" class="btn btn-success" <?php if($server[8] !== "" && $server[8] !== null){?>onclick="alert('<?php echo mysqli_real_escape_string($con,$server[8]); ?>')"<?php }?>>Online</button>
								<?php }elseif($server[4] == "0"){ ?>
									<button type="button" class="btn btn-danger" <?php if($server[8] !== "" && $server[8] !== null){?>onclick="alert('<?php echo mysqli_real_escape_string($con,$server[8]); ?>')"<?php }?>>Offline</button>
								<?php }elseif($server[4] == "1"){ ?>
									<button type="button" class="btn btn-warning" <?php if($server[8] !== "" && $server[8] !== null){?>onclick="alert('<?php echo mysqli_real_escape_string($con,$server[8]); ?>')"<?php }?>>Error</button>
								<?php } ?>
							</td>
							<td><?php echo $server[5]; ?></td>
							<td><?php echo $server[7]; ?></td>
							<th>
								<?php if($server[9] == "ts3" && $server[4] == "0"){ ?><a href="?action=setup_ts3&server_id=<?php echo $server[0]; ?>"><button type="button" class="btn btn-primary">setup</button></a><?php } ?>
								<a href="?action=editserver&server_id=<?php echo $server[0]; ?>"><button type="button" class="btn btn-warning">Edit</button></a>
								<a href="inc/removeserver.php?server_id=<?php echo $server[0]; ?>"><button type="button" class="btn btn-danger">Remove</button></a>
							</th>
						</tr>
                    <?php
                }
                ?>
                    </table>
                <?php
            
            }
			?>
			<script src="lib/lib_notifyme.js"></script>
			<script src="js/jquery-2.2.3.min.js"></script>
			<script type="text/javascript">
			function offlinenotification() {
				var url = "https://hubble.finlaydag33k.nl/api/?authkey=<?php echo $user_authkey;?>";
				 $.getJSON( url, {
					format: "json"
				})
				.done(function( data ) {
					console.log(data);
						if(data.servers.offline == 1){
							notifyMe("There seems to be " + data.servers.offline + " offline server!");
						}else if(data.servers.offline > 1){
							notifyMe("There seem to be " + data.servers.offline + " offline servers!");
						}
				});
				
			}
			offlinenotification();
			setInterval(offlinenotification, 60000);
			</script>
			<?php
        }
    }else{
		?>
        Welcome to Hubble!<br />
		Hubble is a project that I made so I could monitor my own servers.<br />
		It was originally intended for private use, but I decided to make it a public service :)<br />
		Using Hubble is completely free (and I will try to keep it like that), but we rely on donations to keep the servers going.<br />
		If you like the service, and would like to send me a donation, please visit the donation page! (still working on it)<br />
		Hubble will NOT use any ads, as I think they can be quite disturbing, and most of you will have adblock enabled anyways...<br />
		<?php
    }
    ?>