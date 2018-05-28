<h3>Modyfikacja pozycji w rejestrze umów</h3>
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					$hid = array(
								"id_zaklad" => $row[0]->id_zaklad,
								"id_umowy" => $id
							);
						
					echo form_open('rejestr_u/edytuj/update/'.$id,$atr,$hid); 
				?>					
 <fieldset>
<div class="form-group">
<label for="zaklad" class="col-sm-2 control-label">Zakład</label>
<div class="col-sm-6">
<input name="zaklad" class="form-control" id="disabledInput" type="text" disabled value="<?php echo $row[0]->nazwa_zakladu;?>, <?php echo $row[0]->adres;?>, <?php echo $row[0]->miasto;?>">
</div>
</div>
<div class="form-group">
<label for="nazwa_firmy" class="col-sm-2 control-label">Nazwa i adres firmy</label>
<div class="col-sm-6">
<input name="nazwa_firmy" class="form-control" type="text" id="nazwa_firmy" value="<?php echo $row[0]->nazwa_firmy;?>">
</div>
</div>
<div class="form-group">
<label for="cel_przetwarzania" class="col-sm-2 control-label">Cel przetwarzania danych</label>
<div class="col-sm-6">
<input name="cel_przetwarzania" class="form-control" type="text" id="cel_przetwarzania" value="<?php echo $row[0]->kategoria_danych;?>">
</div>
</div>

<div class="form-group">
<label for="data_zawarcia" class="col-sm-2 control-label">Data zawarcia</label>
<div class="col-sm-6">
<input name="data_zawarcia" class="form-control" type="text" AUTOCOMPLETE=OFF id="datepicker" value="<?php echo $row[0]->data_zawarcia;?>">
</div>
</div>

<div class="form-group">
<label for="data_wygas" class="col-sm-2 control-label">Data wygaśnięcia</label>
<div class="col-sm-6">
<input name="data_wygas" class="form-control" type="text" AUTOCOMPLETE=OFF id="datepicker2" value="<?php echo $row[0]->data_wygas;?>">
<p class="help-block"><input type="checkbox" name="nieokreslony" id="nieokreslony" value="1" <?php if($row[0]->data_wygas == "0000-00-00"): ?> checked <?php endif;?>>
Umowa na czas nieokreślony (data 0000-00-00 jest prawidłowa)</p>
</div>
</div>

<div class="form-group">
<label for="umowa_posiada" class="col-sm-2 control-label">Umowa posiada</label>
<div class="col-sm-6"><select class="form-control" name="umowa_posiada">';
						<option 
					<?php if($row[0]->umowa_posiada == 1): ?>SELECTED<?php endif;?>
						value="1" >Umowę powierzenia poufności</option><option
					<?php if($row[0]->umowa_posiada == 2): ?>SELECTED<?php endif;?>
						value="2">Oświadczenie</option><option
					<?php if($row[0]->umowa_posiada == 3): ?>SELECTED<?php endif;?>
						value="3">Klauzulę</option><option
					<?php if($row[0]->umowa_posiada == 0): ?>SELECTED<?php endif;?>
						value="0">Nic</option></select>
</div>
</div>

<div class="form-group">
<label for="zbiory" class="col-sm-2 control-label">Zbiory danych</label>
<div class="col-sm-6 has-feedback">
<script type="text/javascript">
$(document).ready(function(){
 var availableTags = [
	 <?php foreach($zbiory_dostepne->result_array as $zbior): ?>
	 <?php echo '"'.$zbior["nazwa"].'"' ;?>,
	 <?php endforeach;?>
    ];
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#zbiory" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response( $.ui.autocomplete.filter(
            availableTags, extractLast( request.term ) ) );
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
  });
  </script>
  <input name="zbiory" class="form-control" id="zbiory" size="50" value="<?php foreach($zbiory as $item):?><?php echo $item->nazwa ?>, <?php endforeach;?>">  <i class="glyphicon glyphicon-chevron-down form-control-feedback"></i>
	  <p class="help-block">Pole automatyczne! Dopełnia zbiory wg. przypasowania do zakładu.</p>
</div>
</div>


<div class="form-group">
<label for="data_wpisu" class="col-sm-2 control-label">Data dokonania wpisu</label>
<div class="col-sm-6">
<input name="data_wpisu" class="form-control" type="text" id="name" value="<?php echo $row[0]->data_dokonania_wpisu;?>">
</div>
</div>

<div class="form-group">
<label for="typ_aktualizacji" class="col-sm-2 control-label">Typ aktualizacji</label>
<div class="col-sm-6"><select class="form-control" name="typ_aktualizacji">';
						<option 
					<?php if($row[0]->umowa_posiada == 0): ?>SELECTED<?php endif;?>
						value="0" >wprowadzenie</option><option
					<?php if($row[0]->umowa_posiada == 1): ?>SELECTED<?php endif;?>
						value="1">modyfikacja</option><option
					<?php if($row[0]->umowa_posiada == 2): ?>SELECTED<?php endif;?>
						value="2">wykreślenie z rejestru</option></select>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-6">
	<button type="submit" class="btn btn-primary">Zapisz</button>
</div></div>
</fieldset>
</form>