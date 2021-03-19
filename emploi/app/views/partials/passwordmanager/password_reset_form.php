<div class="container">
	<h3>Gestionnaire de réinitialisation de mot de passe</h3>
	<hr />
	<div class="row">
		<div class="col-sm-6">
			<?php $page_link = $this->set_current_page_link(); ?>
			<form method="post" action="<?php print_link($page_link); ?>">
				<?php Html::csrf_token(); ?>
				<?php 
					$this :: display_page_errors();			
				?>
				<div class="form-group">
					<label>nouveau mot de passe</label>
					<input placeholder="Your New Password" required value="" class="form-control default" name="password" id="txtpass" type="password" />
				</div>
				<div class="form-group">
					<label>Confirmer le nouveau mot de passe</label>
					<input placeholder="Confirm Password" required class="form-control default" name="cpassword" id="txtcpass" type="password" />
				</div>
				<div class="mt-2 "><button  class="btn btn-success" type="submit">Changer le mot de passe</button></div>
			</form>
		</div>
	</div>
</div>
