<?php
    //On startup
    session_start();
    $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");

    //Get value from $_GET
    $id = $_GET['id'];

    //URL lists
    $requestUrl = "Donate-Request.php?id=$id";
    $cashUrl = "Donate-Cash.php?id=$id";

    //Get values from database
    $sql = "SELECT * FROM foodbankinfo WHERE FoodbankID = $id";
    $result = mysqli_query($conn, $sql);
    $target = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>FOODBANK HUB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Foodbank-Page.css">
        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>

    <body>
        <center>
        <div class="content">

            <div class="card"> 
                <a href="Foodbank-List.php"><-Back</a><br><br>
                <img style="max-width: 24.5em; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);" src="<?php  echo $target['PictureName']   ?>">
                <h2><?php   echo $id    ?> - <?php   echo $target['FoodbankName']   ?></h2>
                <p>Located at: <?php    echo $target['FoodbankLocation']    ?></p>
                <p>Description:<br> <?php    echo $target['Description']    ?></p>
                <p>Person in Charge: <?php   echo $target['ManagerName']     ?></p>
                <p>Contact Number: <?php    echo $target['ContactNumber']    ?></p>

                <button 
                style="background-color: #ffa31a;
                font-weight: bold;
                padding: 6px;" 
                onclick="PopUp()" id="donatenow">Donate Now</button>


                <div class="popup" style="display:none" id="popupdiv">
                    <button onclick="RemovePopUp()">Close</button><br>

                    <a href="<?php   echo $requestUrl ?>">Donate via Request<br><img width="100px" src="https://cdn-icons-png.flaticon.com/512/1261/1261163.png"></a><br>
                    <a href="<?php   echo $cashUrl ?>" >Donate via Cash<br><img width="100px" src="https://i.pinimg.com/originals/30/7f/9f/307f9fc872a597ecad28dc676431e6af.png"></a>
                </div>

                <script>
                    function PopUp()
                    {
                        document.getElementById("popupdiv").style.display = "block";
                    }
                    function RemovePopUp()
                    {
                        document.getElementById("popupdiv").style.display = "none";
                    }
                </script>
            </div>
        </div>
        </center>

    </body>
</html>