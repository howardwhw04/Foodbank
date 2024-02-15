<?php

    //Establishing connection
    $username = "root";
    $password = "";
    $dbname = "foodbankdb";
    $hostname = "localhost";

    $conn = mysqli_connect($hostname, $username, $password, $dbname);

    $email = $_POST['Email'];
    $userPassword = $_POST['psw'];
    $passwordRepeat = $_POST['psw-repeat'];

    $return = "Account-SignUp.php?errors=";
    $url = "Account-Login.php";

    $error = array();
    $valid = true;

    //Checks if the password and its repetition is similar
    if($userPassword != $passwordRepeat)
    {
        $error[0] = "Password is not identical";
        $valid = false;
    }

    //Checks if email is in valid format
    if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email))
    {
        $error[1] = "Email is not in the correct format";
        $valid = false;
    }

    //Checks if email is already in use ====================================================================ADDITION=
    $sql = "SELECT * FROM userinfo WHERE Email = '$email'";
    $result = mysqli_query($conn, $sql);
    $target = mysqli_fetch_assoc($result);

    if(!empty($target['Email']))
    {
        $error[2] = "Email is already in use";
        $valid = false;
    }

    //Good to go!
    if($valid == true)
    {
        $sql = "INSERT INTO userinfo (Email, Password) VALUES ('$email' , '$userPassword')";
        mysqli_query($conn, $sql);
        
        header("Location: " . $url);

        mysqli_close($conn);
    }

    else
    {
        //Somethings wrong here
        foreach($error as $value)
        {
            $string = implode("," , $error);
        }

        header("Location: " . $return . $string);
    
    }

?>