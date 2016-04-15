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
    $getid = "select ID from users where username='".$_SESSION['user']."' LIMIT 1;";
        if($user_row = $con->query($getid)){
            $user_row = $user_row->fetch_row(); // Convert the row to Array
            $user_id = $user_row[0];
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
							<th>Server Actions</th>
                        </thead>
                <?php
                while ($server = mysqli_fetch_row($servers)){
                    ?>
                        <tr>
                            <td><?php echo $server[6]; ?></td>
							<td><?php echo $server[2]; ?></td>
                            <td><?php echo $server[3]; ?></td>
                            <td><?php if($server[3] == 80){ ?><a href="http://<?php echo $server[2] ?>" target="_new"><?php } ?><?php if($server[4] == true){ ?><button type="button" class="btn btn-success">Online</button><?php }else{ ?><button type="button" class="btn btn-danger">Offline</button><?php }; ?><?php if($server[3] == 80){ ?></a><?php } ?></td>
							<td><?php echo $server[5]; ?></td>
							<th>
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