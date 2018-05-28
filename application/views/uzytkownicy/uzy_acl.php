<h2>Modyfikacja Uprawnień ACL</h2>
<?php 
$atr = array(
	"class" => "form-horizontal",
	"role"  => "form");
$hid = array(
	"id"   => $dane["id"],
	"name" => $dane["name"]);
echo form_open('uzytkownicy/acl/',$atr,$hid); ?>

<fieldset>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Imię i Nazwisko</label>
	<div class="col-sm-6">
	<p class="form-control-static"><?php echo $dane['name']; ?></p>
</div>
</div>
<div class="form-group">
	<label for="login" class="col-sm-2 control-label">Login</label>
	<div class="col-sm-6">
	<p class="form-control-static"><?php echo $dane['login']; ?></p>
</div>
</div>

<div class="form-group">
<label for="typ" class="col-sm-2 control-label">Uprawnienia</label>
				  <div class="col-sm-6">
<select class="form-control" id="name" name="typ">
		<option value="0" <?php echo ($dane["typ"] == 0) ? set_select('typ', '0', TRUE) : set_select('typ', '0'); ?> >Użytkownik</option>
		<option value="1" <?php echo ($dane["typ"] == 1) ? set_select('typ', '1', TRUE) : set_select('typ', '1'); ?> >ASI</option>
		<option value="2" <?php echo ($dane["typ"] == 2) ? set_select('typ', '2', TRUE) : set_select('typ', '2'); ?> >ASI + ABI</option>
	</select>
</div>
</div>
<div class="form-group">
<label for="zaklad" class="col-sm-2 control-label">Zakład pracy</label>
				  <div class="col-sm-6">

<select class="form-control" id="name" name="zaklad">
	<option value="0" <?php echo ($dane["zaklad"] == 0) ? set_select('zaklad', '0', TRUE) : set_select('zaklad','0'); ?>>Wszystkie</option>
<?php foreach ($zaklady as $item): ?>

<option value="<?php echo $item["id"];?>" <?php echo ($item["id"] == $dane["zaklad"]) ? set_select('zaklad', $item["id"], TRUE) : set_select('zaklad', $item["id"]); ?>><?php echo $item["nazwa_zakladu"]; ?></option>

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
<?php foreach ($szablon_acl as $item):?>
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
			<td style="text-align: center;"><input type="checkbox" value="O" name="acl<?php echo $item["id"];?>[]" id="acl<?php echo $item["id"];?>" <?php echo (@$acl[$item["modul"]] > 0) ? set_checkbox('acl'.$item['id'],'O', TRUE) : set_checkbox('acl'.$item['id'],'O'); ?>></td>
			<td style="text-align: center;"><input type="checkbox" value="W" name="acl<?php echo $item["id"];?>[]" id="acl<?php echo $item["id"];?>" <?php echo (@$acl[$item["modul"]] == 2) ? set_checkbox('acl'.$item['id'],'W', TRUE) : set_checkbox('acl'.$item['id'],'W'); ?>></td>
			<td style="text-align: center" ><input type="checkbox" id="sall<?php echo $item["id"];?>"></td>
			</tr>
<?php endforeach;?>		
</table></div>
<div class="col-sm-8">
</div><div class="col-sm-8"></div><div class="col-sm-2">
<button type="submit" class="btn btn-primary">Zapisz</button>
</fieldset></form>
</div>