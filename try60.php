<style>
body
{
margin:0px auto;	
}


</style>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap.min.css">
<!-- jQuery library -->
<script src="jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="bootstrap.min.js"></script>
     
      <div style="background:#06C;height:100px;margin:0px;">
      <br /><br /><center>
    <span style="color:#FFF;font-size:24px;">QUERY BASED SQL GENERATION
    </span></center>
    </div>
     <br /><br />
  <link rel="stylesheet" type="text/css" href="style.css">
    
   
    <div class="container">
     <div class="col-sm-6">
     
     <div class="alert alert-danger col-sm-10">
Your Description
</div>
     
     
     
    <form method="POST" class = "sign" >

    <div class="form-group col-sm-12">
<label for="inputText" class="sr-only">Text</label>
      <input type="text" name="text" class="form-control" placeholder="Text" id="note-textarea"  required>
         </div>

     

  <div class="form-group">

  <button class="btn btn-primary"  type="submit">Generate SQL Query</button>
  

</div>
</form>

<?php
include("index.html");

?>
</div>
<div class="col-sm-6">

<?php
session_start();
error_reporting(0);
$f=0;
 require('connect.php');
if (isset($_POST['text']))
{
 $text= $_POST['text'];
 
 $text=str_replace(","," ",$text);
  $text=str_replace("?"," ",$text);
 
 echo "Entered Query :: $text";
}
$i=0; $dd='';$data='';$flag='';$cc='';

$result  = mysqli_query($conn,"SELECT * FROM words ") or die(mysqli_error($conn)) ;
while($row=mysqli_fetch_array($result))
{
    $words[$i]=$row['word'];
	//echo $row['word']."<br>";
    $i++;
}
 $t=explode(" ",$text);
// input misspelled word
 foreach($t as $r)
 { 
$input = $r;
// array of words to check against
// no shortest distance found, yet
$shortest = -1;

// loop through words to find the closest
foreach ($words as $word) {

    
    $lev = levenshtein($input, $word);

    // check for an exact match
    if ($lev == 0) {

        // closest word is this one (exact match)
        $closest = $word;
        $shortest = 0;

        // break out of the loop; we've found an exact match
        break;
    }

    // if this distance is less than the next found shortest
    // distance, OR if a next shortest word has not yet been found
    if ($lev <= $shortest || $shortest < 0) {
        // set the closest match, and shortest distance
        $closest  = $word;
        $shortest = $lev;
    }
}


 if($shortest>0 && $shortest<2){

    $data=$data."  ". $closest;
    
}
else
{
   $data=$data." ".$r; 
   // $dd=$dd." ".$data; 
}
//echo "<br>-----<br>".$dd;
// echo "****".$closest."**** $r $shortest ****<br>";
}  
//echo $data;echo "<div class='alert alert-warning'>";
echo "<br><div class='alert alert-info'>Entered  :: ".$text."</div>";
echo "<br><div class='alert alert-success'>Final :: ".$data."</div><br>";
 $t=explode(" ",$data);
//echo "hghghghjghjg".$t;

 foreach($t as $r)
 { 
$result  = mysqli_query($conn,"SELECT * FROM train where word='$r' ") or die(mysqli_error($conn)) ;
while($row=mysqli_fetch_array($result))
{
    $dtype=$row['dtype'];
///	echo $r."****** $row[dtype] **".$row['query_word']."<br>";
    if($dtype=="logic")
	$logic=$row['query_word'];
	if($dtype=="query")
	$query=$row['query_word'];
	if($dtype=="table")
	$table=$row['query_word'];
	if($dtype=="field")
	{
		
	$field[$f]=$row['query_word'];
	$f++;
	//echo "kkk $r ";
	}
	if($dtype=="attr")
	$attr=$row['query_word'];
 
}

//$a = 'How are you?';


if($attr=="")
$attr="*";

 }

for($ii=0;$ii<count($field);$ii++)
{
$ff=$field[$ii].",".$ff;	
	$field_count=5;
}
$ff=rtrim($ff,",");
//echo "<br>".$ff;
//echo "<br>count ".count($field);


if (strpos($text, 'with') !== false) {
    //echo 'true';

$field_condition=$start[0];
$c=explode(" ",$field_condition);
$ccount=count($c)-2;
//echo $ccount."jjjjjjjjj";
$field_condition=$c[$ccount];

	$start=explode("with",$text);
	$with=1;
}
if($with==1)
{
$cond2=$start[1];
$cond=explode(" ",$cond2);
$cond=$cond[1];
}


if (strpos($text, 'are') !== false) {
    echo 'true';
	$start=explode("are",$text);
	$are=1;
}
if($are==1)
{
	
$field_condition=$start[0];
$c=explode(" ",$field_condition);
$ccount=count($c)-2;
//echo $ccount."jjjjjjjjj";
$field_condition=$c[$ccount];



$cond2=$start[1];
$cond=explode(" ",$cond2);

$cond=$cond[1];
}







