<div class="container">
	<div class="row justify-content-center">
		<div class="col-sm-6">
			<div class="card card-body">
				<h2>Gestionnaire de réinitialisation de mot de passe</h2>
				<hr />	
				<h4 class="animated bounce text-success">
					<i class="fa fa-check-circle"></i> votre mot de passe a été réinitialisé
				</h4>
				<hr />
			</div>
			<br />
			<a href="<?php print_link(""); ?>" class="btn btn-info">Cliquez ici pour vous identifier</a>
			<?php 
				if(DEVELOPMENT_MODE){ 
			?>
				<div class="text-muted">To edit the email template, browse to :- <i>app/view/partials/passwordmanager/password_reset_completed.php</i></div>
			<?php 
				} 
			?>
		</div>
	</div>
</div>
	