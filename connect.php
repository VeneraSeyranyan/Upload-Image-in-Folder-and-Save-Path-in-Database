<?php
$servername = "localhost";
$username = "root";
$password = "Pass123!@#";
$dbname = "Users";
// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];
$image=$_POST['image'];

// File upload path
$targetDir = "./pictures/";
$fileName = time() . "--". basename($_FILES["image"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
if(isset($_POST["submit"]) && !empty($_FILES["image"]["name"])) {
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $sql = "INSERT INTO users(name, email, message,image ) VALUES ('$name','$email', '$message','$targetFilePath')";
            if ($conn->query($sql) === TRUE) {
                echo "<br/>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            if ($sql) {
                echo "Uploaded successfully.";
            }
        }
    }
}else{
    echo"Select a file to upload";
}
?>