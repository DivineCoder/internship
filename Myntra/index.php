<?php
include"conf.php"; 
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <!-- Bootstrap Core CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
  	<link href="css/style.css" rel="stylesheet">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		 <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
</head>
<body>

	<div class="container" style="padding-top:2%;" >

        <div class="row">
            <div class="col-sm-3">
                <p class="lead">Product filter</p>
				
			<!-- 	<div class="list-group">
				<h3>Price</h3>
				<input type="hidden" class="price1" value="0" >
                <input type="hidden" class="price2" value="3000"  >
				<p id="priceshow"></p>
                <div id="slider-range"></div>
				
                </div> -->
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
						$query="select * from products where product_status='1'";
						$rs= mysql_query($query) or die("Error :".mysql_error());

				while($pro_data=mysql_fetch_assoc($rs)) {
					?>
					<div class="col-sm-4 col-sm-4 col-sm-4">
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
			</div>
			
		</div>
	</div>
<script src="js/jquery.js"></script>
<style>
#loaderpro{text-align:center; background: url('loader.gif') no-repeat center; height: 150px;}
</style>
<script >
	var colour,brand,size;
	$(function(){
		$('.item_filter').click(function(){
			$('.product-data').html('<div id="loaderpro" style="" ></div>');

			colour=multiple_values('colour');
			brand=multiple_values('brand');
			size=multiple_values('size');

			$.ajax({
				url:"ajax.php",
				type:"post",
				data:{color:colour,brand:brand,size:size},
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