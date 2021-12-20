<div class="row">
    <!--=== Horizontal Forms ===-->
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading"><i class="icon-reorder"></i> <?php echo lang('edit_group_heading');?></header>
            <div class="panel-body">
                <?php if($message != '') { ?>
                    <div class="alert alert-danger fade in">
                        <i class="icon-remove close" data-dismiss="alert"></i>
                        <strong>Error!</strong> <?php echo $message;?>
                    </div>
                <?php } ?>

                <?php
                echo form_open(current_url());?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Group Name : </label>
                            <div class="col-md-8">
                                <?php echo form_input($group_name);?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">

                            <label class="col-md-5 control-label" for="new_password">Group Description</label>

                            <div class="col-md-7">
                                <?php echo form_input($group_description);?>

                            </div>
                        </div>

                    </div>

                </div>
                <div class="clearfix"> </div>

                    <div class="col-md-12">
                        <br> <br>
                    <div class="form-group">
                        <input type="submit" value="Edit Group" class="btn btn-primary pull-right">
                    </div>
                </div> <!-- /.col-md-12 -->


                <?php echo form_close(); ?>
            </div>
        </section>
    </div>
</div>



                