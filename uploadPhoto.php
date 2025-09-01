<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $photo = $_FILES['photo'];
    $random = rand(1, 9999);
    $photoName = $random . "pic." . pathinfo($photo["name"], PATHINFO_EXTENSION);
    $uploadFilePath = "gallery/" . $photoName; // Removed leading "/" to make path relative

    // Check if photo is not empty
    if (!empty($photo['tmp_name'])) {
        // Move uploaded file to target location
        if (!move_uploaded_file($photo["tmp_name"], $uploadFilePath)) {
            echo "Failed to upload file.";
            exit; // Exit script on failure
        } 
    } else {
        echo "No file uploaded.";
        exit; // Exit script if no file is uploaded
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bike";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Escape the file path for SQL query
    $uploadFilePathEscaped = mysqli_real_escape_string($conn, $uploadFilePath);

    // Insert file path into the database
    $sql = "INSERT INTO photos (path) VALUES ('$uploadFilePathEscaped')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "success";
    } else {
        echo "Error saving file path to database: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
