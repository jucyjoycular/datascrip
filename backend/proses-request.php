<?php


$servername = "localhost";
$username = "esportsfightarena";
$password = "Efa123456@!";

$mysqli = new mysqli("localhost",$username,$password,"esportsfightarena");

// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

if(isset($_POST["category"])){
$cat = $_POST["category"];


$html='<div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Select Tier</label>
                        <div class="col-sm-10">
                          <select class="category form-select" aria-label="Default select example" name="id_tier">
                            <option selected="">Choose Tier</option>';



$result = $mysqli->query("select * from tier where id_category=".$cat." AND hide=0");
foreach($result as $row) {
   	
   	$html.=" <option value=".$row['id_tier'].">".$row['tier_name']."</option>";
   

}


$html.='    </select>
                        </div>
                      </div>  ';

echo $html;


}
?>