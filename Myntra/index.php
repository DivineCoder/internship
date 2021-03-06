<?php
include"conf.php"; 

?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	 <!-- Bootstrap Core CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
  	<link href="css/style.css" rel="stylesheet">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		 <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<style >
  		.list-group-item{
  			padding: 2px;
  		}
  		h3{
  			margin-top: 3px;
  			font-size: 15px;
  		}
  		div.list-group{
  			margin-bottom: 3px;
  		}
  		input[type=checkbox]{
  			width:20px;
  			height: 15px;

  		}
  		a.list-group-item{
  			border-bottom:1px solid #DC143C;
  		}
  		a.list-group-item:hover{
  			color:#DC143C;
  			border-left: 2px solid #DC143C;
  			
  		}
  	</style>
</head>
<body>

	<div class="container-fluid" >
		<div class="row" style="padding-bottom: 1%;">
			<nav class="navbar navbar-default">
			  <div class="container-fluid" style="border-bottom:2px solid #DC143C;">
			    <div class="navbar-header">
			      <a class="navbar-brand" href="#" style="color: #DC143C">ABC STORE</a>
			    </div>
			    <ul class="nav navbar-nav">
			      <li class="active"><a href="#">Home</a></li>
			      <li><a href="#">MEN</a></li>
			      <li><a href="#">WOMEN</a></li>
			      <li><a href="#">KIDS</a></li>
			      <li><a href="#">HOME & LIVING</a></li>
			    </ul>
			   </div>
			</nav>
			
		</div>

        <div class="row">
            <div class="col-sm-3">
                <p class="lead">Product filter</p>
				
			<div class="list-group">
				<h3>Price</h3>
				<a href="javascript:void(0);" class="list-group-item"> 
					<input type="checkbox" class="item_filter price" value="199-499" >&nbsp;&nbsp; &#8377;199 To &#8377;499 
				</a>
               <a href="javascript:void(0);" class="list-group-item"> 
               		<input type="checkbox" class="item_filter price" value="500-799">&nbsp;&nbsp; &#8377;500 To &#8377;799 
               </a>
               <a href="javascript:void(0);" class="list-group-item"> 
               		<input type="checkbox" class="item_filter price" value="800-1099" >&nbsp;&nbsp; &#8377;800 To &#8377;1099 
               </a>
               <a href="javascript:void(0);" class="list-group-item"> 
               		 <input type="checkbox" class="item_filter price" value="1100-1399">&nbsp;&nbsp; &#8377;1100 To &#8377;1399 
               	</a>
               <a href="javascript:void(0);" class="list-group-item"> 
               		 <input type="checkbox" class="item_filter price" value="1400-1999">&nbsp;&nbsp; &#8377;1400 To &#8377;1999 
               	</a>
            </div> 
                <!-- Color -->
                <div class="list-group">
				<h3>Colour</h3>
				<?php
					$query = "select distinct(color) from products where product_status = '1'";  
					$rs = mysql_query($query,$conn) or die("Error : ".mysql_error());
					while($color_data = mysql_fetch_assoc($rs)){
				 
				?>
                    <a href="javascript:void(0);" class="list-group-item"> 
					<input type="checkbox" class="item_filter colour" value="<?php echo $color_data['color']; ?>">
					&nbsp;&nbsp; <?php echo $color_data['color']; ?></a>
				<?php } ?>	
                </div>

                <!-- Size -->
                <div>
                	<h3>Size</h3>
                	<?php
                	$query="select distinct(size) from products where product_status='1'";
                	$rs=mysql_query($query) or die("Error :".mysql_error());
                	while($size_data= mysql_fetch_assoc($rs)){

                	?>

                	<a href="javascript:void(0);" class="list-group-item">
                		<input type="checkbox" class="item_filter size" value="<?php echo $size_data['size']; ?>">
                	&nbsp; &nbsp; <?php echo $size_data['size']; ?></a>

                	<?php } ?>
                </div>

                <!-- Brand -->
                <div>
                	<h3>Brand</h3>
                	<?php 
                	$query="select distinct(name) from products where product_status='1'";
                	$rs=mysql_query($query);
                	while($b_data= mysql_fetch_assoc($rs)){

                	?>

                	<a href="javascript:void(0);" class="list-group-item">
                		<input type="checkbox" class="item_filter brand" value="<?php echo $b_data['name']; ?>">
                		&nbsp; &nbsp;<?php echo $b_data['name']; ?></a>

                	<?php } ?>
                </div>
                
			</div>

			<div class="col-sm-9">
				<div class="row product-data">
					<?php
						$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
						$limit = 8;
						$startpoint = ($page * $limit) - $limit;
						$query="select * from products  LIMIT {$startpoint}, {$limit}  ";
						$rs= mysql_query($query) or die("Error :".mysql_error());

				while($pro_data=mysql_fetch_assoc($rs)) {
					?>
					<div class="col-sm-3 col-sm-3 col-sm-3">
						<div class="thumbnail"  >
							<img src="images/products/<?php echo $pro_data['image'];?>" alt="" width="100px" height="240px">
							<div class="caption">
								<p style="text-align: center"><strong><a href="#"><?php echo $pro_data['name']?></a></strong></p>
								<h4 style="text-align: center;">RS : <?php echo $pro_data['price']?></h4>
								<p><h5>Color : <?php echo $pro_data['color']?></h5></p>
								<p><h5>Size : <?php echo $pro_data['size']?></h5></p>
							</div>
						</div>
					</div>
					<?php } ?>
		 
				</div>	
							 <?php  
			$sql = "SELECT COUNT(pro_ID) FROM products";  
			$rs_result = mysql_query($sql);  
			$row = mysql_fetch_row($rs_result);  
			$total_records = $row[0];  
			$total_pages = ceil($total_records / $limit);  
			$pagLink = "<div class='pgn'>";  
			for ($i=1; $i<=$total_pages; $i++) {  
			             $pagLink .= "<a href='index.php?page=".$i."'>".$i."</a>";  
			};  
			echo $pagLink ;
			?> 
			</div>
			
		</div>
	</div>
<script src="js/jquery.js"></script>
<style>
#loaderpro{text-align:center; background: url('loader.gif') no-repeat center; height: 150px;}
</style>
<script >
	var colour,brand,size,price;
	$(function(){
		$('.item_filter').click(function(e){

			$('.product-data').html('<div id="loaderpro" style="" ></div>');

			colour=multiple_values('colour');
			brand=multiple_values('brand');
			size=multiple_values('size');
			price=multiple_values('price');
			$.ajax({
				url:"ajax.php",
				type:"post",
				data:{color:colour,brand:brand,size:size,price:price},
				success:function(result){
					$('.product-data').html(result);
				}
		});
	});
});
	function multiple_values(input)
	{
		var val= new Array();
		$("."+input+":checked").each(function(){
			val.push($(this).val());
		});
	return val;
}
	

</script>
</body>
</html>