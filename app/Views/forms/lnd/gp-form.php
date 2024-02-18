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
                                <h3 class="m-0">Land Gift Permission</h3>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">Land Gift Permission</li>
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
                <p style="outline: 0; border: 0; margin: 0; padding: 0; text-align: center; font-weight: 400; font-size: 11px;">SCHEDULE - 1</p>
                <p style="outline: 0; border: 0; margin: 0; padding: 0; text-align: center; font-weight: 500; font-size: 9px;" >(See Rule 3)</p>
                <p style="outline: 0; border: 0; margin: 0; padding: 0; text-align: center; font-weight: 600; font-size: 13px;">FORM OF APPLICATION UNDER SECTION 8 – B OF DAPVR, 1962</p>
                <p style="outline: 0; border: 0; margin: 0; padding: 0; text-align: center; font-weight: 700; font-size: 13px;">As amended by DAPVR (Amendment) Act – 1968</p>
                <p style="outline: 0; border: 0; margin: 0; padding: 0; text-align: center; font-weight: 900; font-size: 17px;">FOR GRANT OF PERMISSION FOR GIFT OF LAND</p>
                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger animation__shake"><?= $validation->listErrors(); ?></div>
                <?php endif; ?>
                <div class="row">
                    <div class="form-group col-sm-6">
                        To,<br />
                        The Collector,<br />
                        Land Section,<br />
                        Moti Daman
                    </div>
                </div>
                    <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;"><u>Subject: Application for grant of permission for GIFT OF LAND</u></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <p style="margin: 0; outline: 0; border: 0; padding: 0;">Sir,</p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <p style="margin: 0; outline: 0; border: 0; padding: 0; text-align: justify;">
                            I hereby apply for grant of permission for <strong>GIFT OF LAND</strong> for which details are given below :-
                        </p>
                    </div>
                </div>
                <?= form_open_multipart(); ?>
                <div class="table-responsive w3-animate-zoom opened">
                    <table class="table w3-table">
                        <thead></thead>
                        <tbody>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    1.
                                </td>
                                <td style="text-align: justify;">
                                    Full Name
                                </td>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <input type="text" name="fullName" value="<?= set_value('fullName'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" />
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    2.
                                </td>
                                <td style="text-align: justify;">
                                    House No. with Full Address
                                </td>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <input type="text" name="fullAddress" value="<?= set_value('fullAddress'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" />
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    3.
                                </td>
                                <td style="text-align: justify;">
                                    Ward No.
                                </td>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <input type="text" name="wardNo" value="<?= set_value('wardNo'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" />
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    4.
                                </td>
                                <td style="text-align: justify;">
                                    Village
                                </td>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if (!isset($villageList) || is_null($villageList) || empty($villageList)): ?>
                                            <input type="text" name="villageName" value="<?= set_value('villageName'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" />
                                        <?php else: ?>
                                            <select class="select form-control custom-select" name="villageName" style="min-width: 100%; width: 100%; max-width: 100%;">
                                                <?php $villageNameId = set_value("villageName");
                                                if (!isset($villageNameId) || is_null($villageNameId) || empty($villageNameId)):
                                                    ?>
                                                    <option selected="selected" disabled="disabled" value="0">Please Choose Village</option>
                                                <?php else: ?>
                                                    <option disabled="disabled" value="0">Please Choose Village</option>
                                                <?php endif; ?>
                                                <?php foreach ($villageList as $village): ?>
                                                    <?php if (set_value("villageName") == $village['id']): ?>
                                                        <option selected="selected" value="<?= $village['id']; ?>"><?= $village['villageName']; ?> - <?= $village['cityName']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $village['id']; ?>"><?= $village['villageName']; ?> - <?= $village['cityName']; ?></option>
                                                    <?php endif; ?>
                                            <?php endforeach; ?>
                                            </select>
