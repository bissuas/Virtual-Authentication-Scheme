<?php
    session_start();
    define("HOST", "localhost");
   	define("USER", "root");
    define("PASS", "" );
    define("DATABASENAME", "practice");
    
    $con = mysqli_connect(HOST, USER, PASS) or die( "Failed Connecting to Server" );
    $sel_db = mysqli_select_db( $con, DATABASENAME ) or die("Failed Connecting to database ".mysqli_error( $con ));
    
    function exec_query( $sql, $con )
    {
        $result = mysqli_query( $con, $sql ) or die( "Wrong Query ".mysqli_error($con) );
			
		if( $result )
		{
			return $result;
		}
    }
    
    function redirect( $url )
    {
        if(headers_sent())
            {
                echo "<script type=\"text/javascript\">
                    window.location.href = '$url';
                </script>";
                
                exit();
            }else{
                session_write_close();
                header("Location:$url");
                exit();
            }
    }
    
     function check( $field, $con )
     {
            $field = strip_tags( $field );
            $field = trim( $field );
            $field = stripslashes( $field );
            $field = mysqli_real_escape_string( $con,  $field );
            return $field;
     }
     
     function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }
    
?>