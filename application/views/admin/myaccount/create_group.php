<div class="row">
    <!--=== Horizontal Forms ===-->
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading"><i class="icon-reorder"></i> <?php echo lang('create_group_heading');?></header>
            <div class="panel-body">
                <?php if($message != '') { ?>
                    <div class="alert alert-danger fade in">
                        <i class="icon-remove close" data-dismiss="alert"></i>
                        <strong>Error!</strong> <?php echo $message;?>
                    </div>
                <?php } ?>

                <?php
                echo form_open(BACKEND."myaccount/create_group");?>

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
                                <?php echo form_input($description);?>

                            </div>
                        </div>

                    </div>

                </div>
                <div class="clearfix"> </div>

                    <div class="col-md-12">
                        <br> <br>
                    <div class="form-group">
                        <input type="submit" value="Create Group" class="btn btn-primary pull-right">
                    </div>
                </div> <!-- /.col-md-12 -->


                <?php echo form_close(); ?>
            </div>
        </section>
    </div>
</div>



                