if (strpos($text, 'are') !== false) {
    //echo 'true';
	$start=explode("are",$text);
	$are=1;
}
if($are==1)
{
	
$field_condition=$start[0];
$c=explode(" ",$field_condition);
$ccount=count($c)-2;
//echo $ccount."jjjjjjjjj";
$field_condition=$c[$ccount];



$cond2=$start[1];
$cond=explode(" ",$cond2);

$cond=$cond[1];
}


















if (strpos($text, 'between') !== false) {
  //  echo 'true';
	$start=explode("between",$text);
	$between=1;
}
if($between==1)
{
	
$field_condition=$start[0];
$c=explode(" ",$field_condition);
$ccount=count($c)-2;
//echo $ccount."jjjjjjjjj";
$field_condition=$c[$ccount];



$between_cond=$start[1];
$cond=explode(" ",$cond2);

$cond=$cond[1];
}




if (strpos($text, 'greater than') !== false) {
  //  echo 'true';
	$start=explode("greater than",$text);
	$greater_than =1;
}
if($greater_than==1)
{
	
$field_condition=$start[0];
$c=explode(" ",$field_condition);
$ccount=count($c)-2;
//echo $ccount."jjjjjjjjj";
$field_condition=$c[$ccount];

$cond2=$start[1];
$cond=explode(" ",$cond2);

$great_cond=$cond[1];
}

if (strpos($text, 'less than') !== false) {
   // echo 'true';
	$start=explode("less than",$text);
	$less_than =1;
}
if($less_than==1)
{
	
$field_condition=$start[0];
$c=explode(" ",$field_condition);
$ccount=count($c)-2;
//echo $ccount."jjjjjjjjj";
$field_condition=$c[$ccount];



$cond2=$start[1];
$cond=explode(" ",$cond2);

$less_cond=$cond[1];
}


//echo "Query -- ".$query." $logic  Table --".$table." Attr :: $field *** $cond **** $cond2";
echo "<div class='alert alert-warning'> Query Generated :: ";
if($query=="select" && $field_count!=5)
{
	//echo "ssss";
if($cond!="")
echo "select $field from $table where $field like '% $cond' ";
elseif($logic!="")

{
		if($logic=="count")
echo "select $logic(*) from $table ";
else
echo "  select $logic($field) from $table ";

}
elseif($field!="")
echo "select $field from $table ";
else
echo "select * from $table ";

$qflag=1;
}



if($between==1 )
{
	echo "Step 4 <br>";
echo "select * from $table where $ff between $between_cond";	
	$qflag=1;
}


if($less_than==1 && $greater_than==1 && $qflag!=1)
{
	if($field_condition=="")
	{
		$field_condition=$ff;
	$field_condition=explode(",", $field_condition);
$field_condition=$field_condition[0];
	}
	//echo "Step 4";
echo "select * from $table where $field_condition<$less_cond and $field_condition>$great_cond";	
	$qflag=1;
}
elseif($less_than==1 && $qflag!=1)
{
	//echo "Step 4";
echo "select * from $table where $ff<$less_cond ";	
	$qflag=1;
}

elseif($greater_than==1 && $qflag!=1)
{
	//echo "Step 4";
echo "select * from $table where $ff>$great_cond ";	
$qflag=1;	
}




echo "<br>";






if($query=="" && $table!="" && $field_count!=5 && $qflag!=1)
{
	echo "Step 2<br>";
	if($cond!="" && $logic=="")
echo "select $ff from $table where $ff like '% $cond' ";
elseif($logic!="" && $field!="")
echo "select $logic($field) from $table ";
elseif($logic!="")
echo "select $logic(*) from $table ";
else
	echo "select * from $table ";
$qflag=1;
}

if($field_count==5 && $qflag!=1)
{
	echo "Step 3<br>";
if($cond!="" && $logic=="")
{
	if($field_condition=="")
	{
		$field_condition=$ff;
	$field_condition=explode(",", $field_condition);
$field_condition=$field_condition[0];
	}

echo "select $ff from $table where $field_condition like '% $cond' ";

}
elseif($logic!="")
{

	if($logic=="count")

echo "select $logic($ff) from $table ";

}
else
	echo "select $ff from $table ";
	
}
if($query=="delete")
echo "delete from $table ";

if($query=="insert")
echo "insert into $table($field) values ('$cond2')";

if($query=="update")
echo "UPDATE $table SET $field = '$cond2' WHERE $field = $cond1";



echo "</div>";





?>
</div>










<?php
if($query=="insert")
include("form.php");

if($query=="select")
include("select.php");


if($query=="update")
include("up.php");


if($query=="delete")
include("del.php");


?>


</div>
