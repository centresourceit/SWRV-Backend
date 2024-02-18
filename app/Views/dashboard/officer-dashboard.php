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
                                <h3 class="m-0"><?php if (is_null($userData)) { } else if (is_null($userData['departmentName'])) { } else { echo($userData['departmentName'] . " - "); } ?>Dashboard</h3>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active"><?php if (is_null($userData)) { } else if (is_null($userData['departmentName'])) { } else { echo($userData['departmentName'] . " - "); } ?>Dashboard</li>
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
                                            <th><big><strong>View</strong></big></th>
                                            <th><big><strong>Status</strong></big></th>
                                            <th><big><strong>Action</strong></big></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($birthFormList as $birth): ?>
                                        <tr class="w3-hover-pale-yellow">
                                            <td>#<?= $birth['projectCode']; ?>-<?= $birth['stageCode']; ?>-<?= $birth['id']; ?></td>
                                            <td><?= $birth['stageName']; ?></td>
                                            <td><?= ($birth['name'] . " " . $birth['fatherName']); ?></td>
                                            <td><?= ($birth['villageName'] . " " . $birth['cityName']); ?></td>
                                            <td>
                                        		
                                        		<div class="w3-dropdown-hover">
                                        			<button class="btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny">
                                        				Open&nbsp;&nbsp;
														<i class="fa fa-chevron-down"></i>
                                                    </button>
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
                                                        
                                        		<?php if (!empty($birth['naForm1'])): ?>
                                                	<a class="btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny btn-block" data-toggle="tooltip" title="Open / View Form No I" href="<?= $birth['naForm1']; ?>" target="_blank">
                                                		<i class="fa fa-eye w3-medium"></i>
                                                		&nbsp;&nbsp;FORM-I
                                                    </a>
                                        		<?php endif; ?>
                                        		<?php if (!empty($birth['naForm16'])): ?>
                                                	<a class="btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny btn-block" data-toggle="tooltip" title="Open / View Signature" href="<?= $birth['naForm16']; ?>" target="_blank">
                                                		<i class="fa fa-eye w3-medium"></i>
                                                		&nbsp;&nbsp;FORM-XIV
                                                    </a>
                                        		<?php endif; ?>
                                        		<?php if (!empty($birth['naSitePlan'])): ?>
                                                	<a class="btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny btn-block" data-toggle="tooltip" title="Open / View Site Plan" href="<?= $birth['naSitePlan']; ?>" target="_blank">
                                                		<i class="fa fa-eye w3-medium"></i>
                                                		&nbsp;&nbsp;Site Plan
                                                    </a>
                                        		<?php endif; ?>
                                        		<?php if (!empty($birth['applicantSignatureUrl'])): ?>
                                                	<a class="btn btn-flat w3-btn w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny btn-block" data-toggle="tooltip" title="Open / View Signature" href="<?= $birth['applicantSignatureUrl']; ?>" target="_blank">
                                                		<i class="fa fa-eye w3-medium"></i>
                                                		&nbsp;&nbsp;Signature
                                                    </a>
                                        		<?php endif; ?>
                                                </div></div>
                                                
                                        	</td>
                                            <td>
                                                <span class="btn btn-flat w3-btn w3-ripple w3-yellow w3-text-black"><?= ($birth['shamStatusTitle'] . ", " . $birth['actionStatusName'] . ", " . $birth['remark']); ?></span>
                                            </td>
                                            <td>
                                                <button class="w3-button btn btn-flat w3-ripple w3-indigo w3-text-white w3-hover-orange w3-hover-text-black w3-tiny" data-toggle="tooltip" title="More Available Action" onclick="popAction('<?= base_url() . "','" . ($birth["id"]) . "','" . ($birth["nextShamId"]); ?>');">
                                                    <i class="fa fa-pencil w3-medium"></i>
                                                    &nbsp;&nbsp;Action
                                                </button>
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
    
    
    <!-- Customer Chat Modal Starts -->
    <div class="modal" id="chatModal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content card card-orange card-outline">
                <!-- Modal Header -->
                <div class="modal-header" style="border:0; border-bottom: 1px solid #3f51b5!important;">
                    <h4 class="modal-title w3-text-center w3-center" id="chatModalHeader">Customer Query</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="chatModalBody">
                    <div class="container-fluid">
                        <div class="section w3-white w3-border w3-border-indigo w3-round direct-chat-messages" id="chat-box">
                            <p>Loading . . .</p>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer w3-white" style="border:0; border-top: 1px solid #3f51b5!important; border-bottom: 5px solid #009688 !important;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col col-lg-10 lg-10 col-md-10 md-10 col-sm-10 sm-10 col-xs-10 xs-10">
                                <input type="hidden" id="fromUserIdTEC" />
                                <input type="hidden" id="toUserIdTEC" />
                                <input type="hidden" id="queryTypeTEC" />
                                <input type="hidden" id="documentUrlTEC" />
                                <input type="hidden" id="fileAttPathTEC" value="birth/" />
                                <input type="file" id="fileAttTEC" style="display: none;" onchange="upload_add_file();" />
                                <textarea style="resize: none; width: 100%;" rows="4" id="remarkCommentTEC" placeholder="Enter Message Here"></textarea>
                            </div>
                            <div class="col col-lg-2 lg-2 col-md-2 md-2 col-sm-10 sm-2 col-xs-2 xs-2">
                                <p style="outline: 0; border: 0; margin: 0; padding: 0;">                                
                                    <button class="w3-btn btn button w3-indigo btn-flat btn-block w3-ripple w3-hover-orange w3-text-white" id="attBtn" onclick="$('#fileAttTEC').trigger('click'); return true;"><i class="fa fa-paperclip"></i>&nbsp;&nbsp;Attach</button>
                                    <a class="w3-hide hide w3-btn btn button w3-indigo w3-ripple w3-hover-orange w3-text-white btn-flat" id="attViewBtn" target="_blank" href=""><i class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                                </p>
                                <p style="outline: 0; border: 0; margin: 0; padding: 0;">
                                    <button class="w3-hide hide w3-btn btn button bg-danger w3-ripple w3-text-white btn-flat" id="attRemoveBtn" onclick="$('#fileAttTEC').val(''); $('#documentUrlTEC').val(''); $('#attRemoveBtn').addClass('w3-hide'); $('#attRemoveBtn').addClass('hide'); $('#attViewBtn').addClass('w3-hide'); $('#attViewBtn').addClass('hide'); $('#attBtn').removeClass('w3-hide'); $('#attBtn').removeClass('hide'); return true;"><i class="fa fa-trash"></i></button>
                                </p>
                                <span style="content: ' '; visibility: hidden; display: block; height: 0; clear: both;"></span>
                                <p style="outline: 0; border: 0; margin: 0; padding: 0; margin-top: 16px;"><button class="w3-btn btn button w3-indigo btn-flat btn-block w3-ripple w3-hover-orange w3-text-white" onclick="submitChat();"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Send</button></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Customer Chat Modal End -->
    
    <!-- Payment Modal -->
    <div class="modal" id="paymentModal">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content card card-orange card-outline">
                <div class="modal-header">
                    <h3 class="modal-title text-center">Request Payment</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-lg-12 lg-12 col-md-12 md-12 col-sm-12 sm-12 col-xs-12 xs-12">
                            <table class="table w3-table">
                                <thead>
                                    <tr class="bg-orange">
                                        <th>Sr</th>
                                        <th>Description</th>
                                        <th>Charges</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="paymentModalBodyChargeTableBody"></tbody>
                                <tfoot>
                                    <tr class="w3-indigo">
                                        <th colspan="2">
                                            <strong>
                                                Total Payable
                                            </strong>
                                        </th>
                                        <th colspan="2">
                                            <strong>
                                                <em id="totalPayableSpan">
                                                    0.0 INR
                                                </em>
                                            </strong>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer w3-white" style="border:0; border-top: 1px solid #3F51B5 !important; border-bottom: 5px solid #009688 !important;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col col-lg-3 lg-3 col-md-3 md-3 col-sm-3 sm-3 col-xs-3 xs-3">
                                <button class="w3-btn btn button bg-orange btn-flat btn-block w3-ripple w3-hover-indigo w3-text-white" onclick="add_more_pay_option();">
                                    <i class="fa fa-plus"></i>
                                    &nbsp;&nbsp;Add More
                                </button>
                            </div>
                            <div class="col col-lg-5 lg-5 col-md-5 md-5 col-sm-5 sm-5 col-xs-5 xs-5">&nbsp;</div>
                            <div class="col col-lg-4 lg-4 col-md-4 md-4 col-sm-3 sm-4 col-xs-4 xs-4">
                                <button class="w3-btn btn button w3-indigo btn-flat btn-block w3-ripple w3-hover-teal w3-text-white" onclick="submit_payment();">
                                    <i class="fa fa-paper-plane"></i>
                                    &nbsp;&nbsp;Request Payment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
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
<input type="hidden" id="myUserId" value="<?= session()->get('userId'); ?>" />
<input type="hidden" id="baseUrlTEC" value="<?= base_url(); ?>" />
<input type="hidden" id="formRefIdTEC" value="" />
<input type="hidden" id="stageIdTEC" value="4" />
<script type="text/javascript" src="<?= base_url(); ?>/public/dist/js/pages/dashboard/officer-dashboard.js"></script>
<?= $this->endSection(); ?>