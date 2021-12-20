<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>


<div class="wizard">


    <div class="page__header">
        <header class="center">
            <h1>All Employee List</h1>
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


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover p-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo lang('index_fname_th'); ?></th>
                                            <th><?php echo lang('index_lname_th'); ?></th>
                                            <th><?php echo lang('index_email_th'); ?></th>
                                            <th><?php echo lang('index_groups_th'); ?></th>
                                            <th><?php echo lang('index_status_th'); ?></th>
                                            <th><?php echo lang('index_action_th'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($users as $user) : ?>
                                            <tr>
                                                <th scope="row"><?php echo $i++; ?></th>
                                                <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <?php foreach ($user->groups as $group) : ?>
                                                        <?php echo anchor(BACKEND . "myaccount/edit_group/" . $group->id, '<span class="label label-info">' . htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8') . '</span><br>'); ?><br />
                                                    <?php endforeach ?>
                                                </td>
                                                <td> <?php if ($user->active) { ?>
                                                        <a href="<?php echo BACKEND . "myaccount/deactivate/" . $user->id; ?>"><span class="label label-primary"><?php echo lang('index_active_link'); ?></span></a>
                                                    <?php } else { ?>
                                                        <a href="<?php echo BACKEND . "myaccount/activate/" . $user->id; ?>"><span class="label label-default"><?php echo lang('index_inactive_link'); ?></span></a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <!-- <a href="project_details.html" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>-->
                                                    <a href="<?php echo BACKEND . "myaccount/index/" . $user->id; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                    <a href="<?php echo BACKEND . "myaccount/delete_user/" . $user->id; ?>" class="btn btn-danger btn-xs del_listing"><i class="fa fa-trash-o"></i> Delete </a>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
</div>





<script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>