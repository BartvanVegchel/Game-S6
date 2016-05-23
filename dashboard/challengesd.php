<?php
	include('includes/header.php');
?>

      <!--Daily Challenges Form-->
            <div class="row mt">
              <div class="col-lg-12">
                <div class="form-panel">
                    <div class="input-group image-preview">
                      <h4 class="mb"></i>Daily challenge aanmaken</h4>
					  
					  <form method="POST" action="create_challenged_function.php" id="create_post">
						
						<div class="form-group">
                          <input type="text" class="form-control" id="naamm" name="challenged_name" placeholder="Daily challenge naam">
                      </div>

                      <div class="form-group">
						<textarea class="form-control" rows="5" id="commentd" name="challenged_description" placeholder="Beschrijving"></textarea>
                      </div>
					  
						<div class="form-group1">
                              <label class="sr-only" >tijdslimiet seconden</label>
                              <input type="number" class="form-control" id="tijdslimietds" name="challenged_time" placeholder="Seconden" max="120">
                          </div>
						  
						<div class="form-group">
                          <input type="text" class="form-control" id="naamm" name="challenged_requirement" placeholder="Requirement (minimaal 10x springen)">
						</div>
						  
						  <select class="form-control" id="gifttype">
                            <option value="0" disabled selected>Beloning</option>
                            <option value="1">Monster</option>
                            <option value="2">Energypoints</option>
                        </select>

                        <!-- EERST DATABASE STRUCTUUR VERANDEREN
						<select class="form-control" id="monstergift" name="challenged_gift_m">
                            <option value="" disabled selected>Monster</option>
                            <option>Droplet</option>
                            <option>Fury</option>
                            <option>Leefy</option>
                            <option>Bolt</option>
                            <option>Boomer</option>
                            <option>Pinky</option>
                        </select>
						-->

                        <select class="form-control" id="energygift" name="challenged_gift_e">
                            <option value="" disabled selected>Energypoints</option>
                            <option>50</option>
                            <option>100</option>
                            <option>250</option>
                            <option>500</option>
                            <option>1000</option>
                        </select>
							
						<input type="submit" name="submit" id="submit" value="Voeg daily challenge toe" class="btn btn-theme btn-lg btn-block">
							
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
                            <h4>Daily Challenges</h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th>Naam</th>
                                  <th class="hidden-phone">Beschrijving</th>
                                  <th class="hidden-phone">Repetities</th>
                                  <th class="hidden-phone">Tijdslimiet</th>
                                  <th>Beloning</th>
                              </tr>
                              </thead>
                              <tbody>
							  
								<?php
									$getDailyChallenges = mysqli_query($db, "SELECT * FROM dailyChallenges") or die("FOUT: " . mysqli_error($dblink));
											
									while($rij = mysqli_fetch_assoc($getDailyChallenges)) {
										$dailyChallengeId = $rij["id"];
										$dailyChallengeName = $rij["name"];
										$dailyChallengeDescription = $rij["description"];
										$dailyChallengeRequirement = $rij["requirement"];
										$dailyChallengeTimeLimit = $rij["timeLimit"];
										$dailyChallengeReward = $rij["reward"];
								?>
								
									<tr>
										<td><?php echo $dailyChallengeName; ?></td>
										<td><?php echo $dailyChallengeDescription; ?></td>
										<td><?php echo $dailyChallengeRequirement; ?></td>
										<td><?php echo $dailyChallengeTimeLimit; ?></td>
										<td><?php echo $dailyChallengeReward; ?></td>
										<td>
											<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#challengedUpdate<?php echo $dailyChallengeId; ?>"><i class="fa fa-pencil"></i></button>
											<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#challengedDelete<?php echo $dailyChallengeId; ?>"><i class="fa fa-trash-o "></i></button>
										</td>
										
										<!-- line modal -->
										<div class="modal fade" id="challengedUpdate<?php echo $dailyChallengeId; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										  <div class="modal-dialog">
											<div class="modal-content">
												
												<form method="POST" action="update_challenged_function.php" id="update_post">
													
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
														<h3 class="modal-title" id="lineModalLabel">Update daily challenge: <?php echo $dailyChallengeName; ?></h3>
													</div>
													
													<div class="modal-body">
													
														<input type="hidden" name="challenged_id" value="<?php echo $dailyChallengeId; ?>">
													
														<div class="form-group">
														  <input type="text" class="form-control" id="naamm" name="challenged_name" placeholder="<?php echo $dailyChallengeName; ?>">
													  </div>

													  <div class="form-group">
														<textarea class="form-control" rows="5" id="commentd" name="challenged_description" placeholder="<?php echo $dailyChallengeDescription; ?>"></textarea>
													  </div>
													  
														<div class="form-group1">
															  <label class="sr-only" >tijdslimiet seconden</label>
															  <input type="number" class="form-control" id="tijdslimietds" name="challenged_time" placeholder="<?php echo $dailyChallengeTimeLimit; ?>" max="120">
														  </div>
														  
														<div class="form-group">
														  <input type="text" class="form-control" id="naamm" name="challenged_requirement" placeholder="<?php echo $dailyChallengeRequirement; ?>">
														</div>
														  
														<div class="form-group">
														  <input type="text" class="form-control" id="naamm" name="challenged_reward" placeholder="<?php echo $dailyChallengeReward; ?>">
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
										<div class="modal fade" id="challengedDelete<?php echo $dailyChallengeId; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										  <div class="modal-dialog">
											<div class="modal-content">
												
												<form method="POST" action="delete_challenged_function.php" id="delete_post">
													
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
														<h3 class="modal-title" id="lineModalLabel">Verwijder daily challenge: <?php echo $dailyChallengeName; ?>?</h3>
													</div>
													
													<div class="modal-body">
													
														<input type="hidden" name="challenged_id" value="<?php echo $dailyChallengeId; ?>">
													
													  Weet je zeker dat je deze daily challenge <?php echo $dailyChallengeName; ?> wilt verwijderen? Deze actie kun je niet terugdraaien!

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
	include('includes/footer.php');
?>