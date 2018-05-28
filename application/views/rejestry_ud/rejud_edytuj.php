<h3>Modyfikacja pozycji w rejestrze udostępnień</h3>
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					$hid = array(
								"id_zaklad" => $row->id_zaklad,
								"id" => $id,
								"nazwa_firmy" => $row->nazwa_zakladu
							);
					echo form_open('rejestry_ud/edytuj/update/'.$id,$atr,$hid); 
				?>					
 <fieldset>
<div class="form-group">
<label for="zaklad" class="col-sm-2 control-label">Zakład</label>
<div class="col-sm-6">
<input name="zaklad" class="form-control" id="disabledInput" type="text" disabled value="<?php echo $row->nazwa_zakladu;?>, <?php echo $row->adres;?>, <?php echo $row->miasto;?>">
</div>
</div>
<div class="form-group">
<label for="nazwa_firmy" class="col-sm-2 control-label">Data udostępnienia</label>
<div class="col-sm-6">
<input name="data" class="form-control" type="text" AUTOCOMPLETE=OFF id="datepicker" value="<?php echo $row->data;?>">

</div>
</div>
<div class="form-group">
<label for="podmiot" class="col-sm-2 control-label">Podmiot</label>
<div class="col-sm-6">
<input name="podmiot" class="form-control" type="text" id="podmiot" value="<?php echo $row->podmiot;?>">
</div>
</div>

<div class="form-group">
<label for="podstawa_prawna" class="col-sm-2 control-label">Podstawa prawna</label>
<div class="col-sm-6">
<input name="podstawa_prawna" class="form-control" type="text" id="podstawa_prawna" value="<?php echo $row->podstawa_prawna;?>">
</div>
</div>

<div class="form-group">
<label for="zakres" class="col-sm-2 control-label">Zakres udostępnionych danych</label>
<div class="col-sm-6">
<input name="zakres" class="form-control" type="text" id="zakres" value="<?php echo $row->zakres;?>">
</div>
</div>

<div class="form-group">
<label for="dane_osobowe" class="col-sm-2 control-label">Dane osobowe</label>
<div class="col-sm-6">
<input name="dane_osobowe" class="form-control" type="text" id="dane_osobowe" value="<?php echo $row->dane_osobowe;?>">
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-6">
	<button type="submit" class="btn btn-primary">Zapisz</button>
</div></div>
</fieldset>
</form>