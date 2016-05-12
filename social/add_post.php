<?php
	include('header.php');
?>

<style>
.box {
    color:#000;
    margin:150px auto;
    padding:20px;
    width:500px;
    height:240px;
    background:#fff;
    border-radius:3px;
    border-bottom:4px solid #5e95cd;
    box-shadow: 0px 0px 30px #888888;
}
.overlimit{color: red;}
</style>

	<section class="add_post">
	
		<div class="container">
		
			<div class="row">
			
				<div class="col-xs-12 col-md-offset-3 col-md-6 col-lg-6 col-white">

					<div class="login-form">
					
						<form method="POST" action="create_post_function.php" id="create_post" enctype="multipart/form-data">
					
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
								<textarea class="form-control" id="preview-text" name="preview-text" placeholder="Content van de previewtekst" rows="5"></textarea>
								<span id="text_counter"></span>
							</div>
							
							<div class="form-group">
								<textarea class="form-control" rows="5" id="content" name="content" placeholder="Content van het bericht" tabindex="2"></textarea>
							</div>
							
							<div class="row">
							
								<div class="form-group">
								
									<div class="col-xs-offset-1 col-xs-11">
										<div class="radio radio-primary">
											<input type="radio" name="radio1" id="radio1" value="news">
											<label for="radio1">
												News
											</label>
										</div>
									</div>
									<div class="col-xs-offset-1 col-xs-11">
										<div class="radio radio-primary">
											<input type="radio" name="radio1" id="radio2" value="events">
											<label for="radio2">
												Events
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
	
	<script>
	$(document).ready(function(){
        var left = 140
        $('#text_counter').text('Characters left: ' + left);
 
            $('#preview-text').keyup(function () {
 
            left = 140 - $(this).val().length;
 
            if(left < 0){
                $('#text_counter').addClass("overlimit");
                 $('#posting').attr("disabled", true);
            }else{
                $('#text_counter').removeClass("overlimit");
                $('#posting').attr("disabled", false);
            }
 
            $('#text_counter').text('Characters left: ' + left);
        });
    });
	</script>
	
<?php
	include('footer.php');
?>