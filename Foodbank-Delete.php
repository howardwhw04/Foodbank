<?php

    $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");

    //Initialize variables
    $id = $_GET['id'];
    $url = "Admin-Page.php?id=$id";

    $sql = "SELECT * FROM foodbankinfo WHERE FoodbankID = $id";
    $result = mysqli_query($conn , $sql);
    $target = mysqli_fetch_assoc($result);

    if($_POST['confirm'] == "confirm")
    {
        $sql = "DELETE FROM foodbankinfo WHERE FoodbankID = '$id'";
        $result = mysqli_query($conn, $sql);

        header("Location: " . $url);
    }
    else if($_POST['cancel'] == "cancel")
    {
        header("Location: " . $url);
    }

?>

<html>
    <head>
        <title>FOODBANK HUB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Foodbank-Delete-Style.css">
        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>
    <body>
        <center>
            <div class="content">
                <div class="card">
                    <form action="Foodbank-Delete.php?id= <?php  echo $id   ?>" method="post">
                    <h2>Are you sure to delete <?php    echo $target['FoodbankName']    ?> ?</h2>
                    <br>

                    <button type="submit" value="confirm" name="confirm"
                            style="background-color: #ffa31a;
                            font-weight: bold; 
                            padding: 6px;
                            margin-top:1em;">Confirm</button>
                    <button type="submit" value="cancel" name="cancel"
                            style="background-color: #ffa31a;
                            font-weight: bold; 
                            padding: 6px;
                            margin-top:1em;">Cancel</button>
                    </form>
                </div>
            </div>
        </center>
    </body>
</html>