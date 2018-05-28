<h3>Modyfikacja zabezpieczenia zbioru danych</h3>

<strong>Legenda:</strong><br/>
<ul>
<li><strong>(1)</strong> nazwa zwyczajowa lub własna, np.: dane osobowe, dokumentacja ZFŚS,  baza klientów stałych,</li>
<li><strong>(2)</strong> np.: MySQL, Oracle, MS SQL, PostgreSQL, baza zewnętrza (outsourcing)</li>
<li><strong>(3)</strong> np.; (I) indywidualne hasło dostępu do bazy danych, (S) szyfrowanie danych, (F) wydzielona fizycznie sieć, (UPSB) – UPS bazy</li>
<li><strong>(4)</strong> (S) – serwerownia, (K) – miejsce przechowywania kopii bezpieczeństwa, (U) – pomieszczenia użytkowników, (PI) – pomieszczenie informatyka</li>
<li><strong>(5)</strong> (K) – kraty w oknach, (A) – alarm, (W) – wzmocnienie drzwi, (D) – dozór całodobowy, (KD) – kontrola dostępu, (KL) – klimatyzacja, (SP) – sygnalizacja PPOŻ, (GAS) –gaśnice, (ZP) – zamki patentowe,  (SF)- Sejf, (SO) – Sejf Ogniotrwały, (SK)- szafa zamykana na klucz, (UPS) – UPS stacji</li>
<p></p>
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					echo form_open("zbiory/edytuj_zab/".$id."/".$a."",$atr); ?>
<fieldset>
	<div class="form-group">
		<label for="data_do" class="col-sm-3 control-label">Nazwa zbioru danych (1)</label>
		<div class="col-sm-6">
		<p class="form-control-static"><strong><?php echo $nazwa_zbioru;?></strong></p>
		</div>
		</div>
<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Baza danych <a href="#" data-toggle="tooltip" title="np. mySQL, Oracle, MS SQL, PostgreSQL" rel="tooltip">(2)</a></label>
	<div class="col-sm-6">
	<input class="form-control" value="<?php echo @$zbiory["baza_danych"];?>" name="bazadanych" AUTOCOMPLETE=OFF type="text" placeholder="Baza danych">
	<?php echo form_error('bazadanych','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
	</div>
<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Zabezpieczenie Bazy <a href="#" data-toggle="tooltip" title="(I), (S), (F), (UPSB)" rel="tooltip">(3)</a></label>
	<div class="col-sm-6">
	<input class="form-control" name="zab_bazy" value="<?php echo @$zbiory["zab_bazy"];?>" AUTOCOMPLETE=OFF type="text" placeholder="Zabezpieczenie bazy">
	<?php echo form_error('zab_bazy','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
	</div>
<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Program służący do przetwarzania baz danych</label>
	<div class="col-sm-6">
	<input class="form-control" name="program" value="<?php echo @$zbiory["program"];?>" AUTOCOMPLETE=OFF type="text" placeholder="Program">
	<?php echo form_error('program','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
	</div>
<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Rejestracja w GIODO</label>
	<div class="col-sm-6">
	<select class="form-control" name="giodo">
		<?php if($zbiory["giodo"] == 0):?>
			<option value="0" selected>NIE</option>
			<option value="1">TAK</option>
		<?php else:?>
			<option value="0">NIE</option>
			<option value="1" selected>TAK</option>
		<?php endif;?>
	</select>
	</div>
	</div>
<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Lokalizacja <a href="#" data-toggle="tooltip" title="(S), (K), (U), (PI)" rel="tooltip">(4)</a></label>
	<div class="col-sm-6">
	<input class="form-control" value="<?php echo @$zbiory["lokalizacja"];?>" name="lokalizacja" AUTOCOMPLETE=OFF type="text" placeholder="Lokalizacja">
	<?php echo form_error('lokalizacja','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
	</div>
<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Nr pokoju, piętro</label>
	<div class="col-sm-6">
	<input class="form-control" name="pokoj_pietro" value="<?php echo @$zbiory["pokoj_pietro"];?>" AUTOCOMPLETE=OFF type="text" placeholder="Nr pokoju, piętro">
	<?php echo form_error('pokoj_pietro','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
	</div>
<div class="form-group">
	<label for="data_do" class="col-sm-3 control-label">Funkcja lokalizacji <a href="#" data-toggle="tooltip" title="(S), (K), (U), (PI)" rel="tooltip">(4)</a></label>
	<div class="col-sm-6">
	<input class="form-control" name="f_lokalizacji" value="<?php echo @$zbiory["f_lokalizacji"];?>" AUTOCOMPLETE=OFF type="text" placeholder="Funkcja lokalilzacji">
	<?php echo form_error('f_lokalizacji','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
	</div>
	<div class="form-group">
		<label for="data_do" class="col-sm-3 control-label">Zabezpieczenia fizyczne <a href="#" data-toggle="tooltip" title="(K), (A), (W), (D), (KD), (KL), (SP), (GAS), (ZP), (SF), (SO), (SK), (UPS)" rel="tooltip">(5)</a></label>
		<div class="col-sm-6">
		<input class="form-control" name="zab_fizyczne" value="<?php echo @$zbiory["zab_fizyczne"];?>" AUTOCOMPLETE=OFF type="text" placeholder="Zabezpieczenia fizyczne">
		<?php echo form_error('zab_fizyczne','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
		</div>
		</div>
		<div class="form-group">
			<label for="data_do" class="col-sm-3 control-label">Podstawa przetwarzania</label>
			<div class="col-sm-6">
			<textarea name="podstawa_prze" rows="3" class="form-control" placeholder="Podstawa przetwarzania"><?php echo @$zbiory["podstawa_prze"];?></textarea>
			<?php echo form_error('podstawa_prze','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
			</div>
			</div>
<div class="col-sm-3"></div>
<div class="col-sm-6">
<button type="submit" class="btn btn-primary">Zapisz</button>
</fieldset></form>
</div>