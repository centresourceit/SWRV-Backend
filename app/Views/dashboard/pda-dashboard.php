
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
                                <h3 class="m-0">PDA Dashboard</h3>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">PDA Dashboard</li>
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
                <div class="w3-col col sm-12 col-sm-12">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-stripped w3-table w3-stripped">
                                <thead>
                                    <tr class="w3-teal w3-text-white">
                                        <th><big><strong>Ref.No</strong></big></th>
                                        <th><big><strong>Name</strong></big></th>
                                        <th><big><strong>Purpose</strong></big></th>
                                        <th><big><strong>District</strong></big></th>
                                        <th><big><strong>Status</strong></big></th>
                                        <th><big><strong>Action</strong></big></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="w3-hover-pale-yellow">
                                        <td>COL-LND-NA-2022-007</td>
                                        <td>Rajesh Kumar</td>
                                        <td>N.A. Permission</td>
                                        <td>Khariwad Daman</td>
                                        <td>
                                            <small><span class="btn btn-flat w3-btn w3-ripple w3-yellow w3-text-black">Submitted</span></small>
                                        </td>
                                        <td>
                                            <small>
                                                <button class="w3-button btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black" data-toggle="tooltip" title="Pay Challan" onclick="$('#actionModal').modal('show');">
                                                    <i class="fa fa-share w3-medium"></i>
                                                    &nbsp;&nbsp;Action
                                                </button>
                                            </small>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                            <p style="height: 159px;">&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- The Modal -->
    <div class="modal" id="approveModal">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content card card-orange card-outline">
                <div class="modal-header">
                    <h3 class="modal-title text-center">Approve</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="appName">Name of Applicant<span class="color-nic-red" style="color: red;">*</span></label>
                                <input type="text" id="appName" name="appName" class="form-control" placeholder="Name of Applicant" required="required" value="Rajesh Kumar" readonly="readonly" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="appId">Application No.<span class="color-nic-red" style="color: red;">*</span></label>
                                <input type="email" class="form-control" id="appId" name="appId" placeholder="Application Number" value="COL-LND-NA-2022-007" required="required" readonly="readonly" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="purpose">Purpose<span class="color-nic-red" style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Purpose" value="Sale Permission" required="required" readonly="readonly" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="dt">Date<span class="color-nic-red" style="color: red;">*</span></label>
                                <input type="email" class="form-control" id="dt" name="dt" placeholder="Date" value="12-12-2022" required="required" readonly="readonly" />
                            </div>
                        </div>
                    </div>
                    <div class="w3-hide hide row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="regNo">Registration No.<span class="color-nic-red" style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="regNo" name="regNo" placeholder="Registration No" required="required" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="upto">Valid Up to<span class="color-nic-red" style="color: red;">*</span></label>
                                <input type="date" class="form-control" id="upto" name="upto" placeholder="Valid Up to" required="required" />
                            </div>
                        </div>
                    </div>
                    <div class="w3-hide hide form-group" id="form_land_document_container">
                        <label>Certificate/Sanad <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; </span></label><br>
                        <input type="file" id="form_land_document" name="form_land_document" accept="application/pdf" class="spinner_container_for_na_1">
                        <div class="error-message error-message-na-form_land_document"></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="remark">Remark<span class="color-nic-red" style="color: red;">*</span></label>
                            <textarea type="date" class="form-control" name="remark" id="remark" placeholder="Remark !"></textarea>
                        </div>

                    </div>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-12">
                            <a class="btn btn-success mx-auto text-center" href="<?= base_url(); ?>/mamlatdar-dashboard">Approve</a>
                            <button type="button" class="btn btn-danger mx-auto text-center" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer w3-teal" style="margin:0; padding:1.5px;"></div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="actionModal">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content card card-orange card-outline">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title w3-text-center w3-center">Available Action(s)</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col w3-col xs-12 sm-12 col-xs-12 col-sm-12">
                                <button class="w3-margin-top w3-button btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-teal btn-block" data-toggle="tooltip" title="Approve" onclick="$('#actionModal').modal('hide');$('#approveModal').modal('show');">
                                    <i class="fa fa-check w3-medium"></i>
                                    &nbsp;&nbsp;Approve
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w3-col xs-6 sm-6 col-xs-6 col-sm-6">
                                <a class="w3-margin-top w3-button btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black btn-block" data-toggle="tooltip" title="Accept" href="#">
                                    <i class="fa fa-inr w3-medium"></i>
                                    &nbsp;&nbsp;Request Payment
                                </a>
                            </div>
                            <div class="col w3-col xs-6 sm-6 col-xs-6 col-sm-6">
                                <a class="w3-margin-top w3-button btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black btn-block" data-toggle="tooltip" title="Accept" href="#">
                                    <i class="far fa-comments w3-medium"></i>
                                    &nbsp;&nbsp;Raise Query
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w3-col xs-6 sm-6 col-xs-6 col-sm-6">
                                <a class="w3-margin-top w3-button btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black btn-block" data-toggle="tooltip" title="Accept" href="#">
                                    <i class="fa fa-paperclip w3-medium"></i>
                                    &nbsp;&nbsp;Request Document
                                </a>
                            </div>
                            <div class="col w3-col xs-6 sm-6 col-xs-6 col-sm-6">
                                <a class="w3-margin-top w3-button btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black btn-block" data-toggle="tooltip" title="Accept" href="#">
                                    <i class="fa fa-line-chart w3-medium"></i>
                                    &nbsp;&nbsp;Escalate to Senior
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer w3-teal" style="margin:0; padding:1.5px;"></div>
            </div>
        </div>
    </div>
</div>

</section>
<!-- /.content -->
<script type="text/javascript" src="<?= base_url(); ?>/public/dist/js/pages/customer-land-sale.js"></script>

<?= $this->endSection(); ?>