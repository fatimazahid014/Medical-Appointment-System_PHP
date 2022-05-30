<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "de";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$docid = intval($_GET['q']);

$sql = "SELECT * from contact_doctor WHERE choice = 1 AND doctorid = $docid ";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $row = $result->fetch_assoc()
    // if ($rows == 0) {
        // Adding '1' to the choice field to tell the doctor that the
        // Client wants to contact him.
        $stmt1 = $mysqli->prepare("INSERT INTO contact_doctor (doctorid, clientid, choice) VALUES (?,?,?)");
        $stmt1->bind_param('iii', $docid, $r['clientid'], $choice);
        $stmt1->execute();
    
        echo "<div> 
        <h3> Contacting Doctor... Please Wait!! </h3>
        <p> Try Reloading if the link doesn't show up. </p>
        </div>";
    }
    else
    {
    echo '<h4> You can live chat, video call and voice call the doctor. </h4>';
    while($row = mysqli_fetch_assoc($result)) {
        $link =$row["link"];   
    }    
    if(!empty($link)){
        
        echo '<h3> Meeting Link:  <a href="'.$link.'" target=_blank>Link</a> </h3>';
    }
    else{
        echo "<h3>The Doctor is Busy Right Now, Please try later!</h3>";
        echo "<a href='book_contact.php' class='btn btn-primary'>Go Back</a>";
    }  
        
    


$conn->close();
?>

