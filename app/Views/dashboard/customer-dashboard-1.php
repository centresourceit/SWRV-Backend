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
                                <h3 class="m-0">Customer Dashboard</h3>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">Customer Dashboard</li>
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
                                            <span class="btn btn-flat w3-btn w3-ripple w3-yellow w3-text-black">Submitted</span>
                                        </td>
                                        <td>
                                            <div class="w3-dropdown-hover">
                                                <button class="btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny">
                                                    Action&nbsp;&nbsp;
                                                    <i class="fa fa-chevron-down"></i>
                                                </button>
                                                <div class="w3-dropdown-content w3-bar-block w3-border">
                                                    <a class="w3-bar-item w3-button btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny" data-toggle="tooltip" title="Pay Challan" href="#">
                                                        <i class="fa fa-eye w3-medium"></i>
                                                        &nbsp;&nbsp;View
                                                    </a>
                                                    <button class="w3-bar-item w3-button btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny" data-toggle="tooltip" title="Pay Challan" onclick="$('#paymentModal').modal('show');">
                                                        <i class="fa fa-inr w3-medium"></i>
                                                        &nbsp;&nbsp;Pay Challan
                                                    </button>
                                                </div>
                                            </div>
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
    <div class="modal" id="paymentModal">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content card card-orange card-outline">
                <div class="modal-header">
                    <h3 class="modal-title text-center">Make Payment</h3>
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
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Fee Description</th>
                                        <th scope="col">Fee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td><input type="text" class="form-control" required="" value="Sale Reg. Fees" disabled=""></td>
                                        <td> <input type="text" class="form-control" required="" value="32,500" disabled=""></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td><input type="text" class="form-control" required="" value="Stamp Duty" disabled=""></td>
                                        <td> <input type="text" class="form-control" required="" value="3,200" disabled=""></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>
                                            <input type="text" class="form-control" required="" value="Late Fee" disabled="">
                                        </td>
                                        <td> <input type="text" class="form-control" required="" value="2,100" disabled=""></td>
                                    </tr>
                                    <tr style="background-color: #d1d5db;">
                                        <th colspan="2">Total Fees Payment:</th>
                                        <td>37,800/-</td>
                                        <td> </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <a class="btn btn-primary mx-auto text-center" href="<?= base_url(); ?>/mamlatdar-dashboard">PAY NOW</a>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-12">
                            <button type="button" class="btn btn-danger mx-auto text-center" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer w3-teal" style="margin:0; padding:1.5px;"></div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
<script type="text/javascript" src="<?= base_url(); ?>/public/dist/js/pages/customer-land-sale.js"></script>

<?= $this->endSection(); ?>