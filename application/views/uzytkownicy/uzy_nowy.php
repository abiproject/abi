<h2>Nowy użytkownik</h2>
<script>
function generatePassword() {
    var password = generateRandomString(10);
    var slideDuration = 300;
    $("#random span.random_password").html(password);
    $("#password").val(password);
    if (!$("#random").is(":visible")) $("#random").stop(true, true).fadeIn({ duration: slideDuration, queue: false }).css('display', 'none').slideDown(slideDuration);
	 

    return false;
}
function generateRandomString(len) {
    var text = "";
    var possible = "0123456789abcdefghijk0123456789mnoprstuvwxyz0123456789";

    for( var i=0; i < len; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}
</script>
<?php 
$atr = array(
	"class" => "form-horizontal",
	"role"  => "form");
echo form_open('uzytkownicy/nowy',$atr); ?>
<fieldset>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Imię i Nazwisko</label>
	<div class="col-sm-6">
		
	<input class="form-control" name="name" AUTOCOMPLETE=OFF type="text" placeholder="Imię i Nazwisko" value="<?php echo set_value('name'); ?>">
	<?php echo form_error('name','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>
<div class="form-group">
	<label for="login" class="col-sm-2 control-label">Login</label>
	<div class="col-sm-6">
	<input class="form-control" name="login" value="<?php echo set_value('login'); ?>" AUTOCOMPLETE=OFF type="text" placeholder="Login">
	<?php echo form_error('login','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	
	</div>
</div>
<div class="form-group">
	<label for="haslo" class="col-sm-2 control-label">Hasło</label>
	<div class="col-sm-4">
	<input id="password" class="form-control" name="haslo" value="<?php echo set_value('haslo'); ?>" AUTOCOMPLETE=OFF type="password" placeholder="Hasło">
	<?php echo form_error('haslo','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
</div>
	<div class="col-sm-2">
	<button type="button" class="btn btn-default" onClick="return generatePassword(1)">Generuj hasło</button>
	</div>
</div>
<div id="random" class="alert alert-info" style="display: block; display:none;">
            <span class="random_password_header">Losowo wygenerowane hasło:</span>
            <br>
            <span class="random_password"></span>
            <br>
        </div>
<div class="form-group">
	<label for="email" class="col-sm-2 control-label">E-mail</label>						
		<div class="col-sm-6">
			<input name="email" value="<?php echo set_value('email'); ?>" class="form-control"  AUTOCOMPLETE=OFF type="email"  placeholder="E-mail" value="">
				<?php echo form_error('email','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>
<div class="form-group">
<label for="typ" class="col-sm-2 control-label">Uprawnienia</label>
				  <div class="col-sm-6">

	<select class="form-control" id="name" name="typ">
		<option value="0" <?php echo set_select('typ', '0'); ?>>Użytkownik</option>
		<option value="1" <?php echo set_select('typ', '1'); ?>>ASI</option>
		<option value="2" <?php echo set_select('typ', '2'); ?>>ASI + ABI</option>		
	</select>
</div>
</div>
<div class="form-group">
<label for="zaklad" class="col-sm-2 control-label">Zakład pracy</label>
				  <div class="col-sm-6">

	<select class="form-control" id="name" name="zaklad">
		<option value="0" <?php echo set_select('zaklad', '0'); ?>>Wszystkie</option>
<?php foreach ($zaklady as $item): ?>
		<option value="<?php echo $item["id"];?>" <?php echo set_select('zaklad', $item["id"]); ?>><?php echo $item["nazwa_zakladu"]; ?></option>
<?php endforeach;?>
	</select>
</div>
</div>
<h3>Dostęp - ACL:</h3>
<div class="col-sm-8">
<table border="1" class="table table-bordered">
	<thead>
		<td style="text-align: center;"><strong>ACL</strong></td>
		<td style="text-align: center;"><strong>Odczyt</strong></td>
		<td style="text-align: center;"><strong>Zapis</strong></td>
		<td style="text-align: center;"><strong>Wszystko</strong></td></thead>
<?php foreach ($acl as $item):?>
		<script>
		$(function() {
		    $('#sall<?php echo $item["id"];?>').change(function(){
		        var c = $(this).closest('form').find('#acl<?php echo $item["id"];?>:checkbox');
		        if($(this).prop('checked')) {
		          c.prop('checked', true);
		        } else {
		          c.prop('checked', false);
		        }});});
		</script>
			<tr><td><span rel="tooltip" title="<?php echo $item["opis"];?>"><?php echo $item["modul"];?></span></td>
			<td style="text-align: center;"><input type="checkbox" value="O" name="acl<?php echo $item["id"];?>[]" id="acl<?php echo $item["id"];?>" <?php echo set_checkbox('acl'.$item['id'],'O'); ?>></td>
			<td style="text-align: center;"><input type="checkbox" value="W" name="acl<?php echo $item["id"];?>[]" id="acl<?php echo $item["id"];?>" <?php echo set_checkbox('acl'.$item['id'],'W'); ?>></td>
			<td style="text-align: center" ><input type="checkbox" id="sall<?php echo $item["id"];?>"></td>
			</tr>
<?php endforeach;?>		
</table></div>
<div class="col-sm-8">
</div><div class="col-sm-8"></div><div class="col-sm-2">
<button type="submit" class="btn btn-primary">Dodaj użytkownika</button>
</fieldset></form>
</div>