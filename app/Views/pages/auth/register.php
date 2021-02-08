<div class="container">
	<div class="row justify-content-center mt-4">
		<div class="col-5">
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-10">
							<form action="<?= base_url('register/register') ?>" method="POST" class="form-signin">
								<div class="text-center">
									<img class="mb-2" src="<?= base_url() ?>/images/logo/logo.png" width="210" height="72">
								</div>
			
								<h1 class="h3 mb-3 font-weight-normal text-center">Register</h1>

								<?php $this->load->view('layouts/_alert') ?>

								<div class="form-group">
									<input type="text" class="form-control" name="name" placeholder="Your complete name">
									<?= form_error('name'); ?>
								</div>
								<div class="form-group">
									<input type="email" class="form-control" name="email" placeholder="Email">
									<?= form_error('email'); ?>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" name="password" placeholder="Password">
									<?= form_error('password'); ?>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" name="password2" placeholder="Confirmation Password">
									<?= form_error('password2'); ?>
								</div>
			
								<button class="btn btn-lg btn-info btn-block" type="submit">Register</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
