<?php
    include_once("includes/application_start.php");
    if( !isset($_SESSION['userLoggedIn']) )
    {
        $url = "login.php";
        redirect($url);
    }
?>
<html>
    <head>
        <title>Logged In</title>
        <style>*{margin:0px auto; padding:0px; font-family:Arial; font-size:12px;}
				h1{font-size: 30px;text-align:center;color:white;background-color:0193B7}
				h2{font-size: 20px;text-align:left;color:00000;}
				strong{font-size:15px}
				html{width: 800px;height: 600px;}
				div{background-color:D3D9DF;}
				#nav{height:400px; width:800px}
				#section{width:800px;height:200;}
				#l{background-color:989898;}
		</style>
    </head>
    <body>
	<br /><br /><br />
	<div id = "section">
		<H1>Enhanced Virtual Password Authentication</H1>
	<br /><br /><br /><br /><br /><br />
	<div id = "nav">
		<table cellspacing="10" style="border: #CCC solid 1px;" id="l">
		<tr>
			<td><h2>WELCOME</h2> <br /><strong><?php echo $_SESSION['email']; ?></strong><br /></td>
		</tr>
		<tr><td text-align="center"> <a href="logout.php">Logout</a></td></tr>
		</table>
	</div>
	</div>
    </body>

</html>