<?php
    //Start up again
    session_start();
    $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");

    $id = $_GET['id'];
    $backUrl = "Donate-Cash.php?id=$id";
    $submitUrl = "Confirm.php?id=$id";
    $homeUrl = "Homepage.php";
    $date = date('Ymd');

    //Get information in the other form i think?
    $riceAmnt = !empty($_POST['rice']) ? $_POST['rice'] : "0";
    $miloAmnt = !empty($_POST['milo']) ? $_POST['milo'] : "0";
    $oatsAmnt = !empty($_POST['oats']) ? $_POST['oats'] : "0";
    $noodleAmnt = !empty($_POST['noodle']) ? $_POST['noodle'] : "0";
    $biscuitAmnt = !empty($_POST['biscuit']) ? $_POST['biscuit'] : "0";

    //Calculate total price
    $total = $riceAmnt * 13 + $miloAmnt * 16 + $oatsAmnt * 3.4 + $noodleAmnt * 13.6 + $biscuitAmnt * 4.5;
    //If total = 0
    if($total == 0)
    {
        header("Location: " . $backUrl . "&err=nodon");
    }
    
    //Get stuff from foodbankinfo
    $sql = "SELECT * FROM foodbankinfo WHERE FoodbankID = $id";
    $result = mysqli_query($conn , $sql);
    $target = mysqli_fetch_assoc($result);

    if($_POST['submit'] == "checkout")
    {
        $sql = "INSERT INTO cashdonationtable (UserEmail , FoodbankName , CashDonated , Date) VALUES ('$_SESSION[userloggedin]' , '$target[FoodbankName]' , '$_GET[total]' , '$date')";
        mysqli_query($conn , $sql);

        header("Location: " . $homeUrl);
    }

?>

<html>
    <head>
        <title>FOODBANK HUB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Confirm.css">
        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>

    <body>
        <center>
        <div class="content">
            <div class="card">
                <table>

                    <a href="<?php echo $backUrl ?>"><-Back</a>
                    <tr>
                        <td colspan="2"><h2>Please double check:</h2></td>
                    </tr>
                    
                    <tr>
                        <td><p>Donating to:</p></td>
                        <td><p><?php echo $target['FoodbankName'] ?></p></td>
                    </tr>

                    <tr>
                        <td><p>Donating as:  </p></td>
                        <td><p><?php echo $_SESSION['username'] ?></p></td>
                    </tr>
                    
                    <tr>
                        <td valign="top"><p>Quantities: </p></td>
                        <td>
                            <ul>
                                <li>Rice: <?php  echo $riceAmnt   ?></li>
                                <li>Milo: <?php  echo $miloAmnt   ?></li>
                                <li>Nestum Oats: <?php  echo $oatsAmnt   ?></li>
                                <li>Instant Noodles: <?php  echo $noodleAmnt   ?></li>
                                <li>Biscuits: <?php  echo $biscuitAmnt   ?></li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td><p>Total amount: </p></td>
                        <td><p>RM <?php   echo $total ?></p></td>
                    </tr>
                </table>
                    
                <form action="<?php echo $submitUrl . "&total=" . $total ?>" method="post">
                    <button 
                    style="background-color: #ffa31a;
                    font-weight: bold;
                    padding: 6px;
                    margin-top: 1em;"
                    type="submit" name="submit" value="checkout">Complete Check Out</button>
                </form>

            </div>
        </div>
        </center>
            
    </body> 
</html>