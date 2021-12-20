<div class="main center">
	<div class="wizard">
		<div class="page__header">
			<header class="center">
				<h1>Personal details</h1>
			</header>
		</div>
		<div class="progress-bar">
			<div class="progress-bar__inner">
				<div class="progress-bar__bar">
					<div class="progress-bar__filler" style="width: 18%;"></div>
				</div>
				<div class="progress-bar__buttons">
					<button class="progress-bar__button progress-bar__button--personal progress-bar__button--active" disabled="">
						<div class="progress-bar__icon">
							<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg--person" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
								<path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
							</svg>
						</div>
						<div class="progress-bar__label">Personal</div>
					</button>
					<button class="progress-bar__button progress-bar__button--history">
						<div class="progress-bar__icon">
							<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg--Description" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
								<path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"></path>
							</svg>
						</div>
						<div class="progress-bar__label">Experiences</div>
					</button>
					<button class="progress-bar__button progress-bar__button--template">
						<div class="progress-bar__icon">
							<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg--create" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
								<path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"></path>
							</svg>
						</div>
						<div class="progress-bar__label">Template</div>
					</button>
				</div>
			</div>
		</div>
		<div class="wizard__inner">
			<div class="form__personal">
				<div class="form-section" style="padding-top: 0px;">

					<div class="form-section__header">
						<?php if (@$message != '') { ?>
							<br>

							<div class="alert alert-danger" role="alert">
								<?php echo $message; ?>
							</div>

						<?php } ?>
						<?php if (@$error_msg != '') { ?>
							<br>

							<div class="alert alert-danger" role="alert">
								<?php echo $error_msg; ?>
							</div>

						<?php } ?>
						<?php if (@$success_msg != '') { ?>

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
					<div class="form-section__header">
						<h2 class="form-section__title">
							<i class="form-section__title-icon">
								<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-person" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
									<path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
								</svg>
							</i>
							Personal details
						</h2>

						<div class="resume-language-selector">

						</div>

					</div>
					<hr style="margin-top: 0px; margin-bottom: 20px;" />

					<?php
					$form_attributes['class'] = "form-horizontal row-border";
					$form_attributes['id']    = "validate-1";
					echo form_open_multipart(BACKEND . "home/update_step_1/", $form_attributes);
					?>
					<?php echo form_hidden('id', $personal_detail->id); ?>
					<?php echo form_hidden('hidden_image', $personal_detail->profileImage); ?>
					<?php echo form_hidden('hidden_image1', $personal_detail->globalMap); ?>



					<?php echo form_hidden($csrf); ?>
					<div class="form-section__content">
						<div class="form__form-group">
							<div class="form__form-row col-1">
								<div class="form__form-row--avatar">
									<div class="form__form-row--avatar--label">
										<?php
										$image_source = get_image_source("admin/thumbs/thumb_" . stripslashes(@$personal_detail->profileImage));

										if (@$personal_detail->profileImage) {
											$delete_image_url = BACKEND . 'myaccount/delete_image/' . $personal_detail->id;
										}

										?>
										<img src="<?php echo $image_source; ?>" width="128">
									</div>




								</div>

								<div class="form__form-row--avatar-right">
									<div class="form-element col-1" name="position-firstName">
										<label class="">First name*</label>
										<input type="text" class="data-hj-whitelist" id="first_name" name="first_name" value="<?php echo $personal_detail->first_name; ?>" />
									</div>
									<div class="form-element col-1" name="position-lastName">
										<label class="">Last name*</label>
										<input type="text" class="data-hj-whitelist" id="last_name" name="last_name" value="<?php echo $personal_detail->last_name; ?>" />
									</div>
								</div>
							</div>

							<div class="form__form-row col-1">
								<div class="form-element col-2" name="position-email">

									<label class="">New Profile Picture</label>
									<input type="file" tabindex="4" name="profile_image" class="data-hj-whitelist" accept="image/*" data-style="fileinput" data-inputsize="medium">

									<img src="<?php echo $image_source; ?>" width="128"> <br>

									<?php if (isset($delete_image_url)) { ?>
										<a class="bs-tooltip del_listing" title="" href="<?php echo $delete_image_url; ?>" data-original-title="Delete">
											<i class="fa fa-trash-o fa-2x" aria-hidden="true"> Delete Current Image</i>
										</a>
									<?php }
									?>
								</div>
								<div class="form-element col-2" name="position-meta.phoneNumber">

									<label class="">Global Map Image</label>
									<input type="file" tabindex="4" name="globalMap" class="data-hj-whitelist" accept="image/*" data-style="fileinput" data-inputsize="medium">

									<?php
									$image_source2 = get_image_source("admin/thumbs/thumb_" . stripslashes(@$personal_detail->globalMap));

									if (@$personal_detail->globalMap) {
										$delete_image_url1 = BACKEND . 'myaccount/delete_image1/' . $personal_detail->id;
									}

									?>

									<img src="<?php echo $image_source2; ?>" width="128"> <br>

									<?php if (isset($delete_image_url1)) { ?>
										<a class="bs-tooltip del_listing" title="" href="<?php echo $delete_image_url1; ?>" data-original-title="Delete">
											<i class="fa fa-trash-o fa-2x" aria-hidden="true"> Delete Current Image</i>
										</a>
									<?php }
									?>



								</div>
							</div>

							<div class="form__form-row col-1">
								<div class="form-element col-2" name="position-email">
									<label class="">Email address*</label>
									<input type="text"  class="data-hj-whitelist" name="contact_email" value="<?php echo $personal_detail->contact_email; ?>" />
								</div>
								<div class="form-element col-2" name="position-meta.phoneNumber">
									<label class="">Phone number</label>
									<input type="text" tabindex="" class="data-hj-whitelist" autocomplete="off" name="phone" value="<?php echo $personal_detail->phone; ?>" />
								</div>
							</div>
							<div class="form__form-row col-1">
								<div class="form__form-row col-1">
									<div class="form-element col-1">
										<label class="">Current Designation and company</label><input type="text" tabindex="" class="data-hj-whitelist" name="company" value="<?php echo $personal_detail->company; ?>" />
									</div>
								</div>
							</div>
							<div class="form__form-row col-1">
								<div class="form__form-row col-1">
									<div class="form-element col-1" name="position-meta.streetName">
										<label class="">Address</label><input type="text" tabindex="" class="data-hj-whitelist" name="address" value="<?php echo $personal_detail->address; ?>" />
									</div>
								</div>
								<div class="form__form-row col-1">
									<div>
										<div class="form-element col-2" name="position-meta.postalCode">
											<label class="">Zip code</label>
											<input type="text" tabindex="" class="data-hj-whitelist" autocomplete="off" name="zipcode" value="<?php echo $personal_detail->zipcode; ?>" />
										</div>
										<div class="form-element col-2" name="position-meta.city">
											<label class="">City/Town</label>
											<input type="text" tabindex="" class="data-hj-whitelist" name="city" value="<?php echo $personal_detail->city; ?>" />
										</div>
									</div>
								</div>
							</div>
							<div class="additional_info" style="display:none;">
								<div class="form__extra-options--slide" style="opacity: 1; display: block;">
									<div class="form__form-row col-1">
										<div>
											<div class="form-element col-2">
												<label class="">Date of Birth</label>
											</div>
											<div class="form-element col-2">
												<label class="">Place of Birth</label>
											</div>
										</div>
									</div>
									<div class="form__form-row col-1">
										<div class="form__form-row form-element--desktop col-1" style="margin-bottom: 0px;">
											<div class="col-1">
												<div class="col-2 form-element">
													<div class="form-element date--day">
														<select class="form-select-custom" name="dob_day">
															<option value="">Day</option>
															<option value="01" <?php if ($personal_detail->dob_day == '01') { ?> selected <?php } ?>>1</option>
															<option value="02" <?php if ($personal_detail->dob_day == '02') { ?> selected <?php } ?>>2</option>
															<option value="03" <?php if ($personal_detail->dob_day == '03') { ?> selected <?php } ?>>3</option>
															<option value="04" <?php if ($personal_detail->dob_day == '04') { ?> selected <?php } ?>>4</option>
															<option value="05" <?php if ($personal_detail->dob_day == '05') { ?> selected <?php } ?>>5</option>
															<option value="06" <?php if ($personal_detail->dob_day == '06') { ?> selected <?php } ?>>6</option>
															<option value="07" <?php if ($personal_detail->dob_day == '07') { ?> selected <?php } ?>>7</option>
															<option value="08" <?php if ($personal_detail->dob_day == '08') { ?> selected <?php } ?>>8</option>
															<option value="09" <?php if ($personal_detail->dob_day == '09') { ?> selected <?php } ?>>9</option>
															<option value="10" <?php if ($personal_detail->dob_day == '10') { ?> selected <?php } ?>>10</option>
															<option value="11" <?php if ($personal_detail->dob_day == '11') { ?> selected <?php } ?>>11</option>
															<option value="12" <?php if ($personal_detail->dob_day == '12') { ?> selected <?php } ?>>12</option>
															<option value="13" <?php if ($personal_detail->dob_day == '13') { ?> selected <?php } ?>>13</option>
															<option value="14" <?php if ($personal_detail->dob_day == '14') { ?> selected <?php } ?>>14</option>
															<option value="15" <?php if ($personal_detail->dob_day == '15') { ?> selected <?php } ?>>15</option>
															<option value="16" <?php if ($personal_detail->dob_day == '16') { ?> selected <?php } ?>>16</option>
															<option value="17" <?php if ($personal_detail->dob_day == '17') { ?> selected <?php } ?>>17</option>
															<option value="18" <?php if ($personal_detail->dob_day == '18') { ?> selected <?php } ?>>18</option>
															<option value="19" <?php if ($personal_detail->dob_day == '19') { ?> selected <?php } ?>>19</option>
															<option value="20" <?php if ($personal_detail->dob_day == '20') { ?> selected <?php } ?>>20</option>
															<option value="21" <?php if ($personal_detail->dob_day == '21') { ?> selected <?php } ?>>21</option>
															<option value="22" <?php if ($personal_detail->dob_day == '22') { ?> selected <?php } ?>>22</option>
															<option value="23" <?php if ($personal_detail->dob_day == '23') { ?> selected <?php } ?>>23</option>
															<option value="24" <?php if ($personal_detail->dob_day == '24') { ?> selected <?php } ?>>24</option>
															<option value="25" <?php if ($personal_detail->dob_day == '25') { ?> selected <?php } ?>>25</option>
															<option value="26" <?php if ($personal_detail->dob_day == '26') { ?> selected <?php } ?>>26</option>
															<option value="27" <?php if ($personal_detail->dob_day == '27') { ?> selected <?php } ?>>27</option>
															<option value="28" <?php if ($personal_detail->dob_day == '28') { ?> selected <?php } ?>>28</option>
															<option value="29" <?php if ($personal_detail->dob_day == '29') { ?> selected <?php } ?>>29</option>
															<option value="30" <?php if ($personal_detail->dob_day == '30') { ?> selected <?php } ?>>30</option>
															<option value="31" <?php if ($personal_detail->dob_day == '31') { ?> selected <?php } ?>>31</option>
														</select>
														<i class="form-select-custom--arrow"></i>
													</div>
													<div class="form-element date--month">

														<select class="form-select-custom" name="dob_month">
															<option value="">Month</option>
															<option value="01" <?php if ($personal_detail->dob_month == '01') { ?> selected <?php } ?>>January</option>
															<option value="02" <?php if ($personal_detail->dob_month == '02') { ?> selected <?php } ?>>February</option>
															<option value="03" <?php if ($personal_detail->dob_month == '03') { ?> selected <?php } ?>>March</option>
															<option value="04" <?php if ($personal_detail->dob_month == '04') { ?> selected <?php } ?>>April</option>
															<option value="05" <?php if ($personal_detail->dob_month == '05') { ?> selected <?php } ?>>May</option>
															<option value="06" <?php if ($personal_detail->dob_month == '06') { ?> selected <?php } ?>>June</option>
															<option value="07" <?php if ($personal_detail->dob_month == '07') { ?> selected <?php } ?>>July</option>
															<option value="08" <?php if ($personal_detail->dob_month == '08') { ?> selected <?php } ?>>August</option>
															<option value="09" <?php if ($personal_detail->dob_month == '09') { ?> selected <?php } ?>>September</option>
															<option value="10" <?php if ($personal_detail->dob_month == '10') { ?> selected <?php } ?>>October</option>
															<option value="11" <?php if ($personal_detail->dob_month == '11') { ?> selected <?php } ?>>November</option>
															<option value="12" <?php if ($personal_detail->dob_month == '12') { ?> selected <?php } ?>December</option>
														</select>
														<i class="form-select-custom--arrow"></i>
													</div>
													<div class="form-element date--year">

														<select class="form-select-custom" name="dob_year">
															<option value="">Year</option>

															<?php

															$year = date('Y') - 10;

															$year_start = $year - 90;

															for ($i = $year; $i >= $year_start; $i--) { ?>

																<option value="<?php echo $i; ?>" <?php if ($personal_detail->dob_year == $i) { ?> selected <?php } ?>><?php echo $i; ?></option>

															<?php

															}

															?>
														</select>
														<i class="form-select-custom--arrow"></i>
													</div>
												</div>
												<div class="form-element col-2"><input type="text" class="data-hj-whitelist" name="place_of_birth" value="<?php echo $personal_detail->place_of_birth; ?>"></div>
											</div>
										</div>

									</div>
									<div class="form__form-row col-1">
										<div>
											<div class="form-element col-2" name="position-meta.drivingLicenses">
												<label class="">
													<div class="sc-htpNat fYMbTb">
														Driving licence

													</div>
												</label>
												<input type="text" tabindex="" class="data-hj-whitelist" name="driving_licence" value="<?php echo $personal_detail->driving_licence; ?>">
											</div>
											<div class="form-element col-2 gender" name="position-meta.gender">
												<label class="">
													<div class="sc-htpNat fYMbTb">
														Gender

													</div>
												</label>
												<select class="form-select-custom" name="gender">
													<option value="">Select</option>
													<option value="m" <?php if ($personal_detail->gender == 'm') { ?> selected <?php } ?>>Male</option>
													<option value="f" <?php if ($personal_detail->gender == 'f') { ?> selected <?php } ?>>Female</option>
													<option value="o" <?php if ($personal_detail->gender == 'o') { ?> selected <?php } ?>>Other</option>
												</select>
												<i class="form-select-custom--arrow"></i>
											</div>
										</div>
									</div>
									<div class="form__form-row col-1">
										<div>
											<div class="form-element col-2" name="position-meta.nationality">
												<label class="">
													<div class="sc-htpNat fYMbTb">
														Nationality
													</div>
												</label>
												<input type="text" class="data-hj-whitelist" name="nationality" value="<?php echo $personal_detail->nationality; ?>">
											</div>
											<div class="form-element col-2" name="position-meta.maritalStatus">
												<label class="">
													<div class="sc-htpNat fYMbTb">
														Marital status
													</div>
												</label>
												<input type="text" class="data-hj-whitelist" name="marital_status" value="<?php echo $personal_detail->marital_status; ?>">
											</div>
										</div>
									</div>
									<div class="form__form-row col-1">
										<div>
											<div class="form-element col-2" name="position-meta.linkedin">
												<label class="">LinkedIn</label>
												<input type="text" class="data-hj-whitelist" name="linkedin" value="<?php echo $personal_detail->linkedin; ?>">
											</div>
											<div class="form-element col-2" name="position-meta.website">
												<label class="">Website</label>
												<input type="text" class="data-hj-whitelist" name="website" value="<?php echo $personal_detail->website; ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="btn__add-form-section additional_plus" style="margin-top: 10px;">

								<i class="btn__add-form-section--icon glyphicon glyphicon-plus-sign"></i>
								<span class="btn__add-form-section--label">Additional information</span>
							</div>
							<div class="btn__add-form-section additional_minus" style="margin-top: 10px; display:none;">

								<i class="btn__add-form-section--icon glyphicon glyphicon-minus-sign"></i>
								<span class="btn__add-form-section--label">Additional information</span>
							</div>
						</div>
					</div>

				</div>

				<div class="form__buttons">
					<div class="form__button">
						<button type="submit" class="btn__large button--purple">
							<div class="spinner--hidden"></div>
							Next step
							<div class="btn__arrow-right">
								<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-keyboard-arrow-right" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
									<path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path>
								</svg>
							</div>
						</button>
					</div>
					
				</div>

				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$(".additional_plus").click(function() {
			$(".additional_info").toggle();
			$(".additional_plus").toggle();
			$(".additional_minus").toggle();
		});

		$(".additional_minus").click(function() {
			$(".additional_info").toggle();
			$(".additional_plus").toggle();
			$(".additional_minus").toggle();
		});

	});
</script>