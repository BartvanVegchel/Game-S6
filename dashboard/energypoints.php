<?php
	include('includes/header.php');
?>

      <!--Daily Challenges Form-->
            <div class="row mt">
              <div class="col-lg-12">
                <div class="form-panel">
                    <div class="input-group image-preview">
                      <h4 class="mb">Monster challenge aanmaken</h4>
					  
					  <form method="POST" action="add_energypoints_function.php" id="create_post">
						
						<div class="form-group">
                          <input type="text" class="form-control" id="naamm" name="username" placeholder="Gebruikersnaam">
                      </div>
					  
					  <div class="form-group">
                          <input type="text" class="form-control" id="naamm" name="user_id" placeholder="Gebruikers Id">
                      </div>
					  
						<div class="form-group1">
                              <label class="sr-only" >aantal energypoints</label>
                              <input type="number" class="form-control" id="tijdslimietds" name="energypoints" placeholder="Energypoints">
                          </div>
							
						<input type="submit" name="submit" id="submit" value="Voeg energypoints toe" class="btn btn-theme btn-lg btn-block">
							
					</form>
                  </div> 
                </div><!-- /form-panel -->
              </div><!-- /col-lg-12 -->
            </div><!-- /row --> 

        <div class="row">
              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
                            <h4>Energy points</h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th>Naam</th>
                                  <th class="hidden-phone">UserId</th>
                                  <th>Energy points</th>
                                  <th class="hidden-phone">Verdiend</th>
                                  <th class="hidden-phone">Gespendeerd</th>
                              </tr>
                              </thead>
                              <tbody>
							  
								<?php
									$getEnergyPoints = mysqli_query($db, "SELECT * FROM energyPoints") or die("FOUT: " . mysqli_error($dblink));
											
									while($rij = mysqli_fetch_assoc($getEnergyPoints)) {
										$userId = $rij["userId"];
										$amount = $rij["amount"];
										$totalEarned = $rij["totalEarned"];
										$totalSpend = $rij["totalSpend"];
										
										$getUsername = mysqli_query($db, "SELECT * FROM users WHERE id = '$userId'") or die("FOUT: " . mysqli_error($dblink));
										
										while($rij = mysqli_fetch_assoc($getUsername)) {
											$username = $rij["username"];
										?>
											<tr>
												<td><?php echo $username; ?></td>
												<td><?php echo $userId; ?></td>
												<td><?php echo $amount; ?></td>
												<td><?php echo $totalEarned; ?></td>
												<td><?php echo $totalSpend; ?></td>
												<!--<td>
													<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
													<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
												</td>-->
											</tr>
										
										<?php											
										}
								?>
								
								<?php }	?>
                              </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->
			</div>
			  
<?php
	include('includes/footer.php');
?>