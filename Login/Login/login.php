<?php
    include_once("includes/application_start.php");
    
    if( isset($_SESSION['userLoggedIn']) )
    {
        $url = "index.php";
        redirect($url);
    }   
?>


<html>
    <head>
        <title>Log In</title>
        <style>*{margin:0px auto; padding:0px; font-family:Arial; font-size:12px;}
				h1{font-size: 30px;text-align:center;color:white;background-color:0193B7}
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
	<form method="post" action="login-step2.php">
	<br /><br /><br />
        <table cellspacing="10" style="border: #CCC solid 1px;" id="l">
            <tr>
                <td colspan="2">Login<hr /><?php
        if(isset($_SESSION['systemMessage']))
        {
            echo "<br>".$_SESSION['systemMessage']."</br>";
            unset($_SESSION['systemMessage']);
        }
				?></td>
            </tr>
            
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" placeholder="Email" /></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit_btn" value=" Log In " /></td>
                <td><a href="register.php">New Registration?</a></td>
            </tr>        
        </table>
        </form>
		</div>
		</div>
    </body>

</html>