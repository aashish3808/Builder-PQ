<div class="wizard">
	<div class="page__header">
		<header class="center">
			<h1><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></h1>
		</header>
	</div>

	<div class="wizard__inner">
		<div class="form__personal">
			<div class="form-section" style="padding-top: 0px;">
				<div class="form-section__header">
					<?php if ($message != '') { ?>
						<br>

						<div class="alert alert-danger" role="alert">
							<?php echo $message; ?>
						</div>

					<?php } ?>
					<?php if ($error_msg != '') { ?>
						<br>

						<div class="alert alert-danger" role="alert">
							<?php echo $error_msg; ?>
						</div>

					<?php } ?>
					<?php if ($success_msg != '') { ?>

						<br>

						<div class="alert alert-success" role="alert">
							<?php echo $success_msg; ?>
						</div>



					<?php


					}
					$this->session->unset_userdata('message');
					$this->session->unset_userdata('success_msg');
					$this->session->unset_userdata('error_msg');

					?>


				</div>
				<hr style="margin-top: 0px; margin-bottom: 20px;" />
				<div class="form-section__content">
					<div class="form__form-group">

						<?php
						$attributes = array('class' => 'js-validation-signin', 'id' => 'myform');
						echo form_open(BACKEND . "authentication/forgot_password", $attributes); ?>
						<div class="py-3">
							<div class="form__form-row col-1">
								<div class="form-element col-2" name="position-email">
									<label class="">Email address*</label>
									<input type="text" tabindex="1" class="data-hj-whitelist" autocomplete="off" name="identity" value="" required />
								</div>
								<div class="form-element col-2" name="position-meta.phoneNumber">
									&nbsp;
								</div>
							</div>

							<div class="form-group">
								<div class="custom-control">

									<a href="<?php echo BACKEND; ?>authentication">Back to login</a>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6 col-xl-5">
								<button type="submit" class="btn__medium button--purple">
									<i class="fa fa-fw fa-sign-in-alt mr-1"></i> <?php echo lang('forgot_password_submit_btn'); ?>
								</button>
							</div>



						</div>
						<?php echo form_close(); ?>
					</div>


				</div>
			</div>

		</div>
	</div>
</div>