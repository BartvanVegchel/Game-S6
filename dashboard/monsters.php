<?php
	include('includes/header.php');
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
                            <option value="gold">Gold</option>
                            <option value="silver">Silver</option>
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
                                  <th class="hidden-phone">zeldzaamheid</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
						  
								<?php
									$getMonsters = mysqli_query($db, "SELECT * FROM monsters") or die("FOUT: " . mysqli_error($dblink));
											
									while($rij = mysqli_fetch_assoc($getMonsters)) {
										$monsterId = $rij["id"];
										$monsterName = $rij["monsterName"];
										$monsterRarity = $rij["monsterRarity"];
										$monsterWorld = $rij["monsterWorld"];
										$monsterLocation = $rij["monsterLocation"];
								?>
								
									<tr>
										<td><?php echo $monsterName; ?></td>
										<td><img class="monsterafb" src="assets/img/monsters/monster_<?php echo $monsterName; ?>.png" /></td>
										<td><?php echo $monsterLocation; ?></td>
										<td><span class="label label-<?php echo $monsterRarity; ?> label-mini"><?php echo $monsterRarity; ?></span></td>
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
			  
<?php
	include('includes/footer.php');
?>