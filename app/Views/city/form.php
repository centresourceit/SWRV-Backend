<?= $this->extend('layout/base'); ?>
<?= $this->section('content'); ?>
<br/>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-orange card-outline">
            <div class="card-header" style="margin:0; padding: 0;">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h3 class="m-0"><?php if (isset($page_head)) { echo($page_head); } else { echo("Manage City"); } ?></h3>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active"><?php if (isset($page_head)) { echo($page_head); } else { echo("Cities"); } ?></li>
                                </ol>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>/city/manage" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id" name="id" />
                    </div>
                    <div class="form-group">
                        <label for="cityName">City Name :</label>
                        <input type="text" class="form-control" id="cityName" placeholder="Enter City Name" name="cityName" required="required" />
                        <?php if(isset($validation)): ?>
                            <?php if($validation->hasError('cityName')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('cityName'); ?></div>
                            <?php else: ?>
                                <div class="valid-feedback">Validated !</div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script type="text/javascript" src="<?= base_url(); ?>/public/dist/js/pages/city.js"></script>
<?= $this->endSection(); ?>