<?php
//include auth_session.php file on all user panel pages
	include("auth_session.php");
	if(isset($_GET["selectdoctor"]))
	{
		$_SESSION["docid"]=$_GET['docid'];
	
	}
	include('db.php');
	$docid = $_SESSION["docid"];
	$sql="SELECT * FROM `contact_doctor` WHERE doctorid='$docid'";
    $res = mysqli_query($con, $sql);

	if($res)
    {   
        if (mysqli_num_rows($res)) {
            while($row = mysqli_fetch_assoc($res)) {
                $uid=$row["clientid"];
            }
        }
    }
	
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Dashboard - Doctor area</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<link href="css/dashboard.css" rel="stylesheet">
	<script type="text/javascript" src="jquery-1.3.2.js"> </script>

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
    
</head>
<body>

<div class="container-fluid pt-2 pb-2" style="background-color:rgba(11, 59, 59, 0.904);">
    <div class="row">
        <div class="col-sm-10 ">
            <img  width="150" class="ml-0 mt-2 mb-2" src="../images/MedicalCare.png">
        </div>
        <div class="col-sm-2">
            <h3 style="color:white" class="mr-0">Hey, <?php echo finddoctorname($docid); ?>!</h3>
            <a href="logout.php" class="btn btn-primary ">Log Out</a>
        </div>
    </div>
</div>
<div class="container-fluid text-center" style="background-color:rgba(11, 59, 59, 0.904);">
    <div class="">
        <h2 style="color:white" class="pt-3 pb-3">Doctor Dashboard </h2>
    </div>
</div>

<?php
	include('header.php');
	$currdate = date("d-m-Y");
	date_default_timezone_set("Asia/Karachi");
	$currentTime = date( "h:i:s A", time () );
	echo '
	<div class="row">
	<div class="col-sm-9 ">
	<div style="text-align:left;">
	<h4>Date : '.$currdate.' </h4>
	<h4>Time : '.$currentTime.'</h4>        
	</div>

	</div>';

?>



<span id="txtHint"></span>
</div>
	
		
<?php

	function findclientname($id)
	{
		$conn =  mysqli_connect("localhost","root","","de");
		$qry =  "SELECT * FROM `clientlogin` WHERE `clientid`='$id'";
		$ans = mysqli_query($conn,$qry);
		if($ans)
		{
			$nam=mysqli_fetch_assoc($ans);
			return $nam['clientname'];
		}
	}
	function finddoctorname($id)
	{

	$conn =  mysqli_connect("localhost","root","","de");
	$qry =  "SELECT * FROM `doctorlogin` WHERE `doctorid`=$id";
	$ans = mysqli_query($conn,$qry);

	if($ans)
	{
		$nam=mysqli_fetch_assoc($ans);
		return $nam['doctorname'];
	}
	}
?>
<!DOCTYPE html>
<html>
<head>
<script>
function showUser(str) {
  
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getRequest.php?q="+str,true);
  xmlhttp.send();
}

$('document').ready(function () {
 setInterval(function () {showUser(<?php echo $docid ?>)}, 1000);//request every x seconds
}); 


</script>


</body>
</html>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                    crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                    crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
                    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
					crossorigin="anonymous"></script>
					

</body>