<?php
	include('header.php');
?>

	<section class="add_post">
	
		<div class="container">
		
			<div class="row">
			
				<div class="col-xs-12 col-md-offset-3 col-md-6 col-lg-6 col-white">

					<div class="login-form">
					
						<form method="POST" action="functions/create_post_function.php" id="create_post" enctype="multipart/form-data">
					
							<?php
								if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
									$username = $_SESSION["username"];//session gebruikersnaam
									
									$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' ") or die("FOUT: " . mysqli_error($dblink)); //selecteer rij waar gebruikersnaam gelijk is aan de variabele
										
									while($rij = mysqli_fetch_assoc($getUserId)) {
										$userId = $rij["id"];
									}
							?>
						
							<input type="hidden" class="form-control" value="<?php echo $username ?>" id="username" name="username" />
							<input type="hidden" class="form-control" value="<?php echo $userId ?>" id="userId" name="userId" />
							
							<?php
								}
								//echo $dbnaam;
							?>
						
							<div class="form-group">
								<input type="text" class="form-control" value="" placeholder="Titel van het bericht" id="title" name="title" tabindex="1" />
							</div>
							
							<div class="form-group">
								<textarea class="form-control" rows="5" id="content" name="content" placeholder="Content van het bericht" tabindex="2"></textarea>
							</div>
							
							<div class="form-group">
								<div class="form-control" style="padding-bottom: 32px;">
									<input type="file" name="photo" size="25" />
								</div>
							</div>
							
							<input type="submit" value="Upload bericht" class="btn btn-primary btn-lg btn-block">
							
						</form>
						
					</div>
					
				</div>
				
			</div>
		
		</div>
	
	</section>
	
<?php
	include('footer.php');
?>