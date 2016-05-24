<?php
	include('includes/header.php');
	
	if(isset($_SESSION["logged_in"]) && $_SESSION['username'] == "admin"){
?>

        <div class="row">
              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
                            <h4>Gebruikers</h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th>UserId</th>
                                  <th>Username</th>
                                  <th>E-mail</th>
                                  <th>Age</th>
                                  <th>Gender</th>
                                  <th>Register date</th>
                              </tr>
                              </thead>
                              <tbody>
							  
								<?php
									$getUsers = mysqli_query($db, "SELECT * FROM users") or die("FOUT: " . mysqli_error($dblink));
											
									while($rij = mysqli_fetch_assoc($getUsers)) {
										$userId = $rij["id"];
										$username = $rij["username"];
										$email = $rij["email"];
										$age = $rij["age"];
										$gender = $rij["gender"];
										$registerDate = $rij["registerDate"];
										
										?>
										
										<tr>
											<td><?php echo $userId; ?></td>
											<td><?php echo $username; ?></td>
											<td><?php echo $email; ?></td>
											<td><?php echo $age; ?></td>
											<td><?php echo $gender; ?></td>
											<td><?php echo $registerDate; ?></td>
											<td>
												<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#userUpdate<?php echo $userId; ?>"><i class="fa fa-pencil"></i></button>
												<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#userDelete<?php echo $userId; ?>"><i class="fa fa-trash-o "></i></button>
											</td>
										
											<!-- line modal -->
											<div class="modal fade" id="userUpdate<?php echo $userId; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
											  <div class="modal-dialog">
												<div class="modal-content">
													
													<form method="POST" action="update_user_function.php" id="update_post">
														
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
															<h3 class="modal-title" id="lineModalLabel">Update gebruiker: <?php echo $username; ?></h3>
														</div>
														
														<div class="modal-body">
														
															<input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $userId; ?>">
							
															<div class="form-group">
															  <input type="text" class="form-control" id="username" name="username" placeholder="<?php echo $username; ?>">
															</div>
							
															<div class="form-group">
															  <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo $email; ?>">
															</div>
							
															<div class="form-group">
															  <input type="text" class="form-control" id="age" name="age" placeholder="<?php echo $age; ?>">
															</div>
							
															<div class="form-group">
															  <input type="text" class="form-control" id="gender" name="gender" placeholder="<?php echo $gender; ?>">
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
											<div class="modal fade" id="userDelete<?php echo $userId; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
											  <div class="modal-dialog">
												<div class="modal-content">
													
													<form method="POST" action="delete_user_function.php" id="delete_post">
														
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
															<h3 class="modal-title" id="lineModalLabel">Verwijder gebruiker: <?php echo $username; ?>?</h3>
														</div>
														
														<div class="modal-body">
														
															<input type="hidden" name="user_id" value="<?php echo $userId; ?>">
														
														  Weet je zeker dat je de gebruiker <?php echo $username; ?> wilt verwijderen? Deze actie kun je niet terugdraaien!

														</div>
														
														<div class="modal-footer">
															<div class="btn-group btn-group-justified" role="group" aria-label="group button">
																<div class="btn-group" role="group">
																	<button type="button" class="btn btn-default" data-dismiss="modal" role="button">Annuleren</button>
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