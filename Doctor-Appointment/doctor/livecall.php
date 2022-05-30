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
include("db.php");

$choice = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Contact</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
<div class="container-fluid pt-2 pb-2" style="background-color:rgba(209, 209, 170,0.3);">
    <div class="row">
        <div class="col-sm-10 ">
            <img  width="150" class="ml-0 mt-2 mb-2" src="../images/logo.png">
        </div>
        <div class="col-sm-2">
            <a href="dashboard.php" class="btn btn-primary ">GO Back</a>
        </div>
    </div>
</div>
<div class="container-fluid text-center" style="background-color:rgb(176, 192, 236);">
    <div class="">
        <h3 class="pt-3 pb-3">Contact Client</h3>
	
    </div>
</div>

<div> 
<a href='startmeeting.php' target=_blank class='btn btn-primary'>Start Live Meeting</a>
<form action="" class="w-50 m-auto">
<div class="form-group row" >
    <label class="align-self-center m-2">Meeting Link</label>
    <input type="text" class="form-control w-50 align-self-center m-2" name="link" placeholder="Enter Meeting link here to send to client" >
    <button type="submit" class="btn btn-primary align-self-center m-2" value="Login" name="search">Send Link</button>
  </div>
</form>

<?php
        if(isset($_GET['search']) && !empty($_GET['link']))
        {
            $mysqli = new mysqli('localhost', 'root', '', 'de');
            $query = "SELECT * from contact_doctor WHERE doctorid = $docid ";
            $result = mysqli_query($con, $query) or die(mysql_error());
            $rows = mysqli_num_rows($result);

            if ($rows == 1) {
                $link = $_GET['link'];
                $stmt1 = $mysqli->prepare("UPDATE contact_doctor SET link=?,choice=? WHERE doctorid=? ");
                $stmt1->bind_param('sii', $link,$choice,$docid);
                $stmt1->execute();
                echo '<h4> Link Sent Successfully! </h4>
                <p> Wait for the Client to join the meeting! </p>';
            }
        }
        mysqli_close($con);
    ?>

</div>
   
</body>
</html>

  
 