<?= $this->extend('layout/base'); ?>

<?= $this->section('content'); ?>

<br />
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
                                <h3 class="m-0">Service List</h3>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/user-dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Service List</li>
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
                        <div class="w3-col col sm-12 col-sm-12">
                            <fieldset>
                                <legend><a class="w3-button w3-block w3-large bg-orange w3-text-white w3-hover-orange w3-wide" href="javascript:trigger_accordion('lnd-list');"><span class="w3-text-white pull-left"><strong>LND</strong> - Land Section</span>&nbsp;&nbsp;<i id="lnd-list-icon" class="pull-right fa fa-1x fa-chevron-up w3-text-white" style="padding-top: 4px;"></i></a></legend>
                                <div class="table-responsive w3-animate-zoom opened" id="lnd-list">
                                    <table class="table table-stripped w3-table w3-stripped">
                                        <thead>
                                            <tr class="bg-olive w3-text-white">
                                                <th><big><strong class="w3-text-white">Sr.No.</strong></big></th>
                                                <th><big><strong class="w3-text-white">LND - Service Detail</strong></big></th>
                                                <th colspan="2" class="text-center w3-center w3-text-center w3-text-white"><big><strong>Action</strong></big></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="w3-hover-pale-yellow">
                                                <td style="width:79px;">I.</td>
                                                <td>SP - Sale Permission</td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/user-dashboard/1"><i class="fa fa-1x fa-eye"></i>&nbsp;&nbsp;&nbsp;View</a></td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/lnd-sp-form/0/0"><i class="fa fa-1x fa-pencil"></i>&nbsp;&nbsp;&nbsp;Apply</a></td>
                                            </tr>
                                            <tr class="w3-hover-pale-yellow">
                                                <td style="width:79px;">II.</td>
                                                <td>NA - Non Agricultural Permission</td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/user-dashboard/2"><i class="fa fa-1x fa-eye"></i>&nbsp;&nbsp;&nbsp;View</a></td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/lnd-na-form"><i class="fa fa-1x fa-pencil"></i>&nbsp;&nbsp;&nbsp;Apply</a></td>
                                            </tr>
                                            <tr class="w3-hover-pale-yellow">
                                                <td style="width:79px;">III.</td>
                                                <td>GP - Gift Permission</td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/user-dashboard/3"><i class="fa fa-1x fa-eye"></i>&nbsp;&nbsp;&nbsp;View</a></td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/lnd-gp-form"><i class="fa fa-1x fa-pencil"></i>&nbsp;&nbsp;&nbsp;Apply</a></td>
                                            </tr>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="w3-col col sm-12 col-sm-12">
                            <fieldset>
                                <legend><a class="w3-button w3-block w3-large bg-orange w3-text-white w3-hover-orange w3-wide" href="javascript:trigger_accordion('sub-reg-list');"><span class="w3-text-white pull-left"><strong>SUB-REG</strong> - Sub. Registrar</span>&nbsp;&nbsp;<i id="sub-reg-list-icon" class="pull-right fa fa-1x fa-chevron-up w3-text-white" style="padding-top: 4px;"></i></a></legend>
                                <div class="table-responsive w3-animate-zoom opened" id="sub-reg-list">
                                    <table class="table table-stripped w3-table w3-stripped">
                                        <thead>
                                            <tr class="bg-olive w3-text-white">
                                                <th><big><strong class="w3-text-white">Sr.No.</strong></big></th>
                                                <th><big><strong class="w3-text-white">SUB-REG - Service Detail</strong></big></th>
                                                <th colspan="2" class="text-center w3-center w3-text-center w3-text-white"><big><strong>Action</strong></big></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="w3-hover-pale-yellow">
                                                <td style="width:79px;">I.</td>
                                                <td>Birth Registration</td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/user-dashboard/4"><i class="fa fa-1x fa-eye"></i>&nbsp;&nbsp;&nbsp;View</a></td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/sub-reg-birth-form"><i class="fa fa-1x fa-pencil"></i>&nbsp;&nbsp;&nbsp;Apply</a></td>
                                            </tr>
                                            <tr class="w3-hover-pale-yellow">
                                                <td style="width:79px;">II.</td>
                                                <td>Marriage Registration</td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/user-dashboard/5"><i class="fa fa-1x fa-eye"></i>&nbsp;&nbsp;&nbsp;View</a></td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/sub-reg-marriage-form" href="<?= base_url(); ?>/sub-reg-death-form"><i class="fa fa-1x fa-pencil"></i>&nbsp;&nbsp;&nbsp;Apply</a></td>
                                            </tr>
                                            <tr class="w3-hover-pale-yellow">
                                                <td style="width:79px;">III.</td>
                                                <td>Death Registration</td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/user-dashboard/6"><i class="fa fa-1x fa-eye"></i>&nbsp;&nbsp;&nbsp;View</a></td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/sub-reg-death-form"><i class="fa fa-1x fa-pencil"></i>&nbsp;&nbsp;&nbsp;Apply</a></td>
                                            </tr>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="w3-col col sm-12 col-sm-12">
                            <fieldset>
                                <legend><a class="w3-button w3-block w3-large bg-orange w3-text-white w3-hover-orange w3-wide" href="javascript:trigger_accordion('pwd-list');"><span class="w3-text-white pull-left">03. <strong>PWD</strong> - Public Works Department</span>&nbsp;&nbsp;<i id="pwd-list-icon" class="pull-right fa fa-1x fa-chevron-up w3-text-white" style="padding-top: 4px;"></i></a></legend>
                                <div class="table-responsive w3-animate-zoom opened" id="pwd-list">
                                    <table class="table table-stripped w3-table w3-stripped">
                                        <thead>
                                            <tr class="bg-olive w3-text-white">
                                                <th><big><strong class="w3-text-white">Sr.No.</strong></big></th>
                                                <th><big><strong class="w3-text-white">PWD - Service Detail</strong></big></th>
                                                <th colspan="2" class="text-center w3-center w3-text-center w3-text-white"><big><strong>Action</strong></big></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="w3-hover-pale-yellow">
                                                <td style="width:79px;">I.</td>
                                                <td>New Water Connection Application</td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/user-dashboard"><i class="fa fa-1x fa-eye"></i>&nbsp;&nbsp;&nbsp;View</a></td>
                                                <td style="width:99px;"><a class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/pwd-water-form"><i class="fa fa-1x fa-pencil"></i>&nbsp;&nbsp;&nbsp;Apply</a></td>
                                            </tr>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="w3-col col sm-12 col-sm-12">
                            <fieldset>
                                <legend><a class="w3-button w3-block w3-large bg-orange w3-text-white w3-hover-orange w3-wide" href="javascript:trigger_accordion('pda-list');"><span class="w3-text-white pull-left">04. <strong>PDA</strong> - Planning & Development Authority</span>&nbsp;&nbsp;<i id="pda-list-icon" class="pull-right fa fa-1x fa-chevron-up w3-text-white" style="padding-top: 4px;"></i></a></legend>
                                <div class="table-responsive w3-animate-zoom opened" id="pda-list">
                                    <table class="table table-stripped w3-table w3-stripped">
                                        <thead>
                                            <tr class="bg-olive w3-text-white">
                                                <th><big><strong class="w3-text-white">Sr.No.</strong></big></th>
                                                <th><big><strong class="w3-text-white">PDA - Service Detail</strong></big></th>
                                                <th colspan="2" class="text-center w3-center w3-text-center w3-text-white"><big><strong>Action</strong></big></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="w3-hover-pale-yellow">
                                                <td style="width:79px;">I.</td>
                                                <td>X -- Sample P D A - 1 -- X</td>
                                                <td style="width:99px;"><span class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/user-dashboard/"><i class="fa fa-1x fa-eye"></i>&nbsp;&nbsp;&nbsp;View X</span></td>
                                                <td style="width:99px;"><span class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white"><i class="fa fa-1x fa-pencil"></i>&nbsp;&nbsp;&nbsp;Apply X</span></td>
                                            </tr>
                                            <tr class="w3-hover-pale-yellow">
                                                <td style="width:79px;">II.</td>
                                                <td>X -- Sample P D A - 2 -- X</td>
                                                <td style="width:99px;"><span class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white" href="<?= base_url(); ?>/user-dashboard/"><i class="fa fa-1x fa-eye"></i>&nbsp;&nbsp;&nbsp;View X</span></td>
                                                <td style="width:99px;"><span class="btn btn-flat btn-block btn-sm w3-btn w3-ripple w3-indigo w3-hover-teal w3-text-white"><i class="fa fa-1x fa-pencil"></i>&nbsp;&nbsp;&nbsp;Apply X</span></td>
                                            </tr>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                            </fieldset>
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
                    <button type="button" class="btn btn-primary mx-auto text-center" data-dismiss="modal">PAY NOW</button>
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
<script type="text/javascript" src="<?= base_url(); ?>/public/dist/js/pages/service-list.js"></script>

<?= $this->endSection(); ?>