<h2>Nowy raport pokontrolny</h2>
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					echo form_open('raporty/pokontrolny',$atr); ?>
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
	<label for="data_od" class="col-sm-3 control-label">Termin</label>
	<div class="col-sm-6">
	<input class="form-control" name="termin" AUTOCOMPLETE=OFF type="text" id="datepicker" placeholder="Termin">
	<?php echo form_error('termin','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>
<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Miejsce</label>
	<div class="col-sm-6">
	<input class="form-control" name="miejsce" AUTOCOMPLETE=OFF type="text" placeholder="Miejsce">
	<?php echo form_error('miejsce','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	
	</div>
</div>
<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Godzina rozpoczęcia</label>
	<div class="col-sm-6">
	<input class="form-control" name="godz_start" AUTOCOMPLETE=OFF type="text" placeholder="Godzina rozpoczęcia">
	</div>
</div>
<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Godzina zakończenia</label>
	<div class="col-sm-6">
	<input class="form-control" name="godz_stop" AUTOCOMPLETE=OFF type="text" placeholder="Godzina zakończenia">
	</div>
</div>
<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Kierownik kontrolowanego obszaru</label>
	<div class="col-sm-6">
	<input class="form-control" name="kier_kontrolowanego_ob" AUTOCOMPLETE=OFF type="text" placeholder="Kierownik...">
	<?php echo form_error('kier_kontrolowanego_ob','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	
	</div>
</div>
<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Osoby kontrolowane</label>
	<div class="col-sm-6">
	<textarea class="form-control" name="osoby_kontrolowane" rows="3" placeholder="Osoby kontrolowane..."></textarea>
	</div>
</div>
	<div class="form-group">
		<label for="data_do" class="col-sm-3 control-label">Obszar kontrolowany</label>
		<div class="col-sm-6">
		<textarea class="form-control" name="obszar_kontrolowany" rows="3" placeholder="Obszar kontrolowany..."></textarea>
		</div>
</div>
	<div class="form-group">
		<label for="data_do" class="col-sm-3 control-label">Kontrolerzy</label>
		<div class="col-sm-6">
		<textarea class="form-control" name="kontrolerzy" rows="3" placeholder="Kontrolerzy"></textarea>
		</div>
</div>
	<div class="form-group">
	 <label for="data_od" class="col-sm-3 control-label">Podstawa auditu</label>
	 <div class="col-sm-6">
	   <select class="form-control" name="podstawa" type="text" id="name">
		<option value="1">Planowana kontrola</option>
		<option value="2">Kontrola specjalna</option>
		<option value="3">Kontrola sprawdzająca</option>
		</select>
		</div>
	</div>
<h3>Zakres: Uchybienie / Spostrzeżenie (U1,U2,U3 lub S1,S2,S3)</h3>
<div class="form-group">
	<label for="uchybienie_1" class="col-sm-6 control-label">Przesłanki legalności przetwarzania danych osobowych zwykłych i wrażliwych</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_1" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_2" class="col-sm-6 control-label">Zakres i cel przetwarzania danych</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_2" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_3" class="col-sm-6 control-label">Merytoryczna poprawność danych i ich adekwatność do celu przetwarzania</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_3" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_4" class="col-sm-6 control-label">Obowiązek informacyjny (art. 24) dane osobowe zbierane od osoby, której dotyczą</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_4" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_5" class="col-sm-6 control-label">Obowiązek informacyjny (art. 25) dane osobowe zbierane nie od osoby, której dotyczą</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_5" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_6" class="col-sm-6 control-label">Zgłoszenie zbioru do rejestracji</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_6" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_7" class="col-sm-6 control-label">Przekazywanie danych do państwa trzeciego</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_7" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_8" class="col-sm-6 control-label">Powierzenie przetwarzania danych</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_8" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_9" class="col-sm-6 control-label">Zabezpieczenia organizacyjne</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_9" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_10" class="col-sm-6 control-label">Zabezpieczenia fizyczne</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_10" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_11" class="col-sm-6 control-label">Zabezpieczenia infrastruktury informatycznej (informatycznej i telekomunikacyjnej)</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_11" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_12" class="col-sm-6 control-label">Zabezpieczenia infrastruktury informatycznej (baz i aplikacji z danymi osobowymi)</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_12" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_13" class="col-sm-6 control-label">Wymagania dla systemów przetwarzających dane osobowe</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_13" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="form-group">
	<label for="uchybienie_14" class="col-sm-6 control-label">Zabezpieczenia osobowe</label>
	<div class="col-sm-4">
	<input class="form-control" name="uchybienie_14" AUTOCOMPLETE=OFF type="text" placeholder="">
	</div>
</div>
<div class="col-sm-6"></div>
<div class="col-sm-3">
<button type="submit" class="btn btn-primary">Zapisz</button>
</fieldset></form>
</div>