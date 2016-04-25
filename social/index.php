<?php include('header.php'); ?>

<div class="col-xs-6">

    <h2>General</h2>
	<div class="panel with-nav-tabs panel-default">
		<div class="panel-heading">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1general" data-toggle="tab">Alles</a></li>
				<li><a href="#tab2general" data-toggle="tab">Nieuws</a></li>
				<li><a href="#tab3general" data-toggle="tab">Events</a></li>
				<li><a href="#tab4general" data-toggle="tab">Updates</a></li>
			</ul>
		</div>
		<div class="panel-body">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="tab1general"><?php include('tabincludes/general_all.php'); ?></div>
				<div class="tab-pane fade" id="tab2general"><?php include('tabincludes/general_news.php'); ?></div>
				<div class="tab-pane fade" id="tab3general"><?php include('tabincludes/general_events.php'); ?></div>
				<div class="tab-pane fade" id="tab4general"><?php include('tabincludes/general_updates.php'); ?></div>
			</div>
		</div>
	</div>
				
</div>

<div class="col-xs-6">

    <h2>Social</h2>
	<div class="panel with-nav-tabs panel-default">
		<div class="panel-heading">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1default" data-toggle="tab">Alles</a></li>
				<li><a href="#tab2default" data-toggle="tab">Hulp vragen</a></li>
				<li><a href="#tab3default" data-toggle="tab">Ideeën</a></li>

			</ul>
		</div>
		<div class="panel-body">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="tab1default"><?php include('tabincludes/social_all.php'); ?></div>
				<div class="tab-pane fade" id="tab2default"><?php include('tabincludes/social_help.php'); ?></div>
				<div class="tab-pane fade" id="tab3default"><?php include('tabincludes/social_ideas.php'); ?></div>
				<div class="tab-pane fade" id="tab4default">Default 4</div>
				<div class="tab-pane fade" id="tab5default">Default 5</div>
			</div>
		</div>
	</div>

</div>

<?php include('footer.php'); ?>

