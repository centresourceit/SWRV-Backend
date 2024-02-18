<?= $this->extend('/layout/base'); ?>

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
                                <h3 class="m-0">Teor Birth</h3>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">Teor Birth</li>
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
                <h3 class="card-title" style="float: none; text-align: center;">SCHEDULE - 1</h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">(See Rule 3)</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">FORM OF APPLICATION UNDER
                    SECTION 8 – B OF DAPVR, 1962.</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">As amended by DAPVR
                    (Amendment) Act – 1968.</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">FOR GRANT OF PERMISSION
                    FOR SALE OF LAND.</div>
                <br/>
                <div class="row">
                    <div class="form-group col-sm-6">
                        To,<br>
                        The Collector,
                    </div>
                </div>

                <hr/>


                <h5 class="text-olive">1. My Geographical Division [ City / Village ] : </h5>

                <form action="#">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="district">1.1 District where the land is situated. <span class="color-nic-red" style="color: red;">*</span></label>
                                <select class="form-control custom-select select2" style="width: 100%;" name="district" id="district">
                                    <option value="daman" selected="selected">Daman</option>
                                    <option value="diu">Diu</option>
                                    <option value="silvassa">Silvassa</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="village">1.2 Village where the land is situated. <span class="color-nic-red" style="color: red;">*</span></label>
                                <select class="form-control custom-select select2" style="width: 100%;" name="village" id="village">
                                    <option value="marwad">Marwad</option>
                                    <option value="devka" selected="selected">Devka</option>
                                    <option value="deuretha">Dunetha</option>
                                    <option value="kechigam">Kachigam</option>
                                    <option value="dabhel">Dabhel</option>
                                    <option value="bhimpore">Bhimpore</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </form>

                <hr />

                <h5 class="text-olive">2. I also furnish the following information: </h5>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="appName">2.1 Full Name of Applicant<span class="color-nic-red" style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="appName" name="appName" placeholder="Enter Name of Applicant" value="Rajesh Kumar" required="required" />
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="appAddress">2.2 Full Postal address<span class="color-nic-red" style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="appAddress" name="appAddress" placeholder="Enter Postal address" value="Flat 202 City Center Airport Main Road Devka Daman" required="required" />
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="occ">2.3 Occupation <span class="color-nic-red" style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="occ" name="occ" placeholder="Enter Occupation" value="Chatered Accountant" required="required" />
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="surveyNo">2.4 Is the land under acquisition if so, state details. <span class="color-nic-red" style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="surveyNo" name="surveyNo" placeholder="Enter land acquisition details" value="NA" required="required" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="surveyHissa">2.5 Survey No. Hissa No. of the land <span class="color-nic-red" style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="surveyHissa" name="surveyHissa" placeholder="Enter Survey No. Hissa No" value="24 / 8 - { A }" required="required" />
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="acquisition">2.6 Is the land under acquisition if so, state details. <span class="color-nic-red" style="color: red;">*</span></label>
                            <input type="email" class="form-control" id="acquisition" name="acquisition" placeholder="Enter State Acquisition Details" value="NA" required="required" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="villageTaluka">2.7 Village taluka where the land is situated <span class="color-nic-red" style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="villageTaluka" name="villageTaluka" placeholder="Enter Village Taluka" value="Airport Main Road Devka Daman" required="required" />
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="areaMeasurement">2.8 Area and assessment/rent of the land <span class="color-nic-red" style="color: red;">*</span></label>
                            <input type="email" class="form-control" id="areaMeasurement" name="areaMeasurement" placeholder="Enter Area Land Measurement" value="2435 sq.ft." required="required" />
                        </div>
                    </div>
                </div>

                <hr/>

                <div class="form-group mt-4" id="form_land_document_container">
                    <label>3. Form No. I &amp; XIV of the land in question, in original +9 Zerox cooy. <span style="color: red;">* <br>(Maximum File Size: 1MB)  (Upload PDF Only) </span></label><br>
                    <input type="file" id="form_land_document" name="form_land_document" accept="application/pdf" class="spinner_container_for_na_1">
                    <div class="error-message error-message-na-form_land_document"></div>
                </div>
                <hr/>
                <div class="form-group" id="form_land_document_container">
                    <label>4. Site Plan of the land in question, in original +9 Zerox copy. <span style="color: red;">* <br>(Maximum File Size: 1MB)  (Upload PDF Only)</span></label><br>
                    <input type="file" id="form_land_document" name="form_land_document" accept="application/pdf" class="spinner_container_for_na_1">
                    <div class="error-message error-message-na-form_land_document"></div>
                </div>
                <hr/>
                <div class="form-group" id="form_land_document_container">
                    <label>5. Signature <span style="color: red;">* <br>(Maximum File Size: 1MB) (Upload JPG | PNG | JPED | JFIF Only) </span></label><br>
                    <input type="file" id="form_land_document" name="form_land_document" accept="application/pdf" class="spinner_container_for_na_1">
                    <div class="error-message error-message-na-form_land_document"></div>
                </div>

                <hr/>

                <div class="form-group">
                    <button type="button" onclick="customer_sale_draft('<?= base_url(); ?>/customer-dashboard');" class="btn btn-sm btn-primary btndraf" style="margin-right: 5px;">Save
                        as a Draft</button>
                    <button type="button" onclick="customer_sale_submit('<?= base_url(); ?>/customer-dashboard');" class="btn btn-sm btn-success btnsubmit" style="margin-right: 5px;">Submit Application</button>
                    <a href="<?= base_url(); ?>/dashboard" type="button" class="btn btn-sm btn-danger btnclose">Close</a>
                </div>
            </div>
        </div>
    </div>


    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script type="text/javascript" src="<?= base_url(); ?>/public/dist/js/pages/customer-land-sale.js"></script>

<?= $this->endSection(); ?>