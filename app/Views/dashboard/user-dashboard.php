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
                                <h3 class="m-0">Dashboard</h3>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
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
                <?php if (is_null($birthFormList) || count($birthFormList) <= 0): ?>
                    Hello <?php if (is_null($userData)) { } else if (is_null($userData['userName'])) { } else { echo($userData['userName']); } ?>, Welcome to Single Window Portal - Dadra Nagar Haveli Daman Diu
                <?php else: ?>
                    <div class="w3-col col sm-12 col-sm-12">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-stripped w3-table w3-stripped">
                                    <thead>
                                        <tr class="w3-teal w3-text-white">
                                            <th><big><strong>Ref.No</strong></big></th>
                                            <th><big><strong>Purpose</strong></big></th>
                                            <th><big><strong>Applicant</strong></big></th>
                                            <th><big><strong>Village</strong></big></th>
                                            <th><big><strong>Status</strong></big></th>
                                            <th><big><strong>Action</strong></big></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($birthFormList as $birth): ?>
                                        <tr class="w3-hover-pale-yellow">
                                            <td>#<?= $birth['projectCode']; ?>-<?= $birth['stageCode']; ?>-<?= $birth['id']; ?></td>
                                            <td><?= $birth['stageName']; ?></td>
                                            <td><?= $birth['name']; ?></td>
                                            <td><?= ($birth['villageName'] . " " . $birth['cityName']); ?></td>
                                            <td>
                                                <span class="btn btn-flat w3-btn w3-ripple w3-yellow w3-text-black"><?= ($birth['shamStatusTitle'] . ", " . $birth['actionStatusName'] . ", " . $birth['remark']); ?></span>
                                            </td>
                                            <td>
                                                <div class="w3-dropdown-hover">
                                                    <button class="btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny btn-block">Open&nbsp;&nbsp;<i class="fa fa-chevron-down"></i></button>
                                                    <div class="w3-dropdown-content w3-bar-block w3-border">
                                                        <?php if ($birth['stageId']==1): ?>
                                                        <a class="btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny btn-block" data-toggle="tooltip" title="View Form" href="<?= base_url() . "/lnd-sp-form/" . ($birth['id']); ?>/1">
                                                            <i class="fa fa-eye w3-medium"></i>
                                                            &nbsp;&nbsp;View
                                                        </a>
                                                        <?php if ($birth['status']==7): ?>
                                                        <a class="btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny btn-block" data-toggle="tooltip" title="Download Order" href="<?= base_url() . "/lnd-sp-order/" . ($birth['id']); ?>">
                                                            <i class="fa fa-cog w3-medium"></i>
                                                            &nbsp;&nbsp;Order
                                                        </a>
                                                        <a class="btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny btn-block" data-toggle="tooltip" title="Download Sanad" href="<?= base_url() . "/lnd-sp-sanad/" . ($birth['id']); ?>">
                                                            <i class="fa fa-cog w3-medium"></i>
                                                            &nbsp;&nbsp;Sanad
                                                        </a>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if ($birth['stageId']==6): ?>
                                                        <a class="btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny btn-block" data-toggle="tooltip" title="View Form" href="<?= base_url() . "/sub-reg-death-form/" . ($birth['id']); ?>/1">
                                                            <i class="fa fa-eye w3-medium"></i>
                                                            &nbsp;&nbsp;View
                                                        </a>
                                                        <?php if ($birth['status']==7): ?>
                                                        <a class="btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny btn-block" data-toggle="tooltip" title="Download Certificate" href="<?= base_url() . "/sub-reg-death-certificate/" . ($birth['id']); ?>">
                                                            <i class="fa fa-cog w3-medium"></i>
                                                            &nbsp;&nbsp;Certificate
                                                        </a>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                                <p style="height: 159px;">&nbsp;</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    
    
    <!-- Action Modal Starts -->
    <div class="modal" id="actionModal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content card card-orange card-outline">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title w3-text-center w3-center">Available Action(s)</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="actionModalBody">
                    <div class="container-fluid">
                        <p>Loading . . .</p>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer w3-teal" style="margin:0; padding:1.5px;"></div>
            </div>
        </div>
    </div>
    <!-- Action Modal End -->
</section>
<!-- /.content -->
<script type="text/javascript" src="<?= base_url(); ?>/public/dist/js/pages/dashboard/user-dashboard.js"></script>
<?= $this->endSection(); ?>