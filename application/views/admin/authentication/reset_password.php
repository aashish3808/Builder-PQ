<div class="wizard">
    <div class="page__header">
        <header class="center">
            <h1>Reset Password</h1>
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
                        echo form_open(BACKEND . "authentication", $attributes); ?>
                        <div class="py-3">
                            <div class="form__form-row col-1">
                                <div class="form-element col-2" name="position-email">
                                    <label class="">New Password*</label>
                                    <?php echo form_input($new_password); ?>
                                </div>
                                <div class="form-element col-2" name="position-meta.phoneNumber">
                                    <label class="">Confirm New Password*</label>
                                    <?php echo form_input($new_password_confirm); ?>
                                </div>
                            </div>

                            <?php echo form_input($user_id); ?>
                            <?php echo form_hidden($csrf); ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xl-5">
                                <button type="submit" class="btn__medium button--purple">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Reset Password
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