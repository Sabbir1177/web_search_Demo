
 
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "webdemo";
 
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Search results</title>
</head>
<body>
<?php
    $query = $_GET['query']; 
    
    $min_length = 3;
    
    if(strlen($query) >= $min_length){
        
        $query = htmlspecialchars($query); 
        $query = $conn -> real_escape_string($query);
        $sql = "SELECT * FROM profile
        WHERE (`country` LIKE '%".$query."%') OR (`country` LIKE '%".$query."%')";
        $raw_results = $conn -> query($sql) or die(mysql_error());
 
        if($raw_results->num_rows > 0){ // if one or more rows are returned do following
            while($row = $raw_results -> fetch_assoc()) {
                printf("Name: %s \tCountry: %s<br />", 
                   $row["Name"],
                   $row["Country"]);              
             }
             mysqli_free_result($raw_results);
            
        }
        else{
            echo "No results";
        }
    }
    else{
        echo "Minimum length is ".$min_length;
    }
         $conn -> close();
?>
</body>
</html>