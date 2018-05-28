<h2>Zgłoszenie powołania ABI do rejestracji GIODO</h2>
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					echo form_open('zaklady/abi_dodaj/'.$id,$atr); ?>
<fieldset>
	<legend>Część A. Oznaczenie administratora danych</legend>
	Nazwa administratora danych i adres jego siedziby albo nazwisko, imię i adres miejsca zamieszkania
	administratora danych oraz nr REGON − jeżeli został nadany.<br/><br/>
	
	<div class="form-group">
	 <label class="col-sm-3 control-label">Administrator</label>
	 <div class="col-sm-6">
  	<p class="form-control-static"><?= $zaklad[0]["nazwa_zakladu"];?></p>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-3 control-label">Regon</label>
	<div class="col-sm-6">
	<p class="form-control-static"><?= $zaklad[0]["regon"];?></p>
</div>
</div>

	<div class="form-group">
	<label class="col-sm-3 control-label">Ulica</label>
	<div class="col-sm-6">
	<p class="form-control-static"><?= $zaklad[0]["adres"];?></p>	</div>
</div>

	<div class="form-group">
	<label class="col-sm-3 control-label">Nr domu / Nr lokalu</label>
	<div class="col-sm-3">
	<p class="form-control-static"><?= $zaklad[0]["nr_domu"];?></p>	</div>
	<div class="col-sm-3">
	<p class="form-control-static"><?= @$zaklad[0]["nr_lokalu"];?></p>	</div>
</div>

	<div class="form-group">
	<label class="col-sm-3 control-label">Kod pocztowy / Miejscowość</label>
	<div class="col-sm-2">
	<p class="form-control-static"><?= $zaklad[0]["kod_pocztowy"];?></p>	</div>
	<div class="col-sm-4">
	<p class="form-control-static"><?= $zaklad[0]["miasto"];?></p>	</div>
</div>


<legend>Część B. Dane osobowe administratora bezpieczeństwa informacji i data jego powołania </legend>

	<div class="form-group">
	<label class="col-sm-3 control-label">Imię i nazwisko</label>
	<div class="col-sm-6">
	<input class="form-control" name="imie_nazwisko" AUTOCOMPLETE=OFF type="text" placeholder="Imię i nazwisko">
	<?php echo form_error('imie_nazwisko','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>
Numer PESEL lub, gdy ten numer nie został nadany, nazwa i seria/nr dokumentu stwierdzającego tożsamość:<br/><br/>
	<div class="form-group">
	<label class="col-sm-3 control-label">PESEL</label>
	<div class="col-sm-6">
	<input class="form-control" name="pesel" AUTOCOMPLETE=OFF type="text" placeholder="PESEL">
	<?php echo form_error('pesel','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>

	<div class="form-group">
	<label class="col-sm-3 control-label">Nazwa dokumentu tożsamości</label>
	<div class="col-sm-6">
	<input class="form-control" name="nazwa_dok" AUTOCOMPLETE=OFF type="text" placeholder="Nazwa dokumentu tożsamości">
	<?php echo form_error('nazwa_dok','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>

	<div class="form-group">
	<label class="col-sm-3 control-label">Seria/nr dokumentu</label>
	<div class="col-sm-6">
	<input class="form-control" name="seria_dok" AUTOCOMPLETE=OFF type="text" placeholder="Seria/nr dokumentu">
	<?php echo form_error('seria_dok','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>
 Adres do korespondencji, jeżeli jest inny niż wskazany w części A zgłoszenia: <br/><br/>

	<div class="form-group">
	<label class="col-sm-3 control-label">Ulica</label>
	<div class="col-sm-6">
	<input class="form-control" name="kulica" AUTOCOMPLETE=OFF type="text" placeholder="Ulica">
	<?php echo form_error('kulica','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>

	<div class="form-group">
	<label class="col-sm-3 control-label">Nr domu / Nr lokalu</label>
	<div class="col-sm-3">
	<input class="form-control" name="knr_domu" AUTOCOMPLETE=OFF type="text" placeholder="Nr domu">
	<?php echo form_error('knr_domu','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
	<div class="col-sm-3">
	<input class="form-control" name="knr_lokalu" AUTOCOMPLETE=OFF type="text" placeholder="Nr lokalu">
	<?php echo form_error('knr_lokalu','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>

	<div class="form-group">
	<label class="col-sm-3 control-label">Kod pocztowy / Miejscowość</label>
	<div class="col-sm-2">
	<input class="form-control" name="kkod" AUTOCOMPLETE=OFF type="text" placeholder="Kod pocztowy">
	<?php echo form_error('kkod','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
	<div class="col-sm-4">
	<input class="form-control" name="kmiasto" AUTOCOMPLETE=OFF type="text" placeholder="Miejscowość">
	<?php echo form_error('kmiasto','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>

	<div class="form-group">
	<label class="col-sm-3 control-label">Data powołania ABI</label>
	<div class="col-sm-6">
	<input class="form-control" name="data" AUTOCOMPLETE=OFF id="datepicker" type="text" placeholder="Data powołania">
	<?php echo form_error('data','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
	</div>
</div>
<legend>Część C. Oświadczenie administratora danych o spełnieniu przez administratora bezpieczeństwa
informacji warunków określonych w ustawie</legend>
Oświadczam, że administrator bezpieczeństwa informacji wskazany w części B zgłoszenia<br/><br/>
<div class="col-sm-1"></div>
<div class="form-group">
		<label class="col-sm-9 checkbox-inline">
<input type="checkbox" value="1" name="c1" id="inlineCheckbox1">
		 ma pełną zdolność do czynności prawnych oraz korzysta z pełni praw publicznych,</label>
</div>

<div class="col-sm-1"></div>
<div class="form-group">
		<label class="col-sm-9 checkbox-inline">
			<input type="checkbox" value="1" name="c2" id="inlineCheckbox1">
		 posiada odpowiednią wiedzę w zakresie ochrony danych osobowych,</label>
</div>

<div class="col-sm-1"></div>
<div class="form-group">
		<label class="col-sm-9 checkbox-inline"><input type="checkbox" value="1" name="c3" id="inlineCheckbox1">
nie był karany za umyślne przestępstwo, </label>
</div>

<div class="col-sm-1"></div>
<div class="form-group">
		<label class="col-sm-9 checkbox-inline"><input type="checkbox" value="1" name="c4" id="inlineCheckbox1"> 
podlega bezpośrednio kierownikowi jednostki organizacyjnej lub osobie fizycznej będącej
		 administratorem danych.</label>
</div>


<div class="col-sm-6"></div>
<div class="col-sm-3">
<button type="submit" class="btn btn-primary">Zapisz</button>
</fieldset></form>
</div>