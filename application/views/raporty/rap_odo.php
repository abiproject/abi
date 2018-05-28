<h2>Nowy raport roczny ODO</h2>
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					echo form_open('raporty/roczny',$atr); ?>
<fieldset>
	<div class="form-group">
	 <label for="data_od" class="col-sm-3 control-label">Zakład pracy</label>
	 <div class="col-sm-6">
	   <select class="form-control" name="zaklad" type="text" id="name">
	<?php foreach($zaklady as $row):?>	
		<option value="<?php echo $row["id"];?>"><?php echo $row["nazwa_zakladu"];?></option>
	<?php endforeach;?>
		</select>
		</div>
	</div>
	<div class="form-group">
	<label for="data_od" class="col-sm-3 control-label">Termin przeprowadzenia przeglądu</label>
	<div class="col-sm-6">
	<input class="form-control" name="termin" AUTOCOMPLETE=OFF type="text" id="datepicker" placeholder="Termin">
	<?php echo form_error('termin','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>

<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Uczestnicy przeglądu</label>
	<div class="col-sm-6">
	<textarea class="form-control" name="uczestnicy" rows="3" placeholder="Uczestnicy przeglądu..."></textarea>
	<?php echo form_error('uczestnicy','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>
	<div class="form-group">
		<label for="data_do" class="col-sm-3 control-label">Zagadnienia omawiane na przeglądzie</label>
		<div class="col-sm-6">
		<textarea class="form-control" name="zagadnienia" rows="3" placeholder="Zagadnienia omawiane na przeglądzie..."></textarea>
	<?php echo form_error('zagadnienia','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
		</div>
</div>
	<div class="form-group">
		<label for="data_do" class="col-sm-3 control-label">Komentarze / uwagi</label>
		<div class="col-sm-6">
		<textarea class="form-control" name="uwagi" rows="3" placeholder="Uwagi..."></textarea>
		</div>
</div>
	<div class="form-group">
		<label for="data_do" class="col-sm-3 control-label">Podsumowanie realizacji zadań z poprzedniego przeglądu</label>
		<div class="col-sm-6">
		<textarea class="form-control" name="podsumowanie" rows="3" placeholder="Podsumowanie..."></textarea>
		</div>
</div>
	<div class="form-group">
		<label for="data_do" class="col-sm-3 control-label">Omówienie wyników kontroli przeprowadzonych</label>
		<div class="col-sm-6">
		<textarea class="form-control" name="omowienie" rows="3" placeholder="Omówienie wyników..."></textarea>
		</div>
</div>
<div class="form-group">
		<label for="data_do" class="col-sm-3 control-label">Omówienie zarejestrowanych incydentów oraz ilości i powodów ich wystąpienia</label>
		<div class="col-sm-6">
		<textarea class="form-control" name="omowienie_2" rows="3" placeholder="Omówienie wyników..."></textarea>
		</div>
</div>
	<div class="form-group">
		<label for="data_do" class="col-sm-3 control-label">Proponowane zadania do realizacji</label>
		<div class="col-sm-6">
		<textarea class="form-control" name="propozycje" rows="3" placeholder="Proponowane zadania do realizacji..."></textarea>
		</div>
</div>
<div class="col-sm-6"></div>
<div class="col-sm-3">
<button type="submit" class="btn btn-primary">Zapisz</button>
</fieldset></form>
</div>