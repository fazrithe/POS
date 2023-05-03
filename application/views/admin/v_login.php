<!DOCTYPE html>
<html>
  <head>
    <title><?=$webtitle?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Produk By DanielNovario">
    <meta name="author" content="CV. Dua Sekawan">
    <!-- Bootstrap -->
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet">
    <!-- styles -->
	<link href="<?php echo base_url().'assets/css/stylesl.css'?>" rel="stylesheet">
	
	
   
  </head>
  <body class="login-bg">
  

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <img width="310px" src="<?php echo base_url().'assets/img/starpos.png'?>"/>
			                <p><?php echo $this->session->flashdata('msg');?></p>
	                        <hr/>
	                        <form action="<?php echo base_url().'Administrator/cekuser'?>" method="post">
	                        	<input class="form-control" type="text" name="username" placeholder="Username" required id="username"autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
				                <input class="form-control" type="password" name="password" placeholder="Password" style="margin-bottom:1px;" required>
				                <div class="action">
				                    <button type="submit" class="btn btn-lg " style="width:310px;margin-top:0px; background-color:#ff9000;">Login</button>
								</div>
								<br/><br/>
								<a href="">Forgot Password</a>
							</form>            
			            </div>
			        </div>

			        <!-- <div class="already">
			            <p>Username: admin<br/> Password: admin</p>
			            
			        </div> -->
			    </div>
			</div>
		</div>
	</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    
  </body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$("#username").focus();
	})
</script>