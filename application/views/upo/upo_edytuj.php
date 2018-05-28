<h2>Edycja upoważnienia: <u><?php echo $nazwisko_imie." (nr: ".$row['nr'].")";?></u></h2>
<?php 
$atr = array(
	"class" => "form-horizontal",
	"role"  => "form");
$hid = array(
		"uid" => $uid
	);
echo form_open('admin/upo_edytuj/'.$uid,$atr,$hid); ?>			
<fieldset>
<div class="form-group">
	<label for="data_od" class="col-sm-2 control-label">Data od</label>
	<div class="col-sm-6">
	<input class="form-control" name="od" AUTOCOMPLETE=OFF type="text" id="datepicker" placeholder="Od" value="<?php echo $row["data_od"];?>">
	</div>
</div>
<div class="form-group">
	<label for="data_do" class="col-sm-2 control-label">Data do</label>
	<div class="col-sm-6">
	<input class="form-control" name="do" AUTOCOMPLETE=OFF type="text" id="datepicker2" placeholder="Do" value="<?php echo $row["data_do"];?>">
	</div>
</div>
<div class="form-group">
	<label for="pracownik" class="col-sm-2 control-label">Pracownik</label>						
		<div class="col-sm-6">
	<select class="form-control" id="name" name="pracownik">
		<option value='<?php echo $id_prac;?>'><?php echo $nazwisko_imie.' [id: '.$id_prac.']';?></option>
	</select>
	</div>
</div>
<div class="form-group has-feedback">
<label for="miejsce" class="col-sm-2 control-label">Komórka organizacyjna</label>
				<script>
				  $(function() {
				   var availableTags = [
<?php foreach ($komorki as $item):?>
{ label: '<?php echo $item["nazwa"];?>'},
<?php endforeach;?>
];
				    $( "#tags" ).autocomplete({
				      source: availableTags
				    });
				  });
				  </script>
				  <div class="col-sm-6">
<input name="miejsce" class="form-control" type="text" id="tags" placeholder="Komórka organizacyjna..." value="<?php echo $row["miejsce"];?>"><i class="glyphicon glyphicon-chevron-down form-control-feedback"></i>
</div>
</div>
<h3>Dostęp:</h3>
<div class="col-sm-8">
<table border="1" class="table table-bordered">
	<thead><td><strong>System informatyczny</strong></td><td><strong>Login</strong></td>
		<td><strong>O</strong></td><td><strong>W</strong></td>
		<td><strong>M</strong></td><td><strong>U</strong></td>
		<td><strong>A</strong></td><td style="text-align: center"><strong>Wszystko</strong></td></thead>
<script>
$(function() {
	$('.td').click(function(e) {
	    var chk = $(this).closest("td").find("input:checkbox").get(0);
	    if(e.target != chk)
	    {
	        chk.checked = !chk.checked;
	    }
	});
});
</script>
<?php foreach ($z_si as $item):?>
<script>
		$(function() {
			    $('.sall<?php echo $item["id"];?>').click(function(e){
		        var c = $(this).closest('form').find('#si<?php echo $item["id"];?>:checkbox');
				  var chk = $(this).closest("td").find("input:checkbox").get(0);
		 	    if(e.target != chk)
		 	    {
		 	        chk.checked = !chk.checked;
		 	    }
		       if(chk.checked) {
		          c.prop('checked', true);
		        } else {
		          c.prop('checked', false);
		        }	 
		        });
			 	});
</script>
<tr class="ssall<?php echo $item["id"];?>">
	<td><?php echo $item["nazwa"];?></td>
	<td><input class="form-control" name="login<?php echo $item["id"];?>" value="<?php echo @$item["login"];?>" type="text" placeholder="Login"></td>
	<td style="text-align: center" class="td"><input type="checkbox" <?php echo @$item["O"];?> value="O" name="si<?php echo $item["id"];?>[]" id="si<?php echo $item["id"];?>"></td>
	<td style="text-align: center" class="td"><input type="checkbox" <?php echo @$item["W"];?> value="W" name="si<?php echo $item["id"];?>[]" id="si<?php echo $item["id"];?>"></td>
	<td style="text-align: center" class="td"><input type="checkbox" <?php echo @$item["M"];?> value="M" name="si<?php echo $item["id"];?>[]" id="si<?php echo $item["id"];?>"></td>
	<td style="text-align: center" class="td"><input type="checkbox" <?php echo @$item["U"];?> value="U" name="si<?php echo $item["id"];?>[]" id="si<?php echo $item["id"];?>"></td>
	<td style="text-align: center" class="td"><input type="checkbox" <?php echo @$item["A"];?> value="A" name="si<?php echo $item["id"];?>[]" id="si<?php echo $item["id"];?>"></td>
	<td class="sall<?php echo $item["id"];?>" style="text-align: center" ><input type="checkbox"></td>
	</tr>
<?php endforeach;?>		
</table></div>
<div class="col-sm-8">
<table border="1" class="table table-bordered">
<thead>
<tr>
<td><strong>Zbiory w wersji papierowej</strong></td>
<td style="text-align: center"><strong>O</strong></td>
<td style="text-align: center"><strong>W</strong></td>
<td style="text-align: center"><strong>M</strong></td>
<td style="text-align: center"><strong>U</strong></td>
<td style="text-align: center"><strong>A</strong></td>
<td style="text-align: center"><strong>Wszystko</strong>
</td>
</thead>
</tr>
<?php foreach ($z_zb as $item):?>
<script>
		$(function() {
			    $('.zall<?php echo $item["id"];?>').click(function(e){
		        var c = $(this).closest('form').find('#zb<?php echo $item["id"];?>:checkbox');
				  var chk = $(this).closest("td").find("input:checkbox").get(0);
		 	    if(e.target != chk)
		 	    {
		 	        chk.checked = !chk.checked;
		 	    }
		       if(chk.checked) {
		          c.prop('checked', true);
		        } else {
		          c.prop('checked', false);
		        }	 
		        });
			 	});
</script>
				</script><tr><td><?php echo $item["nazwa"];?></td>                                                   
			<td style="text-align: center" class="td"><input type="checkbox" <?php echo @$item["O"];?> value="O" name="zb<?php echo $item["id"];?>[]" id="zb<?php echo $item["id"];?>"></td>
			<td style="text-align: center" class="td"><input type="checkbox" <?php echo @$item["W"];?> value="W" name="zb<?php echo $item["id"];?>[]" id="zb<?php echo $item["id"];?>"></td>
			<td style="text-align: center" class="td"><input type="checkbox" <?php echo @$item["M"];?> value="M" name="zb<?php echo $item["id"];?>[]" id="zb<?php echo $item["id"];?>"></td>
			<td style="text-align: center" class="td"><input type="checkbox" <?php echo @$item["U"];?> value="U" name="zb<?php echo $item["id"];?>[]" id="zb<?php echo $item["id"];?>"></td>
			<td style="text-align: center" class="td"><input type="checkbox" <?php echo @$item["A"];?> value="A" name="zb<?php echo $item["id"];?>[]" id="zb<?php echo $item["id"];?>"></td>
			<td style="text-align: center" class="zall<?php echo $item["id"];?>"><input type="checkbox"></td>
			</tr>
<?php endforeach;?>
</table></div><div class="col-sm-8">*(O) Odczyt, (W) wprowadzania, (M) modyfikacji, (U) usuwania, (A) archiwizacji</div><div class="col-sm-2"><br/>
<button type="submit" class="btn btn-primary">Zapisz</button>
</fieldset></form>