<?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    5.
                                </td>
                                <td style="text-align: justify;">
                                    Panchayat / D.M.C.
                                </td>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php $panchayatdmc = set_value("panchayatdmc");
                                        if (!isset($panchayatdmc) || is_null($panchayatdmc) || empty($panchayatdmc)):
                                            ?>
                                            <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="panchayatdmc" value="Panchayat" />&nbsp;&nbsp;PANCHAYAT&nbsp;&nbsp;&nbsp;</label>
                                            <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="panchayatdmc" value="DMC" />&nbsp;&nbsp;D.M.C.&nbsp;&nbsp;&nbsp;</label>
                                        <?php else: ?>
                                            <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="panchayatdmc" value="Panchayat"<?= ($panchayatdmc == 'Panchayat') ? ' checked="checked"' : ''; ?> />&nbsp;&nbsp;PANCHAYAT&nbsp;&nbsp;&nbsp;</label>
                                            <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="panchayatdmc" value="DMC"<?= ($panchayatdmc == 'DMC') ? ' checked="checked"' : ''; ?> />&nbsp;&nbsp;D.M.C.&nbsp;&nbsp;&nbsp;</label>
<?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    6.
                                </td>
                                <td style="text-align: justify;">
                                    Connection Type
                                </td>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="conectiontype" value="NEW" />&nbsp;&nbsp;NEW&nbsp;&nbsp;&nbsp;</label>
                                        <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="conectiontype" value="OLD" />&nbsp;&nbsp;OLD&nbsp;&nbsp;&nbsp;</label>
                                        <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="conectiontype" value="RE-CONNECTION" />&nbsp;&nbsp;RE-CONNECTION&nbsp;&nbsp;&nbsp;</label>
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    7.
                                </td>
                                <td style="text-align: justify;">
                                    Receipt of last years House Tax Payment
                                </td>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php
                                        if (isset($filePath)) {
                                            echo('<input type="hidden" name="fileUrl" id="fileUrl" value="' . $filePath . '" /><a href="' . $filePath . '" target="_blank">VIEW </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="$(\'#fileUrl\').val(\'\');this.form.submit();"> X REMOVE</button>');
                                        } else {
                                            echo('<input type="hidden" name="filePath" value="pwd/new-water/" /> <input type="file" style="min-width: 100%; width: 100%; max-width: 100%;" name="file" value="' . set_value("file") . '" onchange="this.form.submit();" />');
                                        }
                                        ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    8.
                                </td>
                                <td style="text-align: justify;">
                                    House Ownership
                                </td>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="houseowner" value="OWNER" />&nbsp;&nbsp;OWNER&nbsp;&nbsp;&nbsp;</label>
                                        <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="houseowner" value="TENANT" />&nbsp;&nbsp;TENANT&nbsp;&nbsp;&nbsp;</label>
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    9.
                                </td>
                                <td style="text-align: justify;">
                                    Type of water connection
                                </td>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="connectioncategory" value="DOMESTIC" />&nbsp;&nbsp;DOMESTIC&nbsp;&nbsp;&nbsp;</label>
                                        <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="connectioncategory" value="NON-DOMESTIC" />&nbsp;&nbsp;NON-DOMESTIC&nbsp;&nbsp;&nbsp;</label>
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    10.
                                </td>
                                <td style="text-align: justify;">
                                    Diameter of service connection
                                </td>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <input type="number" name="diameter" value="<?= set_value('diameter'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" />
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    11.
                                </td>
                                <td style="text-align: justify;">
                                    Water Meter
                                </td>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <input type="text" name="waterMeter" value="<?= set_value('waterMeter'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" />
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <p style="margin: 0; outline: 0; border: 0; padding: 0; text-align: justify;">
                            <label><input type="checkbox" />&nbsp;&nbsp;&nbsp;I hereby give undertaking that the above information furnished by me are correct and true.</label>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" onclick="save_draft('<?= base_url(); ?>/service-list');" class="w3-button bg-orange w3-text-white w3-hover-orange" style="margin-right: 5px;"><span class="w3-text-white">Save as Draft</span></button>
                    <button type="button" onclick="window.location.href = '<?= base_url(); ?>/service-list';" class="w3-button w3-indigo w3-text-white w3-hover-indigo" style="margin-right: 5px;"><span class="w3-text-white">Close</span></button>
                    <input type="submit" class="w3-button bg-olive w3-hover-teal text-white w3-text-white" style="margin-right: 5px;" value="Submit Application" />
                </div>
<?= form_close(); ?>
            </div>
        </div>
    </div>


    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script type="text/javascript" src="<?= base_url(); ?>/public/dist/js/pages/lnd/gp-form.js"></script>

<?= $this->endSection(); ?>