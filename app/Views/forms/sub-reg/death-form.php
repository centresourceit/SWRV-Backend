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
                                <h3 class="m-0">Death Registration</h3>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">Death Registration</li>
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
                        The Sub Registrar,<br />
                        Public Birth / Death Department,<br />
                        Moti Daman.
                    </div>
                </div>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;"><u>Subject: Application for GRANT OF DEATH CERTIFICATE</u></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <p style="margin: 0; outline: 0; border: 0; padding: 0;">Sir,</p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <p style="margin: 0; outline: 0; border: 0; padding: 0; text-align: justify;">
                            I hereby apply for grant of <strong>DEATH CERTIFICATE</strong> for which details are given below :-
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
                                        Event details of the death
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
                                        District / Taluka of Death
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
                                        Date of Death
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="dateOfDeath" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= $birthData['dateOfDeath']; ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <input type="date" name="dateOfDeath" value="<?= ((set_value('dateOfDeath')==false) ? ($birthData['dateOfDeath']) : (set_value('dateOfDeath'))); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Date Of Death" />
                                        <?php else: ?>
                                            <input type="date" name="dateOfDeath" value="<?= set_value('dateOfDeath'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Date Of Death" />
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
                                        1.3
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Place of Death
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="placeOfDeath" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= $birthData['placeOfDeath']; ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <input type="text" name="placeOfDeath" value="<?= ((set_value('placeOfDeath')==false) ? ($birthData['placeOfDeath']) : (set_value('placeOfDeath'))); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Place of Death" />
                                        <?php else: ?>
                                            <input type="text" name="placeOfDeath" value="<?= set_value('placeOfDeath'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Place of Death" />
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
                                        Dead's personal detail(s)
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
                                        Full Name of the Dead
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
                                            <input type="text" name="name" value="<?= ((set_value('name')==false) ? ($birthData['name']) : (set_value('name'))); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Full Name of the Dead" />
                                        <?php else: ?>
                                            <input type="text" name="name" value="<?= set_value('name'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Full Name of the Dead" />
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
                                        Full Mother Name of the Dead
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="applicantMotherFullName" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= $birthData['fatherName']; ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <input type="text" name="applicantMotherFullName" value="<?= ((set_value('applicantMotherFullName')==false) ? ($birthData['applicantMotherFullName']) : (set_value('applicantMotherFullName'))); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Full Mother Name of the Dead" />
                                        <?php else: ?>
                                            <input type="text" name="applicantMotherFullName" value="<?= set_value('applicantMotherFullName'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Full Mother Name of the Dead" />
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
                                        Full Father Name of the Dead
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="fatherName" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= $birthData['fatherName']; ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <input type="text" name="fatherName" value="<?= ((set_value('fatherName')==false) ? ($birthData['fatherName']) : (set_value('fatherName'))); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Full Father Name of the Dead" />
                                        <?php else: ?>
                                            <input type="text" name="fatherName" value="<?= set_value('fatherName'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Full Father Name of the Dead" />
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
                                        Full Spouse Name of the Dead
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0 && $isDataPresent): ?>
                                        <label class="label control-label w3-text-black" for="spouseFullName" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                            <em>
                                                : <?= $birthData['spouseFullName']; ?>
                                            </em>
                                        </label>
                                        <?php elseif ($readonly<=0 && $isDataPresent): ?>
                                            <input type="text" name="spouseFullName" value="<?= ((set_value('spouseFullName')==false) ? ($birthData['spouseFullName']) : (set_value('spouseFullName'))); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Full Spouse Name of the Dead" />
                                        <?php else: ?>
                                            <input type="text" name="spouseFullName" value="<?= set_value('spouseFullName'); ?>" style="min-width: 100%; width: 100%; max-width: 100%;" placeholder="Please Enter Full Spouse Name of the Dead" />
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
                                        2.5
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Full Postal Address of the Dead
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
                                        2.6
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Aadhaar of the Dead
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <?php if ($readonly>0): ?>
                                        <div style="outline: 0; border: 0; margin: 0; padding: 0;" id="applicantImgUrlpView">
                                            <div class="w3-bar">
                                                <a class="w3-button bg-olive w3-ripple w3-hover-green btn-flat" target="_blank" id="applicantImgUrlpViewBtn" href="<?= ((set_value('applicantImgUrl')==false) ? ($birthData['applicantImgUrl']) : (set_value('applicantImgUrl'))); ?>"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Uploaded File</a>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <input type="hidden" id="applicantImgUrl" name="applicantImgUrl" />
                                        <input type="hidden" id="applicantImgUrlPath" value="sub-reg/death/" />
                                        <input type="file" id="applicantImgUrlAtt" style="display: none;" onchange="uploadapplicantImgUrl();" />
                                        <div style="outline: 0; border: 0; margin: 0; padding: 0;" id="applicantImgUrlpView" class="w3-hide hide">
                                            <div class="w3-bar">
                                                <a class="w3-button bg-olive w3-ripple w3-hover-green btn-flat" target="_blank" id="applicantImgUrlpViewBtn" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Uploaded File</a>
                                                <button class="w3-button bg-danger w3-ripple btn-flat w3-hover-text-white" onclick="$('#applicantImgUrlAtt').val(''); $('#applicantImgUrl').val(''); $('#applicantImgUrlpView').addClass('w3-hide'); $('#applicantImgUrlpView').addClass('hide'); $('#applicantImgUrlpAttach').removeClass('w3-hide'); $('#applicantImgUrlpAttach').removeClass('hide');"><i class="fa fa-trash"></i> Remove</button>
                                            </div>
                                        </div>
                                        <div style="outline: 0; border: 0; margin: 0; padding: 0;" id="applicantImgUrlpAttach">
                                            <a class="w3-button bg-orange btn-flat w3-ripple w3-hover-orange w3-hover-text-white" id="applicantImgUrlpAttachBtn"><i class="fa fa-paperclip"></i>&nbsp;&nbsp;Attach File</a>
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
                                        2.7
                                    </p>
                                </th>
                                <th style="text-align: justify;">
                                    <p style="outline: 0; border: 0; margin: 0; padding: 0; font-size: 14px;">
                                        Gender of the Dead
                                    </p>
                                </th>
                                <td style="text-align: left; min-width: 50%; width: 50%; max-width: 50%;">
                                    <p style="margin: 0; outline: 0; border: 0; padding: 0;">
                                        <?php if ($readonly>0): ?>
                                            <label class="label control-label w3-text-black" for="applicantGender" style="margin: 0; outline: 0; border: 0; padding: 0; font-size: 17px; text-align: justify-all; font-weight: 700;">
                                                <em>
                                                    : <?php
                                                        if ($birthData['applicantGender']==0) {
                                                            echo('NA');
                                                        } else if ($birthData['applicantGender']==1) {
                                                            echo('MALE');
                                                        } else if ($birthData['applicantGender']==2) {
                                                            echo('FEMALE');
                                                        } else if ($birthData['applicantGender']==3) {
                                                            echo('TRANSGENDER');
                                                        } else {
                                                            echo('NA');
                                                        }
                                                    ?>
                                                </em>
                                            </label>
                                        <?php else: ?>
                                            <?php $applicantGender = set_value("applicantGender");
                                            if (!isset($applicantGender) || is_null($applicantGender) || empty($applicantGender)):
                                                ?>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantGender" value="1" />&nbsp;&nbsp;MALE&nbsp;&nbsp;&nbsp;</label>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantGender" value="2" />&nbsp;&nbsp;FEMALE&nbsp;&nbsp;&nbsp;</label>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantGender" value="3" />&nbsp;&nbsp;TRANSGENDER&nbsp;&nbsp;&nbsp;</label>
                                            <?php else: ?>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantGender" value="1"<?= ($applicantGender == '1') ? ' checked="checked"' : ''; ?> />&nbsp;&nbsp;MALE&nbsp;&nbsp;&nbsp;</label>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantGender" value="2"<?= ($applicantGender == '2') ? ' checked="checked"' : ''; ?> />&nbsp;&nbsp;FEMALE&nbsp;&nbsp;&nbsp;</label>
                                                <label>&nbsp;&nbsp;&nbsp;<input type="radio" name="applicantGender" value="3"<?= ($applicantGender == '3') ? ' checked="checked"' : ''; ?> />&nbsp;&nbsp;TRANSGENDER&nbsp;&nbsp;&nbsp;</label>
                                            <?php endif; ?>
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
                                        3.1
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
<script type="text/javascript" src="<?= base_url(); ?>/public/dist/js/pages/sub-reg/death-form.js"></script>

<?= $this->endSection(); ?>