<?php
	include('includes/header.php');
?>

      <!--Daily Challenges Form-->
            <div class="row mt">
              <div class="col-lg-12">
                <div class="form-panel">
                    <div class="input-group image-preview">
                      <h4 class="mb"></i>Monster challenge aanmaken</h4>
					  
					  <form method="POST" action="create_challengem_function.php" id="create_post">
						
						<div class="form-group">
                          <input type="text" class="form-control" id="naamm" name="challengem_name" placeholder="Monster challenge naam">
                      </div>

                      <div class="form-group">
						<textarea class="form-control" rows="5" id="commentd" name="challengem_description" placeholder="Beschrijving"></textarea>
                      </div>
					  
						<div class="form-group1">
                              <label class="sr-only" >tijdslimiet seconden</label>
                              <input type="number" class="form-control" id="tijdslimietds" name="challengem_time" placeholder="Seconden" max="120">
                          </div>
						  
						<div class="form-group">
                          <input type="text" class="form-control" id="naamm" name="challengem_requirement1" placeholder="Requirement (minimaal 10x springen)">
						</div>
						  
						<div class="form-group">
                          <input type="text" class="form-control" id="naamm" name="challengem_requirement2" placeholder="Requirement (minimaal 20x springen)">
						</div>
						
						<div class="form-group">
                          <input type="text" class="form-control" id="naamm" name="challengem_requirement3" placeholder="Requirement (minimaal 30x springen)">
						</div>
							
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
                            <h4>Monster Challenges</h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th>Naam</th>
                                  <th class="hidden-phone">Beschrijving</th>
                                  <th class="hidden-phone">Requirement 1 Ster</th>
                                  <th class="hidden-phone">Requirement 2 Sterren</th>
                                  <th class="hidden-phone">Requirement 3 Sterren</th>
                                  <th class="hidden-phone">Tijdslimiet</th>
                              </tr>
                              </thead>
                              <tbody>
							  
								<?php
									$getMonsterChallenges = mysqli_query($db, "SELECT * FROM monsterChallenges") or die("FOUT: " . mysqli_error($dblink));
											
									while($rij = mysqli_fetch_assoc($getMonsterChallenges)) {
										$monsterChallengeId = $rij["id"];
										$monsterChallengeName = $rij["name"];
										$monsterChallengeDescription = $rij["description"];
										$monsterChallengeRequirement1 = $rij["requirementFirst"];
										$monsterChallengeRequirement2 = $rij["requirementSecond"];
										$monsterChallengeRequirement3 = $rij["requirementThird"];
										$monsterChallengeTimeLimit = $rij["timeLimit"];
								?>
								
									<tr>
										<td><?php echo $monsterChallengeName; ?></td>
										<td><?php echo $monsterChallengeDescription; ?></td>
										<td><?php echo $monsterChallengeRequirement1; ?></td>
										<td><?php echo $monsterChallengeRequirement2; ?></td>
										<td><?php echo $monsterChallengeRequirement3; ?></td>
										<td><?php echo $monsterChallengeTimeLimit; ?></td>
										<td>
											<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
											<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
										</td>
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