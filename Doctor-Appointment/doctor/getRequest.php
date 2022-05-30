<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    echo '
		<div id="responsecontainer" class="col-sm-12">
		<div class="container-sm text-center" style="background-color:rgb(226, 226, 226);">
			<div class="">
				<h6 class="pt-3 pb-1">Info</h6>
			</div>
				<div class="pt-0 pb-3">
				Client '.findclientname($row['clientid'],$conn).' wants to Contact You!. 
				
				<div>	
					<a  href="livecall.php" class="btn btn-primary" >Call Client</a>
				</div>
				</div>
			
		</div>
		</div>
        <br>';
  }
} else {
  echo "0 Notifications";
}


function findclientname($id,$conn)
{
	$qry =  "SELECT * FROM `clientlogin` WHERE `clientid`=$id";
	$result = $conn->query($qry);

    $row = $result->fetch_assoc();
    return $row['clientname'];
	
}
$conn->close();
?>

