<h2>Modyfikacja Użytkownika</h2>
<?php 
$atr = array(
	"class" => "form-horizontal",
	"role"  => "form");
$hid = array(
	"id"   => $dane["id"],
	"name" => $dane["name"]);
echo form_open('uzytkownicy/edytuj/',$atr,$hid); ?>

<fieldset>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Imię i Nazwisko</label>
	<div class="col-sm-6">
	<input class="form-control" name="name" AUTOCOMPLETE=OFF type="text" placeholder="Imię i Nazwisko" value="<?php echo (set_value('name') == false) ? $dane["name"] : set_value('name');?>">
		<?php echo form_error('name','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
</div>
</div>
<div class="form-group">
	<label for="login" class="col-sm-2 control-label">Login</label>
	<div class="col-sm-6">
	<p class="form-control-static"><?php echo $dane['login']; ?></p>
</div>
</div>
<div class="form-group">
	<label for="email" class="col-sm-2 control-label">E-mail</label>						
		<div class="col-sm-6">
			<input name="email" value="<?php echo (set_value('email') == false) ? $dane["email"] : set_value('email'); ?>" class="form-control"  AUTOCOMPLETE=OFF type="email"  placeholder="E-mail" value="">
				<?php echo form_error('email','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>
<div class="col-sm-8">
</div><div class="col-sm-8"></div><div class="col-sm-2">
<button type="submit" class="btn btn-primary">Zapisz</button>
</fieldset></form>
</div>