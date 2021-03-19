<div class="container">
	<h3>Gestionnaire de réinitialisation de mot de passe</h3>
	<hr />
	<div class="">
		<h4 class="text-info bold">
			<i class="fa fa-envelope"></i> Un message a été envoyé à votre email. Veuillez suivre le lien pour réinitialiser votre mot de passe
		</h4>
		<?php
		if (DEVELOPMENT_MODE) {
			?>
			<div class="text-muted">
				To edit this file, browse to :- <i>app/view/partials/passwordmanager/password_reset_link_sent.php</i>
			</div>
		<?php
		}
		?>
	</div>
	<hr />
	<a href="<?php print_link(""); ?>" class="btn btn-info">Cliquez ici pour vous identifier</a>
	<?php
	if (DEVELOPMENT_MODE) {
		$mailbody = $this->view_data;
		?>
		<hr />
		<div class="bg-light p-4 border">
			<div class="text-danger">
				<h3>
					<b>Disclaimer:</b> You are seeing this because you published under development mode.
					<br />We understand that sending email in localhost might be problematic.
				</h3>
				<div class="text-muted">To edit the email template, browse to :- <i>app/view/partials/passwordmanager/password_reset_email_template.html</i></div>
			</div>
			<hr />
			<?php echo $mailbody; ?>
		</div>
	<?php
	}
	?>
</div>