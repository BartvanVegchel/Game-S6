<?php
	include('includes/header.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){
?>

      <!--Daily Challenges Form-->
            <div class="row mt">
              <div class="col-lg-12">
                <div class="form-panel">
                    <div class="input-group image-preview">
                      <h4 class="mb"></i>Gifts toevoegen</h4>
					  
					  <form method="POST" action="create_gifts_function.php" id="create_post">

                        <select class="form-control" id="gift_category" name="gift_category">
                            <option value="" disabled>Gift categorie</option>
                            <option value="energypoints">Energypoints</option>
                            <!--<option value="boosters">Boosters</option>-->
                        </select>
					  
						<div class="form-group1">
                              <input type="number" class="form-control" id="gift_energy_value" name="gift_energy_value" placeholder="Aantal energypoints">
                          </div>
						  
						<div class="form-group">
                          <input type="text" class="form-control" id="gift_world" name="gift_world" placeholder="Gift wereld">
						</div>
						  
						<div class="form-group">
                          <input type="text" class="form-control" id="gift_location" name="gift_location" placeholder="Gift locatie">
						</div>
							
						<input type="submit" name="submit" id="submit" value="Voeg gift toe" class="btn btn-theme btn-lg btn-block">
							
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
                            <h4>Gifts</h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Categorie</th>
                                  <th>Aantal</th>
                                  <th>Wereld</th>
                                  <th>Locatie</th>
                              </tr>
                              </thead>
                              <tbody>
							  
								<?php
									$getGifts = mysqli_query($db, "SELECT * FROM gifts") or die("FOUT: " . mysqli_error($dblink));
											
									while($rij = mysqli_fetch_assoc($getGifts)) {
										$giftId = $rij["id"];
										$giftCategory = $rij["giftCategory"];
										$giftValue = $rij["giftValue"];
										$giftWorld = $rij["giftWorld"];
										$giftLocation = $rij["giftLocation"];
								?>
								
									<tr>
										<td><?php echo $giftId; ?></td>
										<td><?php echo $giftCategory; ?></td>
										<td><?php echo $giftValue; ?></td>
										<td><?php echo $giftWorld; ?></td>
										<td><?php echo $giftLocation; ?></td>
										<td>
											<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#giftUpdate<?php echo $giftId; ?>"><i class="fa fa-pencil"></i></button>
											<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#giftDelete<?php echo $giftId; ?>"><i class="fa fa-trash-o "></i></button>
										</td>
										
										<!-- line modal -->
										<div class="modal fade" id="giftUpdate<?php echo $giftId; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										  <div class="modal-dialog">
											<div class="modal-content">
												
												<form method="POST" action="update_gift_function.php" id="update_post">
													
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
														<h3 class="modal-title" id="lineModalLabel">Update gift id: <?php echo $giftId; ?></h3>
													</div>
													
													<div class="modal-body">
													
														<input type="hidden" name="gift_id" value="<?php echo $giftId; ?>">

														<select class="form-group form-control" id="gift_category" name="gift_category">
															<option value="" disabled>Gift categorie</option>
															<option value="energypoints">Energypoints</option>
															<!--<option value="boosters">Boosters</option>-->
														</select>
													  
														<div class="form-group">
															  <input type="number" class="form-control" id="gift_energy_value" name="gift_energy_value" placeholder="<?php echo $giftValue; ?>">
														  </div>
														  
														<div class="form-group">
														  <input type="text" class="form-control" id="gift_world" name="gift_world" placeholder="<?php echo $giftWorld; ?>">
														</div>
														  
														<div class="form-group">
														  <input type="text" class="form-control" id="gift_location" name="gift_location" placeholder="<?php echo substr($giftLocation, 2); ?>">
														</div>

													</div>
													
													<div class="modal-footer">
														<div class="btn-group btn-group-justified" role="group" aria-label="group button">
															<div class="btn-group" role="group">
																<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Annuleren</button>
															</div>
															<div class="btn-group" role="group">
																<input type="submit" name="submit" value="Opslaan" class="btn btn-default btn-hover-green"/>
															</div>
														</div>
													</div>
													
												</form>
													
											</div>
										  </div>
										</div>
										
										<!-- line modal -->
										<div class="modal fade" id="giftDelete<?php echo $giftId; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										  <div class="modal-dialog">
											<div class="modal-content">
												
												<form method="POST" action="delete_gift_function.php" id="delete_post">
													
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
														<h3 class="modal-title" id="lineModalLabel">Verwijder gift id: <?php echo $giftId; ?>?</h3>
													</div>
													
													<div class="modal-body">
													
														<input type="hidden" name="gift_id" value="<?php echo $giftId; ?>">
													
													  Weet je zeker dat je deze gift met id <?php echo $giftId; ?> wilt verwijderen? Deze actie kun je niet terugdraaien!

													</div>
													
													<div class="modal-footer">
														<div class="btn-group btn-group-justified" role="group" aria-label="group button">
															<div class="btn-group" role="group">
																<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Annuleren</button>
															</div>
															<div class="btn-group" role="group">
																<input type="submit" name="submit" value="Verwijder" class="btn btn-default"/>
															</div>
														</div>
													</div>
													
												</form>
													
											</div>
										  </div>
										</div>
									</tr>
								
								<?php }	?>
							  
                              </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->
			</div>
			  
<?php
	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>