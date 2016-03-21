<div class="container">  
<div class="row">
	<div class="col s8">
<section id="team2" class="mt15">

 <h2 class="header">Staff</h2>
 	<?php foreach ($users as $user):?>
	<div class="row">
		<!--<div class="col s4">
			<img src="#" class="img-responsive imgBorder" alt="<?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?>">
		</div> -->
 		<div class="col s8"> 
			<h5><a href="<?php echo base_url("profile/".$user->id ); ?>"><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></a></h5>
			<!--<p class="bio">#</p>-->
		</div>
	</div>

	<?php endforeach; // $users[] ?>
 	</section>
</div>
</div>
</div>