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
                                <h3 class="m-0">Land Sale Permission</h3>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">Land Sale Permission</li>
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
                <p style="outline: 0; border: 0; margin: 0; padding: 0; text-align: center; font-weight: 900; font-size: 17px;">FOR GRANT OF PERMISSION FOR SALE OF LAND</p>
                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger animation__shake"><?= $validation->listErrors(); ?></div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success animation__shake"><?= $success; ?></div>
                <?php endif; ?>
                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger animation__shake"><?= $message; ?></div>
                <?php endif; ?>
                    
                <div class="row">
                    <div class="form-group col-sm-6">
                        To,<br />
                        The Collector,<br />
                        Land Section,<br />
                        Moti Daman
                    </div>
                </div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;"><u>Subject: Application for grant of permission for SALE OF LAND</u></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <p style="margin: 0; outline: 0; border: 0; padding: 0;">Sir,</p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <p style="margin: 0; outline: 0; border: 0; padding: 0; text-align: justify;">
                            I hereby apply for grant of permission for <strong>SALE OF LAND</strong> for which details are given below :-
                        </p>
                    </div>
                </div>
                <?= form_open_multipart(); ?>
                <input type="hidden" id="baseUrlTEC" name="baseUrlTEC" value="<?= ((set_value('baseUrlTEC')==false) ? (base_url()) : (set_value('baseUrlTEC'))); ?>" />
                <input type="hidden" id="stageIdTEC" name="stageIdTEC" value="<?= ((set_value('stageIdTEC')==false) ? ($stageIdTEC) : (set_value('stageIdTEC'))); ?>" />
                <input type="hidden" id="shamIdTEC" name="shamIdTEC" value="<?= ((set_value('shamIdTEC')==false) ? ($shamIdTEC) : (set_value('shamIdTEC'))); ?>" />
                <input type="hidden" id="soughtReportTEC" name="soughtReportTEC" value="<?= ((set_value('soughtReportTEC')==false) ? ($soughtReportTEC) : (set_value('soughtReportTEC'))); ?>" />
                <input type="hidden" id="applicantUserIdTEC" name="applicantUserIdTEC" value="<?= ((set_value('applicantUserIdTEC')==false) ? (session()->get('userId')) : (set_value('applicantUserIdTEC'))); ?>" />
                <div class="table-responsive w3-animate-zoom opened">
                    <table class="table w3-table">
                        <thead></thead>
                        <tbody>
                            <tr class="w3-hover-text-teal">
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 16px;">
                                        1.
                                    </p>
                                </th>
                                <th colspan="3" style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 16px;">
                                        Geographical division such as district / taluka of the land actual location
                                    </p>
                                </th>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        1.1
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        District / City of the Land Actual Location
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="cityName" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= $birthData['cityName']; ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <select class="select form-control custom-select" name="cityId" style="min-width: 100%; width: 100%; max-width: 100%;">
                                                <?php $cityId = ((set_value("cityId")==false) ? ($birthData['cityId']) : (set_value("cityId"))); if (!isset($cityId) || is_null($cityId) || empty($cityId)): ?>
                                                    <option selected="selected" disabled="disabled" value="0">Please Choose City</option>
                                                <?php else: ?>
                                                    <option disabled="disabled" value="0">Please Choose City</option>
                                                <?php endif; ?>
                                                <?php foreach ($cityList as $city): ?>
                                                    <?php if ($cityId == $city['id']): ?>
                                                        <option selected="selected" value="<?= $city['id']; ?>"><?= $city['cityName']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $city['id']; ?>"><?= $city['cityName']; ?></option>
                                                    <?php endif; ?>
                                            <?php endforeach; ?>
                                            </select>
                                        <?php else: ?>
                                            <?php if (!isset($cityList) || is_null($cityList) || empty($cityList)): ?>
                                            <input type="text" name="cityNameId" value="<?= set_value('cityNameId'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Your City" />
                                            <?php else: ?>
                                                <select class="select form-control custom-select" name="cityId" style="min-width: 100%; width: 100%; max-width: 100%;">
                                                    <?php $cityId = ((set_value("cityId")==false) ? ($birthData['cityId']) : (set_value("cityId"))); if (!isset($cityId) || is_null($cityId) || empty($cityId)): ?>
                                                        <option selected="selected" disabled="disabled" value="0">Please Choose City</option>
                                                    <?php else: ?>
                                                        <option disabled="disabled" value="0">Please Choose City</option>
                                                    <?php endif; ?>
                                                    <?php foreach ($cityList as $city): ?>
                                                        <?php if ($cityId == $city['id']): ?>
                                                            <option selected="selected" value="<?= $city['id']; ?>"><?= $city['cityName']; ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= $city['id']; ?>"><?= $city['cityName']; ?></option>
                                                        <?php endif; ?>
                                                <?php endforeach; ?>
                                                </select>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        1.2
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Taluka Area / Village of the Land Actual Location
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="villageName" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= $birthData['villageName']; ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <select class="select form-control custom-select" name="villageId" style="min-width: 100%; width: 100%; max-width: 100%;">
                                                <?php $villageId = ((set_value("villageId")==false) ? ($birthData['villageId']) : (set_value("villageId"))); if (!isset($villageId) || is_null($villageId) || empty($villageId)): ?>
                                                    <option selected="selected" disabled="disabled" value="0">Please Choose Village</option>
                                                <?php else: ?>
                                                    <option disabled="disabled" value="0">Please Choose Village</option>
                                                <?php endif; ?>
                                                <?php foreach ($villageList as $village): ?>
                                                    <?php if ($villageId == $village['id']): ?>
                                                        <option selected="selected" value="<?= $village['id']; ?>"><?= $village['villageName']; ?>, <?= $village['cityName']; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $village['id']; ?>"><?= $village['villageName']; ?>, <?= $village['cityName']; ?></option>
                                                    <?php endif; ?>
                                            <?php endforeach; ?>
                                            </select>
                                        <?php else: ?>
                                            <?php if (!isset($villageList) || is_null($villageList) || empty($villageList)): ?>
                                            <input type="text" name="villageNameId" value="<?= set_value('villageNameId'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Your Village" />
                                            <?php else: ?>
                                                <select class="select form-control custom-select" name="villageId" style="min-width: 100%; width: 100%; max-width: 100%;">
                                                    <?php $villageId = ((set_value("villageId")==false) ? ($birthData['villageId']) : (set_value("villageId"))); if (!isset($villageId) || is_null($villageId) || empty($villageId)): ?>
                                                        <option selected="selected" disabled="disabled" value="0">Please Choose Village</option>
                                                    <?php else: ?>
                                                        <option disabled="disabled" value="0">Please Choose Village</option>
                                                    <?php endif; ?>
                                                    <?php foreach ($villageList as $village): ?>
                                                        <?php if ($villageId == $village['id']): ?>
                                                            <option selected="selected" value="<?= $village['id']; ?>"><?= $village['villageName']; ?>, <?= $village['cityName']; ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= $village['id']; ?>"><?= $village['villageName']; ?>, <?= $village['cityName']; ?></option>
                                                        <?php endif; ?>
                                                <?php endforeach; ?>
                                                </select>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr><td colspan="4">&nbsp;</td><tr/>
                            <tr class="w3-hover-text-teal">
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 16px;">
                                        2.
                                    </p>
                                </th>
                                <th colspan="3" style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 16px;">
                                        Applicant personal detail(s)
                                    </p>
                                </th>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        2.1
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Full Name of the Applicant
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="name" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= $birthData['name']; ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <input type="text" name="name" value="<?= ((set_value('name')==false) ? ($birthData['name']) : (set_value('name'))); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Your Full Name" />
                                        <?php else: ?>
                                            <input type="text" name="name" value="<?= set_value('name'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Your Full Name" />
                                        <?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        2.2
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Full Postal Address of the Applicant
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="applicantFullAddress" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= ((set_value('applicantFullAddress')==false) ? ($birthData['applicantFullAddress']) : (set_value('applicantFullAddress'))); ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <textarea name="applicantFullAddress"  style="min-width: 100%; width: 100%; max-width: 100%; resize: none;" placeholder="Please Enter Full Address of the Dead" rows="3"><?= ((set_value('applicantFullAddress')==false) ? ($birthData['applicantFullAddress']) : (set_value('applicantFullAddress'))); ?></textarea>
                                        <?php else: ?>
                                            <textarea name="applicantFullAddress"  style="min-width: 100%; width: 100%; max-width: 100%; resize: none;" placeholder="Please Enter Full Address of the Dead" rows="3"><?= set_value('applicantFullAddress'); ?></textarea>
                                        <?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        2.3
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Applicant Cast Community If Any
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0): ?>
                                            <label class="label control-label w3-text-black" for="applicantCommunity" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                                <em>
                                                    : <?php
                                                        if ($birthData['applicantCommunity']==0) {
                                                            echo('GENERAL');
                                                        } else if ($birthData['applicantCommunity']==3) {
                                                            echo('ST');
                                                        } else if ($birthData['applicantCommunity']==5) {
                                                            echo('SC');
                                                        } else if ($birthData['applicantCommunity']==7) {
                                                            echo('OBC');
                                                        } else {
                                                            echo('NA');
                                                        }
                                                    ?>
                                                </em>
                                            </label>
                                        <?php else: ?>
                                            <?php $applicantCommunity = set_value("applicantCommunity");
                                            if (!isset($applicantCommunity) || is_null($applicantCommunity) || empty($applicantCommunity)):
                                                ?>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantCommunity" value="0" />&nbsp;&nbsp;GENERAL&nbsp;&nbsp;&nbsp;</label>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantCommunity" value="3" />&nbsp;&nbsp;ST&nbsp;&nbsp;&nbsp;</label>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantCommunity" value="5" />&nbsp;&nbsp;SC&nbsp;&nbsp;&nbsp;</label>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantCommunity" value="7" />&nbsp;&nbsp;OBC&nbsp;&nbsp;&nbsp;</label>
                                            <?php else: ?>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantCommunity" value="0"<?= ($applicantCommunity == '0') ? ' checked="checked"' : ''; ?> />&nbsp;&nbsp;GEENRAL&nbsp;&nbsp;&nbsp;</label>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantCommunity" value="3"<?= ($applicantCommunity == '3') ? ' checked="checked"' : ''; ?> />&nbsp;&nbsp;ST&nbsp;&nbsp;&nbsp;</label>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantCommunity" value="5"<?= ($applicantCommunity == '5') ? ' checked="checked"' : ''; ?> />&nbsp;&nbsp;SC&nbsp;&nbsp;&nbsp;</label>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantCommunity" value="7"<?= ($applicantCommunity == '7') ? ' checked="checked"' : ''; ?> />&nbsp;&nbsp;OBC&nbsp;&nbsp;&nbsp;</label>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        2.4
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Occupation of the Applicant
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="applicantOccupation" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= $birthData['applicantOccupation']; ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <input type="text" name="applicantOccupation" value="<?= ((set_value('applicantOccupation')==false) ? ($birthData['applicantOccupation']) : (set_value('applicantOccupation'))); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Your Occupation" />
                                        <?php else: ?>
                                            <input type="text" name="applicantOccupation" value="<?= set_value('applicantOccupation'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Your Occupation" />
                                        <?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr><td colspan="4">&nbsp;</td><tr/>
                            <tr class="w3-hover-text-teal">
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 16px;">
                                        3.
                                    </p>
                                </th>
                                <th colspan="3" style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 16px;">
                                        Land detail(s)
                                    </p>
                                </th>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        3.1
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Survey No. / Hissa No. of the Land
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="surveyHissaNo" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= $birthData['surveyHissaNo']; ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <input type="text" name="surveyHissaNo" value="<?= ((set_value('surveyHissaNo')==false) ? ($birthData['surveyHissaNo']) : (set_value('surveyHissaNo'))); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Land Survey / Hissa Number" />
                                        <?php else: ?>
                                            <input type="text" name="surveyHissaNo" value="<?= set_value('surveyHissaNo'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Land Survey / Hissa Number" />
                                        <?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        3.2
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Area of the Land ( in Sqr.Mtr. )
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="landAreaSqrMtr" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= $birthData['landAreaSqrMtr']; ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <input type="text" name="landAreaSqrMtr" value="<?= ((set_value('landAreaSqrMtr')==false) ? ($birthData['landAreaSqrMtr']) : (set_value('landAreaSqrMtr'))); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Land Area of Square Meter" step="0.0000001" />
                                        <?php else: ?>
                                            <input type="text" name="landAreaSqrMtr" value="<?= set_value('landAreaSqrMtr'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Land Area of Square Meter" step="0.0000001" />
                                        <?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        3.3
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Land Present Usage Purpose
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="landCurrentUsage" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= $birthData['landCurrentUsage']; ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <input type="text" name="landCurrentUsage" value="<?= ((set_value('landCurrentUsage')==false) ? ($birthData['landCurrentUsage']) : (set_value('landCurrentUsage'))); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Land Present Usage" />
                                        <?php else: ?>
                                            <input type="text" name="landCurrentUsage" value="<?= set_value('landCurrentUsage'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Land Present Usage" />
                                        <?php endif; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr><td colspan="4">&nbsp;</td><tr/>
                            <tr class="w3-hover-text-teal">
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 16px;">
                                        4.
                                    </p>
                                </th>
                                <th colspan="3" style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 16px;">
                                        Land Document Attachment(s)
                                    </p>
                                </th>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        4.1
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Form No. I
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <?php if ($readonly>0 && (!empty($birthData['naForm1']))): ?>
                                        <div style="outline: 0; border: 0; margin: 0; padding: 0;">
                                            <div class="w3-bar">
                                                <a class="w3-button bg-olive w3-ripple w3-hover-green btn-flat" target="_blank" href="<?= ((set_value('naForm1')==false) ? ($birthData['naForm1']) : (set_value('naForm1'))); ?>"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Uploaded File</a>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                    <input type="hidden" id="fromNoIUrl" name="fromNoIUrl" />
                                    <input type="hidden" id="fromNoIUrlPath" value="lnd/sp/" />
                                    <input type="file" id="fromNoIUrlAtt" style="display: none;" onchange="uploadFormNoI();" />
                                    <div style="outline: 0; border: 0; margin: 0; padding: 0;" id="formNoIpView" class="w3-hide hide">
                                        <div class="w3-bar">
                                            <a class="w3-button bg-olive w3-ripple w3-hover-green btn-flat" target="_blank" id="formNoIpViewBtn" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Uploaded File</a>
                                            <button class="w3-button bg-danger w3-ripple btn-flat w3-hover-text-white" onclick="$('#fromNoIUrlAtt').val(''); $('#fromNoIUrl').val(''); $('#formNoIpView').addClass('w3-hide'); $('#formNoIpView').addClass('hide'); $('#formNoIpAttach').removeClass('w3-hide'); $('#formNoIpAttach').removeClass('hide');"><i class="fa fa-trash"></i> Remove</button>
                                        </div>
                                    </div>
                                    <div style="outline: 0; border: 0; margin: 0; padding: 0;" id="formNoIpAttach">
                                        <a class="w3-button bg-orange btn-flat w3-ripple w3-hover-orange w3-hover-text-white" id="formNoIpAttachBtn"><i class="fa fa-paperclip"></i>&nbsp;&nbsp;Attach File</a>
                                    </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        4.2
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Form No. XIV
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <?php if ($readonly>0 && (!empty($birthData['naForm16']))): ?>
                                        <div style="outline: 0; border: 0; margin: 0; padding: 0;">
                                            <div class="w3-bar">
                                                <a class="w3-button bg-olive w3-ripple w3-hover-green btn-flat" target="_blank" href="<?= ((set_value('naForm16')==false) ? ($birthData['naForm16']) : (set_value('naForm16'))); ?>"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Uploaded File</a>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                    <input type="hidden" id="fromNoXIVUrl" name="fromNoXIVUrl" />
                                    <input type="hidden" id="fromNoXIVUrlPath" value="lnd/sp/" />
                                    <input type="file" id="fromNoXIVUrlAtt" style="display: none;" onchange="uploadFormNoXIV();" />
                                    <div style="outline: 0; border: 0; margin: 0; padding: 0;" id="formNoXIVpView" class="w3-hide hide">
                                        <div class="w3-bar">
                                            <a class="w3-button bg-olive w3-ripple w3-hover-green btn-flat" target="_blank" id="formNoXIVpViewBtn" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Uploaded File</a>
                                            <button class="w3-button bg-danger w3-ripple btn-flat w3-hover-text-white" onclick="$('#fromNoXIVUrlAtt').val(''); $('#fromNoXIVUrl').val(''); $('#formNoXIVpView').addClass('w3-hide'); $('#formNoXIVpView').addClass('hide'); $('#formNoXIVpAttach').removeClass('w3-hide'); $('#formNoXIVpAttach').removeClass('hide');"><i class="fa fa-trash"></i> Remove</button>
                                        </div>
                                    </div>
                                    <div style="outline: 0; border: 0; margin: 0; padding: 0;" id="formNoXIVpAttach">
                                        <a class="w3-button bg-orange btn-flat w3-ripple w3-hover-orange w3-hover-text-white" id="formNoXIVpAttachBtn"><i class="fa fa-paperclip"></i>&nbsp;&nbsp;Attach File</a>
                                    </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        4.3
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Land Site Plan
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <?php if ($readonly>0 && (!empty($birthData['naSitePlan']))): ?>
                                        <div style="outline: 0; border: 0; margin: 0; padding: 0;">
                                            <div class="w3-bar">
                                                <a class="w3-button bg-olive w3-ripple w3-hover-green btn-flat" target="_blank" href="<?= ((set_value('naSitePlan')==false) ? ($birthData['naSitePlan']) : (set_value('naSitePlan'))); ?>"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Uploaded File</a>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                    <input type="hidden" id="landSitePlanUrl" name="landSitePlanUrl" />
                                    <input type="hidden" id="landSitePlanUrlPath" value="lnd/sp/" />
                                    <input type="file" id="landSitePlanUrlAtt" style="display: none;" onchange="uploadLandSitePlan();" />
                                    <div style="outline: 0; border: 0; margin: 0; padding: 0;" id="landSitePlanpView" class="w3-hide hide">
                                        <div class="w3-bar">
                                            <a class="w3-button bg-olive w3-ripple w3-hover-green btn-flat" target="_blank" id="landSitePlanpViewBtn" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Uploaded File</a>
                                            <button class="w3-button bg-danger w3-ripple btn-flat w3-hover-text-white" onclick="$('#landSitePlanUrlAtt').val(''); $('#landSitePlanUrl').val(''); $('#landSitePlanpView').addClass('w3-hide'); $('#landSitePlanpView').addClass('hide'); $('#landSitePlanpAttach').removeClass('w3-hide'); $('#landSitePlanpAttach').removeClass('hide');"><i class="fa fa-trash"></i> Remove</button>
                                        </div>
                                    </div>
                                    <div style="outline: 0; border: 0; margin: 0; padding: 0;" id="landSitePlanpAttach">
                                        <a class="w3-button bg-orange btn-flat w3-ripple w3-hover-orange w3-hover-text-white" id="landSitePlanpAttachBtn"><i class="fa fa-paperclip"></i>&nbsp;&nbsp;Attach File</a>
                                    </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr><td colspan="4">&nbsp;</td><tr/>
                            <tr class="w3-hover-text-teal">
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 16px;">
                                        5.
                                    </p>
                                </th>
                                <th colspan="3" style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 16px;">
                                        Declaration
                                    </p>
                                </th>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        5.1
                                    </p>
                                </th>
                                <th colspan="2" style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        <?php if ($readonly>0): ?>
                                            <label><input type="checkbox" name="acceptTerms" value="1" checked="checked" disabled="disabled" />&nbsp;&nbsp;&nbsp;I hereby give undertaking that the above information furnished by me are correct and true.</label>
                                        <?php else: ?>
                                            <label><input type="checkbox" name="acceptTerms" value="1" />&nbsp;&nbsp;&nbsp;I hereby give undertaking that the above information furnished by me are correct and true.</label>
                                        <?php endif; ?>
                                    </p>
                                </th>
                            </tr>
                            <tr class="w3-hover-pale-yellow">
                                <td style="text-align: left; width: 49px;">
                                    &nbsp;
                                </td>
                                <th style="text-align: left; width: 49px;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        5.2
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Applicant Signature
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <?php if ($readonly>0 && (!empty($birthData['applicantSignatureUrl']))): ?>
                                        <div style="outline: 0; border: 0; margin: 0; padding: 0;">
                                            <div class="w3-bar">
                                                <a class="w3-button bg-olive w3-ripple w3-hover-green btn-flat" target="_blank" href="<?= ((set_value('applicantSignatureUrl')==false) ? ($birthData['applicantSignatureUrl']) : (set_value('applicantSignatureUrl'))); ?>"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Uploaded File</a>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                    <input type="hidden" id="signatureUrl" name="signatureUrl" />
                                    <input type="hidden" id="signatureUrlPath" value="lnd/sp/" />
                                    <input type="file" id="signatureUrlAtt" style="display: none;" onchange="uploadSignature();" />
                                    <div style="outline: 0; border: 0; margin: 0; padding: 0;" id="signaturepView" class="w3-hide hide">
                                        <div class="w3-bar">
                                            <a class="w3-button bg-olive w3-ripple w3-hover-green btn-flat" target="_blank" id="signaturepViewBtn" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Uploaded File</a>
                                            <button class="w3-button bg-danger w3-ripple btn-flat w3-hover-text-white" onclick="$('#signatureUrlAtt').val(''); $('#signatureUrl').val(''); $('#signaturepView').addClass('w3-hide'); $('#signaturepView').addClass('hide'); $('#signaturepAttach').removeClass('w3-hide'); $('#signaturepAttach').removeClass('hide');"><i class="fa fa-trash"></i> Remove</button>
                                        </div>
                                    </div>
                                    <div style="outline: 0; border: 0; margin: 0; padding: 0;" id="signaturepAttach">
                                        <a class="w3-button bg-orange btn-flat w3-ripple w3-hover-orange w3-hover-text-white" id="signaturepAttachBtn"><i class="fa fa-paperclip"></i>&nbsp;&nbsp;Attach File</a>
                                    </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
                <?php if ($readonly<=0): ?>
                <div class="form-group">
                    <button type="submit" name="saveDraft" value="0" class="w3-button bg-orange w3-text-white w3-hover-orange" style="margin-right: 5px;"><span class="w3-text-white">Save as Draft</span></button>
                    <a href="<?= base_url(); ?>/dashboard" class="w3-button w3-indigo w3-text-white w3-hover-indigo" style="margin-right: 5px;"><span class="w3-text-white">Discard & Close</span></a>
                    <button type="submit" name="submit" value="1" class="w3-button bg-olive w3-hover-teal text-white w3-text-white" style="margin-right: 5px;"><span class="w3-text-white">Submit Application</span></button>
                </div>
                <?php endif; ?>
                <?php if ($readonly>0): ?>
                <div class="form-group">
                    <a href="<?= base_url(); ?>/dashboard" class="w3-button w3-indigo w3-text-white w3-hover-indigo" style="margin-right: 5px;"><span class="w3-text-white">Close & Back</span></a>
                </div>
                <?php endif; ?>
            <?= form_close(); ?>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script type="text/javascript" src="<?= base_url(); ?>/public/dist/js/pages/lnd/sp-form.js"></script>

<?= $this->endSection(); ?>