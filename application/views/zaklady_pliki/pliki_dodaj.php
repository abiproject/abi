<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Dodaj nowy plik</h3>
            </div>
            <div class="panel-body">
					<?php 
					$atr = array(
						"role"  => "form");
					echo form_open_multipart('zaklady_pliki/index/dodaj',$atr); ?>
<fieldset>
<div class="row"> 
 <div class="col-xs-3">
	   <select class="form-control" name="zaklad" type="text" id="zaklad">
	<?php foreach($zaklady as $row):?>	
		<option value="<?php echo $row["id"];?>"><?php echo $row["nazwa_zakladu"];?></option>
	<?php endforeach;?>
		</select>
 </div>
 <div class="col-xs-2">
	 <input name="data" class="form-control" AUTOCOMPLETE=OFF type="text" id="datepicker" placeholder="Data dodania">
 </div>
 <div class="col-xs-4">
	 <input name="nazwa_pliku" class="form-control" AUTOCOMPLETE=OFF type="text" placeholder="Nazwa pliku">
 </div>
 
</div>
<div class="row" style="padding-top: 10px">
 <div class="col-xs-4">
 	<textarea class="form-control" name="komentarz" rows="1" placeholder="Komentarz do pliku"></textarea>
 </div>

<div class="col-xs-4">
	  <label for="zalacznik">Załącznik (max 15Mb)</label>
<input type="file" name="userfile" id="zalacznik">
</div> 
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Dodaj nowy plik</button>
</fieldset>
</form>
</div>
</div>