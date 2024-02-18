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
                                <h3 class="m-0"><a class="btn w3-btn btn-link w3-white w3-text-green w3-hover-orange w3-hover-text-black w3-large" href="<?= base_url(); ?>/city"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New City</a></h3>
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
                <?php if (count($cities)>0): ?>
                    <?php foreach($cities as $city): ?>
                        <div class="w3-white card card-orange card-outline jumbotron col col-md-3 m-1">
                            <p style="position: absolute; top: 0; right:0;">
                                <a class="btn w3-btn btn-link w3-white w3-text-blue w3-hover-blue w3-hover-text-white" href="<?= base_url(); ?>/city/<?= $city['id']; ?>"><i class="fa fa-lg fa-edit"></i></a>
                                <a class="btn w3-btn btn-link w3-white w3-text-red w3-hover-red w3-hover-text-white" href="#"><i class="fa fa-lg fa-trash"></i></a>
                            </p>
                            <h4><strong><?= $city['cityName']; ?></strong><hr style="margin:0; padding:0;" class="border border-success"/><em class="w3-medium w3-text-gray">City Name</em></h4>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script type="text/javascript" src="<?= base_url(); ?>/public/dist/js/pages/city.js"></script>
<?= $this->endSection(); ?>