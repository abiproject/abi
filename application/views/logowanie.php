<div style="margin-left: 10px; margin-top: 10px; min-width: 400px" class="jumbotron">
	<div style="margin-right: 30px; margin-top: 10px">
		<img style="width:150px; float:left;margin-right: 30px;"  class="img-thumbnail" src="<?php echo base_url("img/nowe_logo_min.png"); ?>"></div>
<h2><?php 
 	 
	 $kolor = array( 
	  0 => "#428bca",
	  1 => "#5cb85c",
	  2 => "#5bc0de",
	  3 => "#f0ad4e",
	  4 => "#d9534f");
	  
	  $rand = rand(0,4);
  ?><span style="color: <?php echo $kolor[$rand];?>;" class="glyphicon glyphicon-tint"></span>ABI Informatics</h2>
<?php 
$atr = array(
	"class" => "form-horizontal",
	"role"  => "form");
echo form_open('',$atr); ?>
	
    <fieldset>
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Użytkownik</label>
				<div class="col-sm-5">
            <input name="username" <?php if(set_value("username") == NULL) echo "autofocus"; ?> value="<?php echo set_value("username"); ?>" id="name" type="text" class="form-control" placeholder="Użytkownik">
			</div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Hasło</label>
				<div class="col-sm-5">
            <input name="password" <?php if(set_value("username") != NULL) echo "autofocus"; ?> id="password" type="password" class="form-control" placeholder="Hasło">
			</div>
        </div>
	<?php echo validation_errors(); ?>
	<?php if(isset($msg)) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$msg.'</div>'; ?>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
      <button type="submit" class="btn btn-primary">Zaloguj do systemu <span class="glyphicon glyphicon-arrow-right"></span></button>
    </div>
  </div>
</form>
</div>