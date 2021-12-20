<div class="wizard">


    <div class="page__header">
        <header class="center">
            <h1><i class="icon-reorder"></i> <?php echo lang('deactivate_heading'); ?></h1>
        </header>


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

                    <br> <br>

                    <p><?php echo sprintf(lang('deactivate_subheading'), $user->username); ?></p>



                </div>
                <hr style="margin-bottom: 20px;" />
                <div class="form-section__content">


                    <div class="form__form-group">

                        <?php
                        echo form_open(BACKEND . "myaccount/deactivate/" . $user->id); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <?php echo lang('deactivate_confirm_y_label', 'confirm'); ?>
                                    <input type="radio" name="confirm" value="yes" checked="checked" />
                                    <?php echo lang('deactivate_confirm_n_label', 'confirm'); ?>
                                    <input type="radio" name="confirm" value="no" />
                                    <div class="form-group row">
                            <div class="col-md-6 col-xl-5">
                                <button type="submit" class="btn__medium button--purple">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Change Status
                                </button>
                            </div>

                            <div class="col-md-6 col-xl-5">

                            </div>

                        </div>
                                </p>
                            </div>
                        </div> <!-- /.row -->
                        <?php echo form_hidden($csrf); ?>
                        <?php echo form_hidden(array('id' => $user->id)); ?>


                        <?php echo form_close(); ?>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>