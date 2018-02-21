<?php
include"conf.php"; 
$colour="";
$brand="";
$size="";
$price="";

$colour=isset($_REQUEST['color'])?$_REQUEST['color']:"";
$brand=isset($_REQUEST['brand'])?$_REQUEST['brand']:"";
$size=isset($_REQUEST['size'])?$_REQUEST['size']:"";
$price=isset($_REQUEST['price'])?$_REQUEST['price']:"";
// print_r($price);

	$query="select * from products where product_status='1' ";

	if(!empty($colour)){
		$color_data=implode("','",$colour);
		$query .= " and color in ('$color_data')";
		
	}
	// echo "$query";}

	if(!empty($size)){
		$sz_data=implode("','",$size);
		$query .= " and size in ('$sz_data')";
		
	}

	if(!empty($brand)){
		$brand_data=implode("','",$brand);
		$query .= " and name in ('$brand_data')";
		
	}

	if(!empty($price)){
		$k=$price[0];
		// echo $k;
		// return;
		$pr=explode("-", $k);
		
		$min=$pr[0];
		// echo "Min:".$min;
		
		$sz=sizeof($price);
		$k=$price[$sz-1];
		$max=explode("-", $k);
		// echo "Max :".$max[1];
		$m=$max[1];
		// return;
		$query .= " and price between $min and $m ORDER BY price";
		
	}

	$rs=mysql_query($query,$conn) or die("Error :" .mysql_error());

	while($pro_data=mysql_fetch_assoc($rs)) {

					?>

					<div class="col-sm-3 col-lg-3 col-md-3">
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
	
