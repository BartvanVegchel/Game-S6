<?php
	include('includes/header.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){
?>

      <!--Werelden Form-->
            <div class="row mt">
              <div class="col-lg-12">
                <div class="form-panel">
                    <div class="input-group image-preview">
                      <h4 class="mb">Nieuwe Wereld</h4>

						<form method="POST" action="create_world_function.php" id="create_post" enctype="multipart/form-data">
						
						<div class="form-group">
                          <input type="text" class="form-control" id="naamm" name="world_name" placeholder="Wereld naam">
						</div>

                          <div class="form-group1">
                              <label class="sr-only" >reps</label>
                              <input type="text" class="form-control" id="wereldm" name="world_size" placeholder="Wereld grootte">
                          </div>
						
						<div class="form-group">
                          <input type="text" class="form-control" id="world_color" name="world_color" placeholder="#FFFFFF">
						</div>
						
						<div class="form-group">
                          <input type="text" class="form-control" id="unlock_cost" name="unlock_cost" placeholder="Unlock kosten">
						</div>
							
							<div class="form-group">
								<div class="form-control" style="padding-bottom: 32px;">
									<input type="file" name="photo" size="25" />
								</div>
							</div>
							
							<input type="submit" name="submit" id="submit" value="Voeg wereld toe" class="btn btn-theme btn-lg btn-block">
							
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
                            <h4></i>Werelden</h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th>Wereld</th>
                                  <th>Formaat</th>
                                  <th>Kleur</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
							  
								<?php
									$getWorlds = mysqli_query($db, "SELECT * FROM worlds") or die("FOUT: " . mysqli_error($dblink));
											
									while($rij = mysqli_fetch_assoc($getWorlds)) {
										$worldId = $rij["id"];
										$worldName = $rij["worldName"];
										$worldSize = $rij["worldSize"];
										$worldColor = $rij["worldColor"];
								?>
								
									<tr>
										<td><?php echo $worldName; ?></td>
										<td><?php echo $worldSize; ?></td>
										<td style="color: <?php echo $worldColor; ?>;"><?php echo $worldColor; ?></td>
										<td>
											<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#worldUpdate<?php echo $worldId; ?>"><i class="fa fa-pencil"></i></button>
											<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#worldDelete<?php echo $worldId; ?>"><i class="fa fa-trash-o "></i></button>
										</td>
										
										<!-- line modal -->
										<div class="modal fade" id="worldUpdate<?php echo $worldId; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										  <div class="modal-dialog">
											<div class="modal-content">
												
												<form method="POST" action="update_world_function.php" id="update_post">
													
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
														<h3 class="modal-title" id="lineModalLabel">Update wereld: <?php echo $worldName; ?></h3>
													</div>
													
													<div class="modal-body">
													
														<input type="hidden" class="form-control" id="world_id" name="world_id" value="<?php echo $worldId; ?>">
						
														<div class="form-group">
														  <input type="text" class="form-control" id="naamm" name="world_name" placeholder="<?php echo $worldName; ?>">
														</div>

														  <div class="form-group1">
															  <label class="sr-only" >reps</label>
															  <input type="text" class="form-control" id="wereldm" name="world_size" placeholder="<?php echo $worldSize; ?>">
														  </div>
														
														<div class="form-group">
														  <input type="text" class="form-control" id="world_color" name="world_color" placeholder="<?php echo $worldColor; ?>">
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
										<div class="modal fade" id="worldDelete<?php echo $worldId; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										  <div class="modal-dialog">
											<div class="modal-content">
												
												<form method="POST" action="delete_world_function.php" id="delete_post">
													
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
														<h3 class="modal-title" id="lineModalLabel">Verwijder wereld: <?php echo $worldName; ?>?</h3>
													</div>
													
													<div class="modal-body">
													
														<input type="hidden" name="world_id" value="<?php echo $worldId; ?>">
													
													  Weet je zeker dat je de wereld <?php echo $worldName; ?> wilt verwijderen? Deze actie kun je niet terugdraaien!

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