

		<link rel="stylesheet" type="text/css" href="datatables.min.css">
  <script src="jquery.min.js"></script>
		<script type="text/javascript" src="datatables.min.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').DataTable();
			} );
		</script>

<style>
.dataTable
{
font-size:10px;	
}

</style>
<div class="col-sm-12">

<div class="clearfix"></div>
<table id="example" class="table table-striped table-bordered dataTable no-footer" cellspacing="0"  role="grid" aria-describedby="example_info" >

       
        
            
          <?php
	
		
	
	//$table="student";
	
	
	

$del_id=$_REQUEST['del_id'];

//if($del_id!="")

	?>
    <script>


function rem()
{
if(confirm('Are you sure you want to delete this record?')){
return true;
}
else
{
return false;
}
}


function rem2()
{
if(confirm('Are you sure you want to deactive this record?')){
return true;
}
else
{
return false;
}
}
</script>
    
	
	<?php
mysqli_query($conn,"delete from $table where id='$del_id'");
	$col=15;
	
	
	

	echo $table;
	
		  $result2 = mysqli_query($conn,"SHOW FIELDS FROM $table");

 echo "<thead><tr>";

while ($row2 = mysqli_fetch_array($result2))
 {

  $name=$row2['Field'];
  
  echo "<th>".
  str_replace('_', ' ', $name)
  ."</th>";
 $i++;
 }
 echo "
<th>Update</th>
 
 
 </tr></thead>";
   
   $i=0;
   echo "<tfoot><tr>";
	  $result3 = mysqli_query($conn,"SHOW FIELDS FROM $table");
while ($row2 = mysqli_fetch_array($result3))
 {

  $name=$row2['Field'];
  
  echo "<th>".
  str_replace('_', ' ', $name)
  ."</th>";
 $i++;
 }
 echo "
<th>Update</th>
 

 </tr></tfoot><tbody>";
   
            
            
         
 	$result = mysqli_query($conn,"SELECT * FROM $table ");
	

		while($row = mysqli_fetch_array($result))
		{
		$id=$row['0'];
		echo "<tr>";
		for($k=0;$k<$i;$k++)
		{
	
			
			
			echo "<td >$row[$k]</td>";
		
		
		
		
		
		
		}
		
		
		
		
		
			echo "
			
			<td><a href='update.php?id=$id&table=$table'>Update</a></td>
			
		
		
			</tr>";
		
		
		
		}
        
        ?>
        </tbody>
    </table>
			
		



<script type="text/javascript">
	// For demo to fit into DataTables site builder...
	$('#example')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');
</script>
	