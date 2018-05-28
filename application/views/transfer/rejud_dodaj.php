<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Import zgłoszenia do rejestru udostępnień danych</h3>
            </div>
            <div class="panel-body">
					<?php 
					@$hidden = array(	'url' => 'https://hd.informatics.jaworzno.pl/attachments/'.$plik["0"]->filename.'', 
											'nazwa_pliku' => ''.$plik["0"]->filename.'',
											'id_hd' => ''.$id_hd.'');
					$atr = array(
											'role'  => 'form');
					echo form_open_multipart('transfer/index/dodaj',$atr,$hidden); ?>
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
 <input name="data" class="form-control" AUTOCOMPLETE=OFF type="text" id="datepicker" value="<?= date("Y-m-d",$dane["0"]->create_date);?>" placeholder="Data udostępnienia">
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
 <div class="col-xs-5">
 	  <label for="zalacznik">Załącznik  - plik znajdujący się w zgłoszeniu</label>
 <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Importuj do rejestru</button>
 </fieldset>
 </form>
 </div>
 </div>