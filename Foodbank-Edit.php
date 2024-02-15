<?php
    //Startup setups
    session_start();
    $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");

    //Initialize variables
    $id = $_GET['id'];

    $sql = "SELECT * FROM foodbankinfo WHERE FoodbankID = $id";
    $result = mysqli_query($conn , $sql);
    $target = mysqli_fetch_assoc($result);
    $url = "Admin-Page.php";
    $error = "Foodbank-Edit.php?id=$id&error=contnum";

    //Get values
    $name = !empty($_POST['editFoodbankName']) ? $_POST['editFoodbankName'] : $target['FoodbankName'];
    $location = !empty($_POST['editFoodbankLocation']) ? $_POST['editFoodbankLocation'] : $target['FoodbankLocation'];
    $description = !empty($_POST['description']) ? $_POST['description'] : $target['Description'];
    $managerName = !empty($_POST['editManagerName']) ? $_POST['editManagerName'] : $target['ManagerName'];
    $contactNum = !empty($_POST['editContactNum']) ? $_POST['editContactNum'] : $target['ContactNumber'];

    //Function for image uploads
    function ImageProcess()
    {
        //Check if file is uploaded
        if(isset($_FILES['fileupload']))
        {
            $fileTmpPath = $_FILES['fileupload']['tmp_name'];
            $fileName = $_FILES['fileupload']['name'];
            $fileNameCmps = explode("." , $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

            $allowedExtension = array('jpg' , 'gif' , 'png' , 'bmp' , 'jpeg');

            if(in_array($fileExtension, $allowedExtension))
            {
                $uploadFileDir = "uploads/";

                $destPath = $uploadFileDir . $newFileName;

                if(move_uploaded_file($fileTmpPath , $destPath))
                {
                    return($destPath);
                }
            }
        }
    }

    //Checks if submitted
    if ($_POST['submitedit'] == "submit")
    {
        //Runs file upload handling and check if empty
        $picName = ImageProcess();
        if(empty($picName))
        {
            $picName = $target['PictureName'];
        }

        //Checks if phone number is valid
        if(!preg_match('/\d{10,11}|(^$)/' , $contactNum))
        {
            header("Location: " . $error);
            die();
        }

        //Updates foodbank table
        $sqlEdit = "UPDATE foodbankinfo SET FoodbankName = '$name' , FoodbankLocation = '$location' , Description = '$description' , ManagerName = '$managerName' , ContactNumber = '$contactNum' , PictureName = '$picName' WHERE FoodbankID = '$id'";
        mysqli_query($conn, $sqlEdit);

        header("Location: " . $url);
    }

    
?>

<html>
    <head>
        <title>FOODBANK HUB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Foodbank-Style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>

    <body>
        <center>
        <div class="content">
            <div class="card">
                <form action="Foodbank-Edit.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td><label for="editId">EDIT ID: </label></td>
                            <td><input name="editId" value="<?php echo $id?>" readonly></td>
                        </tr>
                        <tr>
                            <td><label for="editFoodbankName">Foodbank Name:<br><span style="color: grey;"><?php   echo $target['FoodbankName']   ?></span></label></td>
                            <td><input type="text" name="editFoodbankName"></td>
                        </tr>
                        <tr>
                            <td><label for="editFoodbankLocation">Foodbank Location: <br><span style="color: grey;"><?php   echo $target['FoodbankLocation']   ?></span></label></td>
                            <td><input type="text" name="editFoodbankLocation"></td>
                        </tr>
                        <tr>
                            <td><label for="description">Description</label></td>
                            <td><textarea name="description" style="resize:none"></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="editManagerName">Manager Name: <span style="color: grey;"><?php    echo $target['ManagerName']    ?></label></span><br></td>
                            <td><input type="text" name="editManagerName"></td>
                        </tr>
                        <tr>
                            <td><label for="editContactNum">Contact Number: <span style="color: grey;"><?php   echo $target['ContactNumber']    ?></span></label></td>
                            <td><input type="text" name="editContactNum"></td>
                        </tr>
                        <tr>
                            <td><label for="fileupload">Image of Foodbank:</label></td>
                            <td><input type="file" name="fileupload"></td>
                        </tr>

                    </table>

                    <?php
                    
                        if($_GET['error'])
                        {
                            echo "<span style='color:red'>Contact Number is invalid</span><br>";
                        }
                    
                    ?>

                    <button style="
                    background-color: #ffa31a;
                    font-weight: bold;
                    padding: 6px;
                    margin-top:1em;"
                    type="submit" name="submitedit" value="submit">Submit</button>
                </form>

            </div>
        </div>
        </center>
        
    </body>
</html>