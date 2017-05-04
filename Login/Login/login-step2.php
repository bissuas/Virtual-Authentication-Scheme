<?php
    include_once("includes/application_start.php");
    //Submit Button From login.php
    if(isset($_POST['submit_btn']))
    {
        $email = check($_POST['email'],$con);
        
        //check if email exists
        $query = "SELECT * FROM `user` WHERE `email` = '$email'";
        
        $res = exec_query($query, $con);
        
        if( mysqli_num_rows($res) == 0 )
        {
            $_SESSION['systemMessage'] = "$email is not registered!";
            redirect("login.php");
        }else{
           
        
            
            $row = mysqli_fetch_assoc( $res );
            $sstring = $row['secretstring'];
            $sfunction = $row['secretfunction'];
            $spassword = $row['secretpassword'];
            $plocation = $row['plocation'];
            
            $x = explode(",",$plocation); //Getting Location In Array
            
            
            $random_array =  UniqueRandomNumbersWithinRange(1,9,9);
            
            //Getting Last Character(number) From X1, X2, X3,...
            $x1 = substr($x[0],1,1);
            $x2 = substr($x[1],1,1);
            $x3 = substr($x[2],1,1);
            
            $system_value1 = $random_array[$x1-1]; //since random array's key starts with 0
            $system_value2 = $random_array[$x2-1];
            $system_value3 = $random_array[$x3-1];
            
            $system_value = array($system_value1, $system_value2, $system_value3 );
            //var_dump($system_value);
            $user_pass1 = substr($spassword, 0,1);
            $user_pass2 = substr($spassword,1,1);
            $user_pass3 = substr($spassword,2,1);
            
            $user_pass = array($user_pass1,$user_pass2,$user_pass3);
            //var_dump($user_pass);
            $user_function = explode(",",$sfunction);
            
            
            $count = 1;
            
            
            $password_calculated = array();
            //Calculating Password 
            for($i=0; $i<=2; $i++)
            {
                if( $user_function[$i] == "+" )
                {
                    $password_calculated[$i] = $system_value[$i] + $user_pass[$i];
                    
                }
                
                if( $user_function[$i] == "-" )
                {
                    $password_calculated[$i] = $system_value[$i] - $user_pass[$i];
                    //for negative value
                    if( $password_calculated[$i] < 0 )
                    {
                        $password_calculated[$i] *= -1;
                    }
                }
                
                if( $user_function[$i] == "*" )
                {
                    $password_calculated[$i] = $system_value[$i] * $user_pass[$i];
                }
            }
            
            $password_string = implode("",$password_calculated);
            $password = $sstring.$password_string;
            
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            
            //echo $_SESSION['password']; //displaying password
            
        }
        
    }
    else if( isset($_POST['submit_btn_pass']) )
    {
    
    //Submit Button From Current Page
        $password = $_POST['pass'];
        if( $password == $_SESSION['password'] )
        {
            $_SESSION['userLoggedIn'] = TRUE;
            redirect("index.php");
        }else{
            $_SESSION['systemMessage'] = "Password Incorrect!";
            redirect("login.php");
        }
    }else{
        $_SESSION['systemMessage'] = "Page Not Accessible!";
        redirect("login.php");
    }
    
?>

<html>
    <head>
        <title>Log In | Enter your password</title>
        <style>*{margin:0px auto; padding:0px; font-family:Arial; font-size:12px;}
				h1{font-size: 30px;text-align:center;color:white;background-color:0193B7}
				html{width: 800px;height: 600px;}
				div{background-color:D3D9DF;}
				#nav{height:400px; width:800px}
				#section{width:800px;height:200;}
				#l{background-color:989898;}
		</style>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
		</script>
		<script>
			function auto_Refresh_rand()
			{
			$('#tr1').remove();
			}
			setInterval('auto_Refresh_rand()', 7000);
		</script>
    </head>
    <body>
	<br /><br /><br />
	<div id = "section">
		<H1>Enhanced Virtual Password Authentication</H1>
	<br /><br /><br /><br /><br /><br />
	<div id = "nav">
    <form method="post" action="login-step2.php">
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
                <td><?php echo $email; ?></td>
            </tr>
            
            <tr>
                <td>Password</td>
                <td><input type="password" name="pass" placeholder="*******" /></td>
            </tr>
            <tr id="tr1">
				<td>
					System Matrix
				</td>
				<td>
                <?php
                    for( $i = 0; $i < 9; $i++ )
                    {
                        echo $random_array[$i]." ";
                        if( $i == 2 || $i == 5)
                        {
                            echo "<br>";
                        }
                    }
				?>
				</td>
            </tr>
            <tr>
                <td><input type="submit" name="submit_btn_pass" value=" Log In " /></td>
                <td></td>
            </tr>
            
        
        </table>
        </form>
		</div>
		</div>
    </body>

</html>