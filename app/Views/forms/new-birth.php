<?= $this->extend('/layout/base'); ?>

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
                                <h3 class="m-0">New Birth</h3>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">New Birth</li>
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
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">FORM OF APPLICATION UNDER SECTION 8 – B OF DAPVR, 1962.</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">As amended by DAPVR (Amendment) Act – 1968.</div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">FOR GRANT OF PERMISSION FOR SALE OF LAND.</div>
                <br />
                <div class="row">
                    <div class="form-group col-sm-6">
                        To,<br>
                        The Collector,
                    </div>
                </div>

                <hr />


                <h5 class="text-olive">1. My Geographical Division [ City / Village ] : </h5>

                <form action="<?= base_url(); ?>/u-new-birth" method="POST">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="district">1.1 District where the land is situated. <span class="color-nic-red" style="color: red;">*</span></label>
                                <select class="form-control custom-select select2" style="width: 100%;" name="district" id="district">
                                    <option value="1" selected="selected">Daman</option>
                                    <option value="2">Diu</option>
                                    <option value="3">Silvassa</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="village">1.2 Village where the land is situated. <span class="color-nic-red" style="color: red;">*</span></label>
                                <select class="form-control custom-select select2" style="width: 100%;" name="village" id="village">
                                    <option value="1">Marwad</option>
                                    <option value="2" selected="selected">Devka</option>
                                    <option value="3">Dunetha</option>
                                    <option value="4">Kachigam</option>
                                    <option value="5">Dabhel</option>
                                    <option value="6">Bhimpore</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <hr />

                    <h5 class="text-olive">2. I also furnish the following information: </h5>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="appName">2.1 Full Name of Applicant<span class="color-nic-red" style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="appName" name="name" placeholder="Enter Name of Applicant" required="required" />
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="appAddress">2.2 Brother name<span class="color-nic-red" style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="appAddress" name="brother" placeholder="Enter Brother name" required="required" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="occ">2.3 Mother name <span class="color-nic-red" style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="occ" name="mother" placeholder="Enter Mother name" required="required" />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="surveyNo">2.4 Father Name <span class="color-nic-red" style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="surveyNo" name="father" placeholder="Enter Father name" required="required" />
                            </div>
                        </div>
                    </div>





                    <hr />

                    <div class="form-group mt-4" id="form_land_document_container">
                        <label>3. Your Image original Zerox 3+ cooy. <span style="color: red;">* <br>(Maximum File Size: 1MB) (Upload JPG | PNG | JPED | JFIF Only) </span></label><br>
                        <input type="file" id="form_land_document" name="userimg" class="spinner_container_for_na_1">
                        <div class="error-message error-message-na-form_land_document"></div>
                    </div>
                    <hr />
                    <div class="form-group" id="form_land_document_container">
                        <label>4. Your Brohter Image original Zerox 3+ cooy. <span style="color: red;">* <br>(Maximum File Size: 1MB) (Upload JPG | PNG | JPED | JFIF Only)</span></label><br>
                        <input type="file" id="form_land_document" name="brotherimg" class="spinner_container_for_na_1">
                        <div class="error-message error-message-na-form_land_document"></div>
                    </div>
                    <hr />
                    <div class="form-group" id="form_land_document_container">
                        <label>5. Your Father Image original erox 3+ copy. <span style="color: red;">* <br>(Maximum File Size: 1MB) (Upload JPG | PNG | JPED | JFIF Only) </span></label><br>
                        <input type="file" id="form_land_document" name="fatherimg" class="spinner_container_for_na_1">
                        <div class="error-message error-message-na-form_land_document"></div>
                    </div>

                    <hr />
                    <div class="form-group" id="form_land_document_container">
                        <label>6. Your Mother Image original erox 3+ copy. <span style="color: red;">* <br>(Maximum File Size: 1MB) (Upload JPG | PNG | JPED | JFIF Only) </span></label><br>
                        <input type="file" id="form_land_document" name="motherimg" class="spinner_container_for_na_1">
                        <div class="error-message error-message-na-form_land_document"></div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <button type="button" onclick="customer_sale_draft('<?= base_url(); ?>/customer-dashboard');" class="btn btn-sm btn-primary btndraf" style="margin-right: 5px;">Save as a Draft</button>
                        <!-- <button type="button" onclick="customer_sale_submit('<?= base_url(); ?>/customer-dashboard');" class="btn btn-sm btn-success btnsubmit" style="margin-right: 5px;">Submit Application</button> -->

                        <input type="submit" class="btn btn-sm btn-success btnsubmit" style="margin-right: 5px;" value="Submit Application">

                        <a href="<?= base_url(); ?>/dashboard" type="button" class="btn btn-sm btn-danger btnclose">Close</a>
                    </div>

                </form>


            </div>
        </div>
    </div>


    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script type="text/javascript" src="<?= base_url(); ?>/public/dist/js/pages/customer-land-sale.js"></script>

<?= $this->endSection(); ?>