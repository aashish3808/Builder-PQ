<div class="wizard">

   
    <div class="page__header">
        <header class="center">
            <h1>New Employee Signup</h1>
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
                <hr style="margin-bottom: 20px;" />
                <div class="form-section__content">


                    <div class="form__form-group">

                        <?php
                        $attributes = array('class' => 'js-validation-signin', 'id' => 'myform');
                        echo form_open(BACKEND . "authentication/add", $attributes); ?>
                        <div class="py-3">
                            <div class="form__form-row col-1">
                                <div class="form-element col-2" name="position-email">
                                    <label class="">First Name*</label>
                                    <input type="text" tabindex="1" class="data-hj-whitelist" autocomplete="off" name="first_name" value="" required />
                                </div>
                                <div class="form-element col-2" name="position-meta.phoneNumber">
                                    <label class="">Last Name</label>
                                    <input type="text" tabindex="2" class="data-hj-whitelist" autocomplete="off" name="last_name" value="" required />
                                </div>
                            </div>
                            <div class="form__form-row col-1">
                                <div class="form-element col-2" name="position-email">
                                    <label class="">Email address*</label>
                                    <input type="text" tabindex="3" class="data-hj-whitelist" autocomplete="off" name="email" value="" required />
                                </div>
                                <div class="form-element col-2" name="position-meta.phoneNumber">
                                    <label class="">Profile Image</label>
                                    <input type="file" tabindex="4" name="profile_image" class="data-hj-whitelist" accept="image/*" data-style="fileinput" data-inputsize="medium">
                                </div>
                            </div>
                            <div class="form__form-row col-1">
                                <div class="form-element col-2" name="position-email">
                                    <label class="">Password*</label>
                                    <input type="password" tabindex="5" class="data-hj-whitelist" autocomplete="off" name="password" value="" required />
                                </div>
                                <div class="form-element col-2" name="position-meta.phoneNumber">
                                    <label class="">Confirm Password*</label>
                                    <input type="password" tabindex="6" class="data-hj-whitelist" autocomplete="off" name="password_confirm" value="" required />
                                </div>
                            </div>



                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xl-5">
                                <button type="submit" class="btn__medium button--purple">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign Up
                                </button>
                            </div>

                            <div class="col-md-6 col-xl-5">

                            </div>

                        </div>
                        <?php echo form_close(); ?>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>