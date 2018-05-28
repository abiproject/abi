<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Dodaj nową pozycję do rejestru incydentów</h3>
            </div>
            <div class="panel-body">
					
					<?php 
					$atr = array(
						"role"  => "form");
					echo form_open('rejestr_inc/index/dodaj',$atr); ?>
					
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
	 <input name="data_wykrycia" class="form-control" AUTOCOMPLETE=OFF type="text" id="datepicker" placeholder="Data wykrycia">
 	</div>
   <div class="col-xs-4">
     	<textarea class="form-control" name="opis" rows="1" placeholder="Opis incydentu"></textarea>
   </div>
 </div>
<div class="row" style="padding-top: 10px;">
   <div class="col-xs-3">
		<input name="data_zgloszenia" class="form-control" AUTOCOMPLETE=OFF type="text" id="datepicker2" placeholder="Data zgłoszenia do ADO">
	</div>
	<div class="col-xs-6">
	 <textarea class="form-control" name="opis_pr" rows="1" placeholder="Opis procedury naprawczej/działań"></textarea>
	</div>
	<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Dodaj nową pozycję</button>
	</div>
	</fieldset>
	</form>
	</div>
</div>