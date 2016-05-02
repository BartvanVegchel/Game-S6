<?php
	include('includes/header.php');
?>

      <!--Werelden Form-->
            <div class="row mt">
              <div class="col-lg-12">
                <div class="form-panel">
                    <div class="input-group image-preview">
                      <h4 class="mb">Nieuwe Wereld</h4>

						<form method="POST" action="create_world_function.php" id="create_post" enctype="multipart/form-data">
						
						<div class="form-group">
                          <input type="text" class="form-control" id="naamm" name="world_name" placeholder="Monster naam">
                      </div>

                          <div class="form-group1">
                              <label class="sr-only" >reps</label>
                              <input type="text" class="form-control" id="wereldm" name="world_size" placeholder="Wereld grootte">
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
                                  <th class="hidden-phone">Formaat</th>
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
								?>
								
									<tr>
										<td><?php echo $worldName; ?></td>
										<td><?php echo $worldSize; ?></td>
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