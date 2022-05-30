<?php
session_start();
include("db.php");

$di = $_SESSION["docid"];;
$choice = '1';

$u=$_SESSION["username"];
    $sql="SELECT * FROM `clientlogin` WHERE clientname='$u'";
    $res = mysqli_query($con, $sql);
    if($res)
    {   
        if (mysqli_num_rows($res)) {
            while($row = mysqli_fetch_assoc($res)) {
                $uid=$row["clientid"];
            }
        }
    }
    $_SESSION["clientid"]= $uid;

?>

<?php
require('db.php');

?>
<script type="text/javascript">

$(document).ready(function() {

   $("#display").click(function() {                

	 $.ajax({    //create an ajax request to display.php
	   type: "GET",
	   url: "dashboard.php",             
	   dataType: "html",   //expect html to be returned                
	   success: function(response){                    
		   $("#responsecontainer").html(response); 
		   alert(response);
	   }

   });
});
});

</script>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Contact</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid pt-2 pb-2" style="background-color:rgba(11, 59, 59,0.904);">
    <div class="row">
        <div class="col-sm-10 ">
            <img  width="150" class="ml-0 mt-2 mb-2" src="../images/MedicalCare.png">
        </div>
        <div class="col-sm-2">
            <h3  style = "color: white" class="mr-0">Hey, <?php echo $_SESSION['username']; ?>!</h3>
            <a href="logout.php" class="btn btn-primary ">Log Out</a>
        </div>
    </div>
</div>
<div id="responsecontainer" class="container-fluid text-center" style="background-color:rgba(9, 54, 54,0.48);">
    
    <div class="row">
        <div class="col-sm-10 ">
        <div class="">
            <h2 class="pt-3 pb-3">CONTACT</h2>	
        </div>
        </div>
        <div class="col-sm-2">
        <a href="dashboard.php" class="btn btn-primary">Go To DashBoard</a>
        </div>
    </div>
    <span id="txtHint"></span>
    
</div>



<?php
        $mysqli = new mysqli('localhost', 'root', '', 'de');
        $query = "SELECT * from contact_doctor WHERE choice = 1
                  AND doctorid = '$di' AND clientid = '$uid' ";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);

        $query2 = "SELECT * from contact_doctor WHERE choice = 0
                  AND doctorid = '$di' AND link NOT LIKE '' ";
        $result2 = mysqli_query($con, $query2) or die(mysql_error());
        $rows2 = mysqli_num_rows($result2);
        
        if ($rows == 0 && $rows2 == 0 ) {
            // Adding '1' to the choice field to tell the doctor that the
            // Client wants to contact him.
            $stmt1 = $mysqli->prepare("INSERT INTO contact_doctor (doctorid, clientid, choice) VALUES (?,?,?)");
            $stmt1->bind_param('iii', $di, $uid, $choice);
            $stmt1->execute();
        
            echo "<div> 
            <h3> Contacting Doctor... Please Wait!! </h3>
            <p> Try Reloading if the link doesn't show up. </p>
            </div>";

            
        }
        if ($rows2 != 0)
        {
        echo '<h4> You can live chat, video call and voice call the doctor. </h4>';
        while($row = mysqli_fetch_assoc($result2)) {
            $link =$row["link"];   
        }    
        if(!empty($link)){
            
            echo '<h3> Meeting Link:  <a href="'.$link.'" target=_blank>Link</a> </h3>';
            $query3 = "DELETE from contact_doctor WHERE choice = 0 AND link = '$link' ";
            $result3 = mysqli_query($con, $query3) or die(mysql_error());
         }
        else{
            echo "<h3>The Doctor is Busy in a Meeting Right Now, Please try later!</h3>";
            echo "<a href='book_contact.php' class='btn btn-primary'>Go Back</a>";
        }          
        }
        

       
        ?>


</body>
</html>