<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Dodaj nową pozycję do rejestru umów</h3>
            </div>
            <div class="panel-body">
					<?php 
					$atr = array(
						"role"  => "form");
					echo form_open('rejestr_u/index/dodaj',$atr); ?>
 <fieldset>
	<div class="row">
	 <div class="col-xs-3">
		   <select class="form-control" name="zaklad" type="text" id="zaklad">
		<?php foreach($zaklady as $row):?>	
			<option value="<?php echo $row["id"];?>"><?php echo $row["nazwa_zakladu"];?></option>
		<?php endforeach;?>
			</select>
	</div>
 <div class="col-xs-3">
 	<textarea class="form-control" name="nazwa_firmy" rows="1" placeholder="Nazwa firmy"></textarea>
</div>
 <div class="col-xs-4">
 	<textarea class="form-control" name="kategoria" rows="1" placeholder="Cel przetwarzania"></textarea>
</div>
</div>
<div class="row" style="padding-top: 10px">
	  <div class="col-xs-1">
	      <label for="DataUmowy" class="control-label" style="padding-top: 5px">Data umowy:</label>
			</div>
  <div class="col-xs-2">  
 <input name="data_zawarcia" class="form-control" AUTOCOMPLETE=OFF type="text" id="datepicker" placeholder="Data zawarcia">
</div>
	  <div class="col-xs-2">
 <input name="data_wygasniecia" class="form-control" AUTOCOMPLETE=OFF type="text" id="datepicker2" placeholder="Data wygaśnięcia">
</div>
		<div class="col-xs-3">
			<div class="radio">
	  <label>
	    <input type="checkbox" name="nieokreslony" id="nieokreslony" value="1">
	    Umowa na czas nieokreślony
	  </label>
	</div>
</div>
</div>
<div class="row" style="padding-top: 10px">							    

	<div class="col-xs-1">
		<label for="Umowapos" class="control-label">Umowa posiada:</label></div>
		<div class="col-xs-2">
			<div class="radio">
	  <label>
	    <input type="radio" name="UmowaPosiada" id="UmowaPosiada" value="1">
	    Umowę powierzenia poufności
	  </label>
	</div>
</div>
		<div class="col-xs-2">
	<div class="radio">
	  <label>
	    <input type="radio" name="UmowaPosiada" id="UmowaPosiada" value="2">
	    Oświadczenie
	  </label>
	</div>
</div>
	<div class="col-xs-2">
	<div class="radio">
	  <label>
	    <input type="radio" name="UmowaPosiada" id="UmowaPosiada" value="3">
	    Klauzulę
	  </label>
	</div>
</div>
	<div class="col-xs-2">
	<div class="radio">
	  <label>
	    <input type="radio" name="UmowaPosiada" id="UmowaPosiada" value="0">
	    Nic
	  </label>
	</div>
</div>
<div class="col-xs-2">
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Dodaj nową pozycję</button>
</fieldset>
</form>
</div> 
</div>