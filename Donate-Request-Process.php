<?php
    //Start up
    session_start();
    $id = $_GET['id'];
    $error = "Donate-Request.php?id=$id&error=chkboxempty";
    $url = "Homepage.php";
    $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");

    if($_POST['submit'] == "submit")
    {
        //Checks if checkbox is empty
        if(empty($_POST['typeoffood']))
        {
            header("Location: " . $error);
        }

        //Convert array to string
        $type = $_POST['typeoffood'];
        foreach($type as $value)
        {
            $stringType = implode(", " , $type);
        }

        //Get foodbank name
        $sql = "SELECT * FROM foodbankinfo WHERE FoodbankID = $id";
        $result = mysqli_query($conn , $sql);
        $target = mysqli_fetch_assoc($result);
        
        $sql = "INSERT INTO donationinfo (UserEmail , Address , FoodbankName , ItemType , PreferredDate , PreferredTime , Status) VALUES ('$_SESSION[userloggedin]' , '$_POST[address]' , '$target[FoodbankName]' , '$stringType' , '$_POST[date]' , '$_POST[time]' , 'Pending')";
        mysqli_query($conn , $sql);

        header("Location: " . $url);
    }

?>