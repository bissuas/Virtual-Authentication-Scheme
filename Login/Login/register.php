<?php
    include_once("includes/application_start.php");
	$nameErr = $emailErr = $lnameErr = $sstringErr = $spassErr = "";
	$fname = $email = $lname = $sstring = $spass = "";
	$fname1 = $email1 = $lname1 = $sstring1 = $spass1 = "";
    
    if( isset($_SESSION['userLoggedIn']) )
    {
        $url = "index.php";
        redirect($url);
    }   
    
    if(isset($_POST['submit_btn']))
    {   
        $fname          = check($_POST['fname'], $con);
        $lname          = check($_POST['lname'], $con);
        $email          = check($_POST['email'], $con);
        $sstring        = check($_POST['sstring'], $con);
        $spass          = check($_POST['spass'], $con);
        $sfunction      = $_POST['sfunction'];
        $plocation      = $_POST['loc1'].",".$_POST['loc2'].",".$_POST['loc3'];
		
		$valid = true;  
      if(empty($_POST["fname"])) {  
     $nameErr = "Missing Firstname";  
     $valid =false;  
      }  
   else {  
     $fname1 = check($_POST['fname'], $con); 
           // check if name only contains letters and whitespace  
   if (!preg_match("/^[a-zA-Z ]*$/",$fname))  
    {  
    $nameErr = "Only letters and white space allowed";  
    $valid=false;  
       }  
   }  
      if (empty($_POST["lname"])) {  
     $lnameErr = "Missing Lastname";  
      $valid=false;  
      }  
   else {  
     $lname1 = check($_POST['lname'], $con);  
     // check if name only contains letters and whitespace  
   if (!preg_match("/^[a-zA-Z ]*$/",$lname))  
    {  
    $lnameErr = "Only letters and white space allowed";  
    $valid=false;  
       }  
      }  
      if (empty($_POST["email"])) {  
     $emailErr = "Missing email address";  
     $valid=false;  
      }  
   else {  
     $email1 = check($_POST['email'], $con);;  
           // check if e-mail address syntax is valid  
   if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))  
    {  
    $emailErr = "Invalid email format";  
    $valid=false;  
       }  
	}

      if(empty($_POST["sstring"])) {  
     $sstringErr = "Missing String Value";  
     $valid =false;  
      }  
   else {  
     $sstring1 = check($_POST['sstring'], $con); 
           // check if name only contains letters and whitespace  
   if (!preg_match("/^[a-zA-Z ]*$/",$sstring))  
    {  
    $sstringErr = "Only letters and white space allowed";  
    $valid=false;  
    }  
   }

      if(empty($_POST["spass"])) {  
     $spassErr = "Missing String Value";  
     $valid =false;  
      }  
   else {  
     $spass1 = check($_POST['spass'], $con); 
           // check if name only contains letters and whitespace  
   if (!is_numeric($spass) || strlen($spass) != 3)    
    {  
    $spassErr = "Only 3 digit numbers are allowed";  
    $valid=false;  
    }  
   }   

		//check if email already exists
        $query = "SELECT email FROM `user` WHERE `email` = '$email'";
        
        $res = exec_query($query, $con);
        
        if( mysqli_num_rows($res) > 0 )
        {
            $_SESSION['systemMessage'] = "$email already registered!";
            redirect("login.php");
        }
        if($valid==true){
        $query = "INSERT INTO `user` SET `firstname` = '$fname',
                                         `lastname`  = '$lname',
                                         `email` = '$email',
                                         `secretstring` = '$sstring',
                                         `secretfunction` = '$sfunction',
                                         `secretpassword` = '$spass',
                                         `plocation` = '$plocation'";
        $insert = exec_query($query,$con);
        if( $insert )
        {
            $_SESSION['systemMessage'] = "Registration Successful! Please Login To Proceed!";
            redirect("login.php");
        }}
    }
?>


<html>
    <head>
        <title>Register</title>
        <style>*{margin:0px auto; padding:0px; font-family:Arial; font-size:12px;}
				h1{font-size: 30px;text-align:center;color:white;background-color:0193B7}
				html{width: 800px;height: 600px;}
				div{background-color:D3D9DF;}
				#nav{height:400px; width:800px}
				#section{width:800px;height:200;}
				#l{background-color:989898;}
				.error {color: #FF0000;}
		</style>
    </head>
    <body>
	<br /><br /><br />
	<div id = "section">
		<H1>Enhanced Virtual Password Authentication</H1>
	<br /><br /><br /><br /><br /><br />
	<div id = "nav">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <table cellspacing="10"  style="border: #CCC solid 1px;" id="l" WIDTH=526px>
            <tr>
                <td colspan="6"><h2>Register</H2><hr /></td>
            </tr>
            <tr><td><p><span class="error">* All field required.</span></p></td></tr>
            <tr>
                <td WIDTH = 120px>Firstname</td>
                <td WIDTH = 140px><input type="text" name="fname" placeholder="Firstname" /></td>
				<td><span class="error">* <?php echo $nameErr;?></span></td>	
            </tr>
            <tr>
                <td>Lastname</td>
                <td><input type="text" name="lname" placeholder="Lastname" /></td>
				<td><span class="error">* <?php echo $lnameErr;?></span></td>
            </tr>
            
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" placeholder="Email" /></td>
				<td><span class="error">* <?php echo $emailErr;?></span></td>
            </tr>
            <tr>
                <td>Secret String</td>
                <td><input type="text" name="sstring" /></td>
				<td><span class="error">* <?php echo $sstringErr;?></span></td>
            </tr>
            
            <tr>
                <td>Secret Password</td>
                <td><input type="text" name="spass"/></td>
				<td><span class="error">* <?php echo $spassErr;?></span></td>
            </tr>
            
            <tr>
                <td>Secret Function</td>
                <td><select name="sfunction">
                    <option value="+,-,*">+,-,*</option>
                    <option value="-,+,*">-,+,*</option>
                    <option value="*,-,+">*,-,+</option>
                </select></td>
            </tr>
            
            <tr>
                <td>Password Location</td>
                
                <td><select name="loc1">
                    <?php 
                        for($i=1; $i<=9; $i++)
                            echo "<option value='X$i'>X$i</option>";
                    ?>
                    
                </select> 
                <select name="loc2">
                    <?php 
                        for($i=1; $i<=9; $i++)
                            echo "<option value='X$i'>X$i</option>";
                    ?>
                </select>
                <select name="loc3"> 
                    <?php 
                        for($i=1; $i<=9; $i++)
                            echo "<option value='X$i'>X$i</option>";
                    ?>
                </select>
                
                <p>X1 X2 X3</p><p>X4 X5 X6</p><p>X7 X8 X9</p></td>
            </tr>
            
            <tr>
                <td><input type="submit" name="submit_btn" value=" Register " /></td>
                <td><a href="login.php">Already Have an Account!</a></td>
            </tr>
        </table>
        </form>
		</td>
		</td>
    </body>
</html>