<script type="text/javascript">
 
$(document).ready(function(){
 
   var counter = <?php echo $suma_rekordow;?>;
   $("#addButton").click(function () {
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
 
  	newTextBoxDiv.after().html('<div class="form-group">'+
	  	'<label for="nazwa" class="col-sm-2 control-label">Gromadzone dane '+ counter + '</label>'+
	  	'<div class="col-sm-6"><input class="form-control" type="text" name="textbox' + counter + 
	  	      '" id="textbox' + counter + '" value="" ></div></div></div>');
  
	newTextBoxDiv.appendTo("#TextBoxesGroup");
 	counter++;
     });
     $("#removeButton").click(function () {
	if(counter==1){
          return false;
       }   
		 counter--;
	$("#TextBoxDiv" + counter).remove();
    });
  });
</script>
<h3>Modyfikacja zakresu gromadzonych danych w zbiorze</h3>
<h4>Zbiór: <?php echo $nazwa_zbioru;?></h4>
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					echo form_open("zbiory/edytuj/".$id."/".$a."",$atr); ?>
<fieldset>
<div id='TextBoxesGroup'>

	<?php $i=0; foreach($zbiory as $row):?>
		<?php $i++;?>
<div id="TextBoxDiv<?php echo $i;?>">
<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Gromadzone dane <?php echo $i;?></label>
<div class="col-sm-6">
<input name="textbox<?php echo $i;?>" class="form-control" type="text" id="textbox<?php echo $i;?>" value="<?php echo $row['dana'];?>">
</div></div>
</div>

	<?php endforeach;?>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-6">
	<a href="#" type="button" id='addButton' class="btn btn-success">Dodaj</a> 	<a href="#" type="button" id='removeButton' class="btn btn-danger">Usuń</a>	<button type="submit" class="btn btn-primary">Zapisz</button>
</div></div>
</fieldset>
</form>