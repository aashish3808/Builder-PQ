<div class="wizard">


    <div class="page__header">
        <header class="center">
            <h1>My Account</h1>
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
                        $form_attributes['class'] = "form-horizontal row-border";
                        $form_attributes['id']    = "validate-1";
                        echo form_open_multipart(BACKEND . "myaccount/index/" . $user->id, $form_attributes);
                        ?>
                        <?php echo form_hidden('id', $user->id); ?>
                        <?php echo form_hidden('hidden_image', $user->profileImage); ?>

                        <?php echo form_hidden($csrf); ?>
                        <div class="py-3">
                            <div class="form__form-row col-1">
                                <div class="form-element col-2" name="position-email">
                                    <label class="">First Name*</label>
                                    <?php echo form_input($first_name); ?>
                                </div>
                                <div class="form-element col-2" name="position-meta.phoneNumber">
                                    <label class="">Last Name</label>
                                    <?php echo form_input($last_name); ?>
                                </div>
                            </div>
                            <div class="form__form-row col-1">
                                <div class="form-element col-2" name="position-email">
                                    <label class="">New Profile Picture</label>
                                    <input type="file" tabindex="4" name="profile_image" class="data-hj-whitelist" accept="image/*" data-style="fileinput" data-inputsize="medium">
                                </div>
                                <div class="form-element col-2" name="position-meta.phoneNumber">

                                    <?php
                                    $image_source = get_image_source("admin/thumbs/thumb_" . stripslashes(@$user->profileImage));
                                    if (@$user->profileImage) {
                                        $delete_image_url = BACKEND . 'myaccount/delete_image/' . $user->id;
                                    }
                                    ?>

                                    <img src="<?php echo $image_source; ?>" width="128" />
                                    <?php if (isset($delete_image_url)) { ?>
                                        <a class="bs-tooltip del_listing" title="" href="<?php echo $delete_image_url; ?>" data-original-title="Delete">
                                            <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                        </a>
                                    <?php }
                                    ?>
                                </div>
                            </div>

                        </div>
                        <?php if (0) { ?>
                            <div class="row">
                                <header class="panel-heading">
                                    <h5>Group</h5>
                                </header>
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <?php foreach ($groups as $group) : ?>
                                            <label class="checkbox-inline">
                                                <?php
                                                $gID = $group['id'];
                                                $checked = null;
                                                $item = null;
                                                foreach ($currentGroups as $grp) {
                                                    if ($gID == $grp->id) {
                                                        $checked = ' checked="checked"';
                                                        break;
                                                    }
                                                }
                                                ?>
                                                <input class="" type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>" <?php echo $checked; ?>>
                                                <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                            </label>
                                        <?php endforeach ?>
                                    </div>

                                </div>
                            </div> <!-- /.row -->

                        <?php } ?>
                        <div class="form-group row">
                            <div class="col-md-6 col-xl-5">
                                <button type="submit" class="btn__medium button--purple">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Update Account
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