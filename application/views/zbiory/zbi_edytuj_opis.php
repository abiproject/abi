<h3>Modyfikacja opisu zbioru</h3>
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					$hid = array(
								"id_zaklad" => $dane->id_zaklad,
								"id_zbior" => $dane->id
							);
						
					echo form_open('zbiory/edit_opis/'.$id.'/'.$a,$atr,$hid); 
				?>					
 <fieldset>
<h4>Zbiór: <?= $dane->nazwa; ?></h4>
<div class="form-group">
<label for="opis_kat_osob" class="col-sm-2 control-label">Opis kategorii osób</label>
<div class="col-sm-6">
<input name="opis_kat_osob" class="form-control" type="text" id="name" value="<?= $dane->opis_kat_osob;?>">
</div>
</div>

<div class="form-group">
<label for="sposob_zbierania_dan" class="col-sm-2 control-label">Sposób zbierania danych</label>
<div class="col-sm-6">
<input name="sposob_zbierania_dan" class="form-control" type="text" id="name" value="<?= $dane->sposob_zbierania_dan;?>">
</div>
</div>

<div class="form-group">
<label for="kat_odbiorcow" class="col-sm-2 control-label">Kategoria odbiorców</label>
<div class="col-sm-6">
<input name="kat_odbiorcow" class="form-control" type="text" id="name" value="<?= $dane->kat_odbiorcow;?>">
</div>
</div>

<div class="form-group">
<label for="ew_przekaz_danych" class="col-sm-2 control-label">Ew. przekazywanie danych do państw trzecich</label>
<div class="col-sm-6">
<input name="ew_przekaz_danych" class="form-control" type="text" id="name" value="<?= $dane->ew_przekaz_danych;?>">
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-6">
	<button type="submit" class="btn btn-primary">Zapisz</button>
</div></div>
</fieldset>
</form>