<?php
	include('includes/header.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){
?>

      <!--Monster Form-->
            <div class="row mt">
              <div class="col-lg-12">
                <div class="form-panel">
                    <div class="input-group image-preview">
                      <h4 class="mb">Nieuw Monster</h4>
					  
					  
				  
				  <form method="POST" action="create_monster_function.php" id="create_post" enctype="multipart/form-data">
						
						<div class="form-group">
                          <input type="text" class="form-control" id="naamm" name="monster_name" placeholder="Monster naam">
                      </div>

                        <select class="form-group form-control" id="rarity" name="monster_rarity">
                            <option value="" disabled selected>Rarity</option>
                            <option value="Gold">Gold</option>
                            <option value="Silver">Silver</option>
                        </select>

                          <div class="form-group1">
                              <label class="sr-only" >reps</label>
                              <input type="text" class="form-control" id="wereldm" name="monster_world" placeholder="Wereld nummer">
                          </div>
                          <div class="form-group1">
                              <label class="sr-only" >tijdslimiet</label>
                              <input type="text" class="form-control" id="locatiem" name="monster_location" placeholder="Locatie nummer">
                          </div>

						  <div class="form-group">
							<textarea class="form-control" rows="5" id="monster_story" name="monster_story" placeholder="Monster story"></textarea>
						  </div>
							
							<div class="form-group">
								<div class="form-control" style="padding-bottom: 32px;">
									<input type="file" name="photo" size="25" />
								</div>
							</div>
							
							<input type="submit" name="submit" id="submit" value="Voeg monster toe" class="btn btn-theme btn-lg btn-block">
							
					</form>

                  </div>
				  
                </div><!-- /form-panel -->
              </div><!-- /col-lg-12 -->
            </div><!-- /row --> 

              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
							
	                  	  	  <h4>Monsters</h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th>Monster</th>
                                  <th>Afbeelding</th>
                                  <th>Locatie</th>
                                  <th>Zeldzaamheid</th>
                                  <th>Monster Story</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
						  
								<?php
									$getMonsters = mysqli_query($db, "SELECT * FROM monsters") or die("FOUT: " . mysqli_error($dblink));
											
									while($rij = mysqli_fetch_assoc($getMonsters)) {
										$monsterId = $rij["monsterId"];
										$monsterName = $rij["monsterName"];
										$monsterRarity = $rij["monsterRarity"];
										$monsterWorld = $rij["monsterWorld"];
										$monsterLocation = $rij["monsterLocation"];
										$monsterStory = $rij["monsterStory"];
								?>
								
									<tr>
										<td><?php echo $monsterName; ?></td>
										<td><img class="monsterafb" src="assets/img/monsters/monster_<?php echo $monsterName; ?>.png" /></td>
										<td><?php echo $monsterLocation; ?></td>
										<td><span class="label label-<?php echo $monsterRarity; ?> label-mini"><?php echo $monsterRarity; ?></span></td>
										<td><?php echo $monsterStory; ?></td>
										<td>
											<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#monsterUpdate<?php echo $monsterId; ?>"><i class="fa fa-pencil"></i></button>
											<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#monsterDelete<?php echo $monsterId; ?>"><i class="fa fa-trash-o "></i></button>
										</td>
										
										<!-- line modal -->
										<div class="modal fade" id="monsterUpdate<?php echo $monsterId; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										  <div class="modal-dialog">
											<div class="modal-content">
												
												<form method="POST" action="update_monster_function.php" id="update_post">
													
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
														<h3 class="modal-title" id="lineModalLabel">Update monster: <?php echo $monsterName; ?></h3>
													</div>
													
													<div class="modal-body">
													
													  <input type="hidden" class="form-control" id="monster_id" name="monster_id" value="<?php echo $monsterId; ?>">
													
													<div class="form-group">
													  <input type="text" class="form-control" id="naamm" name="monster_name" placeholder="<?php echo $monsterName; ?>">
												  </div>

													<select class="form-group form-control" id="rarity" name="monster_rarity">
														<option value="<?php echo $monsterRarity; ?>" selected><?php echo $monsterRarity; ?></option>
														<option value="Silver">Silver</option>
													</select>

													  <div class="form-group1">
														  <label class="sr-only" >reps</label>
														  <input type="text" class="form-control" id="wereldm" name="monster_world" placeholder="<?php echo $monsterWorld; ?>">
													  </div>
													  <div class="form-group1">
														  <label class="sr-only" >tijdslimiet</label>
														  <input type="text" class="form-control" id="locatiem" name="monster_location" placeholder="<?php echo substr($monsterLocation, 2); ?>">
													  </div>

													  <div class="form-group">
														<textarea class="form-control" rows="5" id="monster_story" name="monster_story" placeholder="<?php echo $monsterStory; ?>"></textarea>
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
										<div class="modal fade" id="monsterDelete<?php echo $monsterId; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										  <div class="modal-dialog">
											<div class="modal-content">
												
												<form method="POST" action="delete_monster_function.php" id="delete_post">
													
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
														<h3 class="modal-title" id="lineModalLabel">Verwijder monster: <?php echo $monsterName; ?>?</h3>
													</div>
													
													<div class="modal-body">
													
														<input type="hidden" name="monster_id" value="<?php echo $monsterId; ?>">
													
													  Weet je zeker dat je het monster <?php echo $monsterName; ?> wilt verwijderen? Deze actie kun je niet terugdraaien!

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
			  
			
			  
<?php
	} else {
		header("Refresh: 0; url=login.php");
	}
	
	include('includes/footer.php');
?>