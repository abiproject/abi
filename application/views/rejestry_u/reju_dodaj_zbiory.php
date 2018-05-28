<h3>Modyfikacja pozycji w rejestrze umów</h3>
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					echo form_open('rejestr_u/index/update/'.$id,$atr); 
				?>
 <fieldset>
<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Zakładu</label>
<div class="col-sm-6">
<input name="name" class="form-control" id="disabledInput" type="text" disabled value="<?php echo $row[0]->nazwa_zakladu;?>, <?php echo $row[0]->adres;?>, <?php echo $row[0]->miasto;?>">
</div>
</div>
<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Nazwa i adres firmy</label>
<div class="col-sm-6">
<input name="name" class="form-control" type="text" id="name" value="<?php echo $row[0]->nazwa_firmy;?>">
</div>
</div>
<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Cel przetwarzania danych</label>
<div class="col-sm-6">
<input name="name" class="form-control" type="text" id="name" value="<?php echo $row[0]->kategoria_danych;?>">
</div>
</div>

<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Data zawarcia</label>
<div class="col-sm-6">
<input name="name" class="form-control" type="text" AUTOCOMPLETE=OFF id="datepicker" value="<?php echo $row[0]->data_zawarcia;?>">
</div>
</div>

<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Data wygaśnięcia</label>
<div class="col-sm-6">
<input name="name" class="form-control" type="text" AUTOCOMPLETE=OFF id="datepicker2" value="<?php echo $row[0]->data_wygas;?>">
<?php if($row[0]->data_wygas == "0000-00-00"): ?>
<input type="checkbox" name="nieokreslony" id="nieokreslony" value="1" checked>
<?php else:?>
<input type="checkbox" name="nieokreslony" id="nieokreslony" value="0">
<?php endif;?>
Umowa na czas nieokreślony (data 0000-00-00 jest prawidłowa)
</div>
</div>


<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Umowa posiada</label>
<div class="col-sm-6"><select class="form-control" name="umowa_posiada">';
						<option 
					<?php if($row[0]->umowa_posiada == 1): ?>SELECTED<?php endif;?>
						value="1" >Umowę powierzenia poufności</option><option
					<?php if($row[0]->umowa_posiada == 2): ?>SELECTED<?php endif;?>
						value="2">Oświadczenie</option><option
					<?php if($row[0]->umowa_posiada == 3): ?>SELECTED<?php endif;?>
						value="3">Klauzulę</option><option
					<?php if($row[0]->umowa_posiada == 0): ?>SELECTED<?php endif;?>
						value="0">Nic</option></select>
</div>
</div>

<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Podstawa prawna</label>
<div class="col-sm-6">
<input name="name" class="form-control" type="text" id="name" value="<?php echo $row[0]->podstawa_prawna;?>">
</div>
</div>

<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Opis kategorii osób</label>
<div class="col-sm-6">
<input name="name" class="form-control" type="text" id="name" value="<?php echo $row[0]->opis_kat_osob;?>">
</div>
</div>

<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Zakres danych</label>
<div class="col-sm-6">
<input name="name" class="form-control" type="text" id="name" value="<?php echo $row[0]->zakres_danych_p;?>">
</div>
</div>

<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Sposób zbierania danych</label>
<div class="col-sm-6">
<input name="name" class="form-control" type="text" id="name" value="<?php echo $row[0]->sposob_zbierania_dan;?>">
</div>
</div>

<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Kategoria odbiorców</label>
<div class="col-sm-6">
<input name="name" class="form-control" type="text" id="name" value="<?php echo $row[0]->kat_odbiorcow;?>">
</div>
</div>

<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Ew. przekazywanie danych</label>
<div class="col-sm-6">
<input name="name" class="form-control" type="text" id="name" value="<?php echo $row[0]->ew_przek_danych;?>">
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-6">
	<button type="submit" class="btn btn-primary">Zapisz</button>
</div></div>
</fieldset>
</form>