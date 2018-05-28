<h2>Modyfikacja Zakładu Pracy</h2>
<?php 
$atr = array(
	"class" => "form-horizontal",
	"role"  => "form");
$hid = array(
	"id"   => $zaklad["id"]);
echo form_open('zaklady/edytuj/'.$zaklad["id"],$atr,$hid); ?>

<fieldset>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Nazwa zakładu</label>
	<div class="col-sm-6">
	<input class="form-control" name="nazwa_zakladu" AUTOCOMPLETE=OFF type="text" placeholder="Nazwa zakładu" value="<?php echo (set_value('nazwa_zakladu') == false) ? $zaklad["nazwa_zakladu"] : set_value('nazwa_zakladu');?>">
		<?php echo form_error('nazwa_zakladu','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label></div>'); ?>
</div>
</div>
<div class="form-group">
	<label for="email" class="col-sm-2 control-label">Miasto</label>						
		<div class="col-sm-6">
			<input name="miasto" value="<?php echo (set_value('miasto') == false) ? $zaklad["miasto"] : set_value('miasto'); ?>" class="form-control"  AUTOCOMPLETE=OFF type="text"  placeholder="Miasto">
				<?php echo form_error('miasto','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label></div>'); ?>
	</div></div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Adres</label>						
			<div class="col-sm-6">
				<input name="adres" value="<?php echo (set_value('adres') == false) ? $zaklad["adres"] : set_value('adres'); ?>" class="form-control"  AUTOCOMPLETE=OFF type="text"  placeholder="Adres">
					<?php echo form_error('adres','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label></div>'); ?>
		</div>
</div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">NIP</label>						
			<div class="col-sm-6">
				<input name="nip" value="<?php echo (set_value('nip') == false) ? $zaklad["nip"] : set_value('nip'); ?>" class="form-control"  AUTOCOMPLETE=OFF type="text"  placeholder="NIP">
					<?php echo form_error('nip','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label></div>'); ?>
		</div>
</div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">REGON</label>						
			<div class="col-sm-6">
				<input name="regon" value="<?php echo (set_value('regon') == false) ? $zaklad["regon"] : set_value('regon'); ?>" class="form-control"  AUTOCOMPLETE=OFF type="text"  placeholder="REGON">
					<?php echo form_error('regon','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label></div>'); ?>
		</div>
</div>


<div class="col-sm-8">
</div><div class="col-sm-8"></div><div class="col-sm-2">
<button type="submit" class="btn btn-primary">Zapisz</button>
</fieldset></form>
</div>