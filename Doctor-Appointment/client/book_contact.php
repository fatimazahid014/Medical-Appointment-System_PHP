<?php
session_start();
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
    <title>Dashboard - Contact</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="toastr.css" rel="stylesheet"/>
        <script src="toastr.js"></script>
</head>
<body>
<div class="container-fluid pt-2 pb-2" style="background-color:rgba(11, 59, 59,0.904);">
    <div class="row">
        <div class="col-sm-10 ">
            <img  width="150" class="ml-0 mt-2 mb-2" src="../images/MedicalCare.png">
        </div>
        <div class="col-sm-2">
            <h3 style = "color:white" class="mr-0">Hey, <?php echo $_SESSION['username']; ?>!</h3>
            <a href="logout.php" class="btn btn-primary ">Log Out</a>
        </div>
    </div>
</div>
<div class="container-fluid text-center" style="background-color:rgba(9, 54, 54,0.48);">
    <div class="">
        <h3 style="color:white" class="pt-3 pb-3">BOOK APPOINTMENT OR CONTACT DOCTOR</h3>
    </div>
</div>

<div> 
<a href='book3.php' class='btn btn-primary'>Book Appointment</a>
<a href='contactdoctor.php' class='btn btn-primary'>Contact Doctor</a>

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

?>


</body>
</html>