<?php
    //Important startup stuff right here
    session_start();
    $id = $_GET['id'];
    $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");
    $url = "Admin-Page.php";
    $editUrl = "Donate-Request-Edit.php?id=$id";
    
    if($_POST['submit'] == "submitstatus")
    {
        $sql = "UPDATE donationinfo SET Status = '$_POST[statusedit]' WHERE RequestID = '$id'";
        mysqli_query($conn , $sql);
        
        header("Location: " . $url);
    }
?>

<html>
    <head>
        <title>FOODBANK HUB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Donate.css">
        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
   </head>
    

    <body>
        <center>
        <div class="content">
            <div class="card">
                <form action="<?php echo $editUrl ?>" method="POST">
                    <h2>Edit Request Status</h2>

                    <table>
                        <tr>
                            <td colspan="2"><label for="statusedit">Approve or Reject Request</label></td>
                        </tr>

                        <tr>
                            <td><input type="radio" name="statusedit" value="Approved" required></td>
                            <td><label for="Approve">Approve</label></td>
                        </tr>

                        <tr>
                            <td><input type="radio" name="statusedit" value="Pending" required></td>
                            <td><label for="Pending">Pending</label></td>
                        </tr>

                        <tr>
                            <td><input type="radio" name="statusedit" value="Rejected" required></td>
                            <td><label for="Rejected">Reject</label></td>
                        </tr>
                    </table>
                    
                    <button 
                    style="background-color: #ffa31a;
                    font-weight: bold;
                    padding: 6px;
                    margin-top: 1em;" 
                    type="submit" name="submit" value="submitstatus">Submit</button>
        
                </form>
            </div>
        </div>
        </center>

    </body>
</html>