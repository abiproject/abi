<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Dodaj nową pozycję do rejestru udostępnień danych
				  <?php if(@$acl["transfer"] > 0): ?>
  			  		 	<a class="btn btn-xs btn-warning" href="<?php echo site_url('transfer');?>">Transfer z HD</a>
					<?php endif;?></h3>

            </div>
            <div class="panel-body">
					<?php 
					$atr = array(
						"role"  => "form");
					echo form_open_multipart('rejestry_ud/index/dodaj',$atr); ?>
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
	 <input name="data" class="form-control" AUTOCOMPLETE=OFF type="text" id="datepicker" placeholder="Data udostępnienia">
 </div>
 <div class="col-xs-5">
 	<textarea class="form-control" name="podmiot" rows="1" placeholder="Podmiot, któremu dane udostępniono (nazwa, adres)"></textarea>
 </div>
</div>

<div class="row" style="padding-top: 10px">
<div class="col-xs-5">
	 <textarea class="form-control" name="podstawa" rows="1" placeholder="Podstawa prawna udostępnienia danych"></textarea>
</div>
<div class="col-xs-5">
	 <textarea class="form-control" name="zakres" rows="1" placeholder="Zakres udostępnionych danych"></textarea>
</div>
</div>
<div class="row" style="padding-top: 10px">
<div class="col-xs-5">
	 <textarea class="form-control" name="dane" rows="1" placeholder="Dane osobowe"></textarea>
</div>
<div class="col-xs-3">
	  <label for="zalacznik">Załącznik</label>
<input type="file" name="userfile" id="zalacznik">
</div> 
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Dodaj nową pozycję</button>
</fieldset>
</form>
</div>
</div>