<?php
	include('header.php');
?>

	<section class="add_post">
	
		<div class="container">
		
			<div class="row">
			
				<div class="col-xs-12 col-md-offset-3 col-md-6 col-lg-6 col-white">

					<div class="login-form">
					
						<form method="POST" action="create_social_post_function.php" id="create_post" enctype="multipart/form-data">
					
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
							?>
						
							<div class="form-group">
								<input type="text" class="form-control" value="" placeholder="Vraag in het kort" id="title" name="title" tabindex="1" />
							</div>
							
							<div class="form-group">
								<textarea class="form-control" rows="5" id="content" name="content" placeholder="Beschrijf je vraag" tabindex="2"></textarea>
							</div>
							
							<div class="row">
							
								<div class="form-group">
								
									<div class="col-xs-offset-1 col-xs-11">
										<div class="radio radio-primary">
											<input type="radio" name="radio1" id="radio1" value="general">
											<label for="radio1">
												Algemeen
											</label>
										</div>
									</div>
									<div class="col-xs-offset-1 col-xs-11">
										<div class="radio radio-primary">
											<input type="radio" name="radio1" id="radio2" value="help">
											<label for="radio2">
												Hulp
											</label>
										</div>
									</div>
									<div class="col-xs-offset-1 col-xs-11">
										<div class="radio radio-primary">
											<input type="radio" name="radio1" id="radio3" value="ideas">
											<label for="radio3">
												Ideeën
											</label>
										</div>
									</div>
									<div class="col-xs-offset-1 col-xs-11">
										<div class="radio radio-primary">
											<input type="radio" name="radio1" id="radio4" value="bugs">
											<label for="radio4">
												Fouten in het spel
											</label>
										</div>
									</div>
								
								</div>
							
							</div>
							
							<div class="form-group">
								<div class="form-control" style="padding-bottom: 32px;">
									<input type="file" name="photo" size="25" />
								</div>
							</div>
							
							<input type="submit" name="submit" id="submit" value="Upload bericht" class="btn btn-primary btn-lg btn-block">
							
						</form>
						
					</div>
					
				</div>
				
			</div>
		
		</div>
	
	</section>
	
<?php
	include('footer.php');
?>