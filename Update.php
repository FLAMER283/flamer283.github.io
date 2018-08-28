
<!DOCTYPE HTML>
<html>
	<head>
            <?php require './Product.php';
                    require './FileHandler.php';
                    require './Inventory.php';?>
            
            <?php 
                         session_start();
        
            $id = $_GET['id'];
        $product = new Product('', '','' , '', '', '');
        $inventory = new Inventory('','');

        $product = $product->SelectByID($id);
        $inventory = $product->SelectInventoryByID($id);
                    ?>
            
                
               
          
            <script src="js/Validation.js" type="text/javascript"></script>
            <script src="js/Processing.js" type="text/javascript"></script>
		<title>Smart Store | Contact</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='//fonts.googleapis.com/css?family=Londrina+Solid|Coda+Caption:800|Open+Sans' rel='stylesheet' type='text/css'>
               
	</head>
	<body>
		<div class="wrap">
		<!----start-Header---->
		<div class="header">
			<div class="search-bar">
                            
                             <form> 
                    <input type="text" onkeyup="ShowHint(this.value)">
                    <input type="button" value="Search" />
                    </form>
                    <span id="txtHint"></span>
                 
          
                <script>
                    function ShowHint(hintGiven)
                    {
                        if (hintGiven.length == 0) 
                        {
                   document.getElementById("txtHint").innerHTML = "";
               }
               else
               {
                   xhttpReqeust = new XMLHttpRequest();
                   xhttpReqeust.onreadystatechange = function(){
                       if ((this.readyState == 4)&&(this.status == 200)) 
                       {
                   document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                   };

                   xhttpReqeust.open("GET","GetHint.php?hint="+hintGiven,true);
                   xhttpReqeust.send();
               }
                    }
        
    </script>
			</div>
			<div class="clear"> </div>
			<div class="header-top-nav">
				<ul>
					<li><a href="#">Register</a></li>
					<li><a href="#">Login</a></li>
				</ul>
			</div>
			<div class="clear"> </div>
		</div>
		</div>
		<div class="clear"> </div>
		<div class="top-header">
			<div class="wrap">
		<!----start-logo---->
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" title="logo" /></a>
			</div>
		<!----end-logo---->
		<!----start-top-nav---->
		<div class="top-nav">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="store.php">Store</a></li>
				<li><a href="contact.php">Contact</a></li>
                                <?php 
                                   
                                    
                                    if (isset($_COOKIE['Logged_User'])) 
                                    {
                                   
                                    
                                    echo '<li><a href="AddProducts.php"> Add a Product</a></li>';
                                    echo '<li><a onclick="logOut(\'Logged_User\')" href="index.php">Log Out</a></li>';
                                     echo 'Logged in as : '. $_COOKIE['Logged_User'];
                                   
                                    
                                    
                                    
                                }
                                else
                                {
                                    echo 'Not Logged in';
                                }
                                
                                ?>
			</ul>
		</div>
		<div class="clear"> </div>
		</div>
		</div>
		<!----End-top-nav---->
		<!----End-Header---->
		    <div class="clear"> </div>
		    <div class="wrap">
		    <div class="content">
		    	<div class="section group">				
				<div class="col span_1_of_3">
					
                                    <img src="<?php echo $product->getLocation() ?>" /> 



				</div>				
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h2>Enter Details Below To Update a Product :</h2>
                                        <form action="<?php $_SERVER['PHP_SELF']?>" enctype='multipart/form-data' method="POST">
					    	<div>
                                                            <span><label>Name : </label></span>
                                                            <span><input id="txtName"type="text"  onblur="StringAndIntegerNotEmpty('txtName','txtNameError')"name="txtName"value="<?php echo $product->getName();?>"><label id="txtNameError"></label> </span>
						    </div>
						    <div>
						    	<span><label>Price : </label></span>
                                                        <span><input id="txtPrice"type="text" onblur="IntegerOnlyNotEmpty('txtPrice','txtPriceError')"name="txtPrice" value="<?php echo $product->getPrice();?>"><label id="txtPriceError"></label></span>
						    </div>
                                            
                                            <div >
						    	<span><label>Brand : </label></span>
                                                        <span><select id="cmbBrand"class="dropdown" onsubmit="DropdownDefault('cmbBrand','cmbBrandError','Please Select a Brand')"name="cmbBrand">
                                                            <option>Please Select a Brand</option>
                                                            <?php 
                                                                $arrBrands = ["Accord","Ace","Acer","Airfone","Apple","Blackberry",
                                                                    "Byond Tech","Celkon","Dell Mobile","Fly","HTC","Huawei","LG","Maxx",
                                                                    "Micromax","Samsung","Sony","Wynncom"];
                                                                
                                                                echo '<option selected>'.$product->getBrand().'</option>';
                                                                foreach ($arrBrands as $value) 
                                                                    {
                                                                    echo '<option>'.$value.'</option>';
                                                                }
                                                            ?>
                                                            </select><label id="cmbBrandError"></label></span>
                                                        
						    </div>
                                            
                                            <div>
						    	<span><label>Model : </label></span>
                                                        <span><input id="txtModel"type="text" name="txtModel"value="<?php echo $product->getModel();?>"><label id="txtModelError"></label></span>
						    </div>
                                            
                                            <div>
						    	<span><label>Description of the device(Like specifications) : </label></span>
                                                        <span><textarea name="txtDesc" rows="4" cols="20" ><?php echo $product->getDescription();?>
                                                            </textarea><label id="txtDescError"></label></span>
						    </div>
                                            
                                            <div>
						    	<span><label>Amount in Stock : </label></span>
                                                        <span><input id="txtAmount"type="text" onblur="IntegerOnlyNotEmpty('txtAmount','txtAmountError')"name="txtAmount"value="<?php echo $inventory->getAmount();?>"><label id="txtAmountError"></label></span>
						    </div>
                                            
                                           
                                            
						  
                                            <div>
                                                <span><input type="submit"  name="btnUpdate"value="Update"></span>
                                                      
                                                       
                                                                
                                                                
                                                              
						  </div>
                                            
                                            <?php 
                                                
                                                            if (isset($_POST['btnUpdate'])) 
                                                                {
                                                                
                                                            
                                                $pName = $_POST['txtName'];
                                                $pPrice = $_POST['txtPrice'];
                                                $pPrice = $pPrice;
                                                $pBrand = $_POST['cmbBrand'];
                                                $pModel = $_POST['txtModel'];
                                                $pDesc = $_POST['txtDesc'];
                                                $pLocation = $product->getLocation();
                                                
                                                $iAmount = $_POST['txtAmount'];
                                                $newid = $_GET['id'];
                                               
                                                
                                                $product = new Product($pName, $pPrice, $pBrand, $pModel, $pDesc, $pLocation,$id=$newid);
                                                
                                              
                                              $product->UpdateProduct($id);
                                               $product->UpdateInventory($id,$iAmount);
                                              
                                              
                                              
                                              
                                               echo 'Product class';  
                                               var_dump($product);
                                               
                                               echo 'id';
                                               var_dump($newid);
                                               var_dump($id);
                                               
                                               
                                               
                                               
                                                  
                                              
                                               
                                                  
                                                                }
                                                
                                                
                                            
                                            ?>
					    </form>
				    </div>
  				</div>				
			  </div>
			  	 <div class="clear"> </div>
	</div>
	<div class="clear"> </div>
		    </div>
		    </div>
		<div class="footer">
			<div class="wrap">
			<div class="section group">
				<div class="col_1_of_4 span_1_of_4">
					<h3>Our Info</h3>
					<p>Smart Store is a small company consisting of less than 10 employees working hard night and day to bring you the best deals at an affordable price.</p>
				</div>
				
				<div class="col_1_of_4 span_1_of_4">
					
					<h3>Order-online</h3>
					<p>080-1234-56789</p>
					<p>080-1234-56780</p>
				</div>
				<div class="col_1_of_4 span_1_of_4 footer-lastgrid">
					<h3>News-Letter</h3>
                                        <form <?php $_SERVER['PHP_SELF']; ?> method="POST">
                                            <input name="txtEmail" type="text" value="">
                                            <input type="submit"  name="btnEmail" value="Add Email"/>
                                        </form>
                                                <?php 
                                                                                
                                                                                    
                                                                                
                                                                        if (isset($_POST['btnEmail'])) {
                                                                            
                                                                        
                                                         
                                                         
                                                                $email = $_POST['txtEmail'];
                                                                
                                                                $product = new Product('','' , '', '','' , '');
                                                                
                                                                $x = $product->InsertEmail($email);
                                                                
                                                                 
                                              if ($x == true) 
                                               {
                                                                                
                                                                             
                                                                echo "
                                                     <script language=\"JavaScript\">
                                                       alert('Your email was added to the newsletter!')
                                                       </script>
                                                         ";                   
                                                   
                                                                                
                                                                                
                                                }
                                                 else
                                                {
                                                   echo "
                                                     <script language=\"JavaScript\">
                                                       alert('Something went wrong and your emial could not be added')
                                                       </script>
                                                         ";
                                                }
                                                                        }     
                                                                      
                                                                                
                                                ?>
					<h3>Follow Us:</h3>
					 <ul>
					 	<li><a href="#"><img src="images/twitter.png" title="twitter" />Twitter</a></li>
					 	<li><a href="#"><img src="images/facebook.png" title="Facebook" />Facebook</a></li>
					 	<li><a href="#"><img src="images/rss.png" title="Rss" />Rss</a></li>
					 </ul>
				</div>
			</div>
		</div>
		<div class="clear"> </div>
		<div class="wrap">
		<div class="copy-right">
			<p>&copy; 2018 Smart Store. All Rights Reserved | Design by  <a href="http://w3layouts.com/">W3Layouts</a></p>
		</div>
		</div>
		</div>
	</body>
</html>

