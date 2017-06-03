<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <script type="text/javascript" src="view/javascript/bbalogistics.bundle.js"></script>
  <link href="view/stylesheet/bbalogistics.bundle.css" type="text/css" rel="stylesheet"/>
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-bbishipping" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-weight" class="form-horizontal">
          <div class="row">
            <div class="col-sm-2">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#tab-api" data-toggle="tab"><?php echo $tab_api; ?></a></li>
                <li><a href="#tab-default" data-toggle="tab"><?php echo $tab_default; ?></a></li>
                <li><a href="#tab-warehouse" data-toggle="tab"><?php echo $tab_warehouse; ?></a></li>
              </ul>
            </div>
            <div class="col-sm-10">
              <div class="tab-content">
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-bbishipping-status"><?php echo $entry_status; ?></label>
                  <div class="col-sm-10">
                    <select name="bbishipping_status" id="input-bbishipping-status" class="form-control">
                      <?php if ($bbishipping_status) { ?>
                      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                      <option value="0"><?php echo $text_disabled; ?></option>
                      <?php } else { ?>
                      <option value="1"><?php echo $text_enabled; ?></option>
                      <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="tab-pane active" id="tab-api">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-username"><span data-toggle="tooltip" title="<?php echo $help_username; ?>"><?php echo $entry_username; ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="bbishipping_username" value="<?php echo $bbishipping_username; ?>" placeholder="<?php echo $entry_username; ?>" id="input-username" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-password"><span data-toggle="tooltip" title="<?php echo $help_password; ?>"><?php echo $entry_password; ?></label>
                    <div class="col-sm-10">
                        <input type="password" name="bbishipping_password" value="<?php echo $bbishipping_password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-appid"><span data-toggle="tooltip" title="<?php echo $help_appid; ?>"><?php echo $entry_appid; ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="bbishipping_appid" value="<?php echo $bbishipping_appid; ?>" placeholder="<?php echo $entry_appid; ?>" id="input-appid" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-secretkey"><span data-toggle="tooltip" title="<?php echo $help_secretkey; ?>"><?php echo $entry_secretkey; ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="bbishipping_secretkey" value="<?php echo $bbishipping_secretkey; ?>" placeholder="<?php echo $entry_secretkey; ?>" id="input-secretkey" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-authcode"><span data-toggle="tooltip" title="<?php echo $help_authcode; ?>"><?php echo $entry_authcode; ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="bbishipping_authcode" value="<?php echo $bbishipping_authcode; ?>" placeholder="<?php echo $entry_authcode; ?>" id="input-authcode" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab-default">
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-length"><span data-toggle="tooltip" title="<?php echo $help_length; ?>"><?php echo $entry_length; ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="bbishipping_length" value="<?php echo $bbishipping_length; ?>" placeholder="<?php echo $entry_length; ?>" id="input-length" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-width"><span data-toggle="tooltip" title="<?php echo $help_width; ?>"><?php echo $entry_width; ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="bbishipping_width" value="<?php echo $bbishipping_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-height"><span data-toggle="tooltip" title="<?php echo $help_height; ?>"><?php echo $entry_height; ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="bbishipping_height" value="<?php echo $bbishipping_height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-weight"><span data-toggle="tooltip" title="<?php echo $help_weight; ?>"><?php echo $entry_weight; ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="bbishipping_weight" value="<?php echo $bbishipping_weight; ?>" placeholder="<?php echo $entry_weight; ?>" id="input-weight" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab-warehouse">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-country"><?php echo $entry_country; ?></label>
                    <div class="col-sm-10">
                      <select name="bbishipping_country" id="input-country" class="form-control" style="width: 100%;">
                        <option value=""><?php echo $text_select;?></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-state"><?php echo $entry_state; ?></label>
                    <div class="col-sm-10">
                      <select name="bbishipping_state" id="input-state" class="form-control" style="width: 100%;">
                        <?php if (!empty($state)) {?>
                          <option value="<?php echo $state; ?>"></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-postcode"><?php echo $entry_postcode; ?></label>
                    <div class="col-sm-10">
                      <select name="bbishipping_postcode" id="input-postcode" class="form-control" style="width: 100%;">
                        <!--frd-->
                        <?php if (!empty($postcode)) {?>
                          <option value="<?php echo $postcode; ?>"></option>
                        <?php } ?>
                        <!---->
                      </select>
                    </div>
                  </div>

                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-city"><?php echo $entry_city; ?></label>
                    <div class="col-sm-10">
                      <select name="bbishipping_city" id="input-city" class="form-control" style="width: 100%;">
                        <!--frd-->
                        <?php if (!empty($city)) {?>
                          <option value="<?php echo $city; ?>"></option>
                        <?php } ?>
                        <!---->
                      </select>
                    </div>
                  </div>
                </div>

              </div>
              </div>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
var BBALogistics_Address_Field = BBALogistics_Address_Form.field();
var field = new BBALogistics_Address_Field( "#input-country", "#input-state", "#input-postcode", "#input-city" );
// To add initial values
<?php if (isset($bbishipping_country) && isset($bbishipping_postcode) && isset($bbishipping_city)) { ?>
  field.value({ country: "<?php echo $bbishipping_country;?>", state: "<?php echo $bbishipping_state;?>", postcode: "<?php echo $bbishipping_postcode;?>", city: "<?php echo $bbishipping_city;?>" });
<?php } ?>
var address = new BBALogistics_Address_Form( field );
    address.init({ ajaxUrl: "index.php?route=extension/shipping/bbishipping/addressapi&token=<?php echo $token;?>" });
</script>
<?php echo $footer; ?>
