<h3>Modyfikacja zbiorów w rejestrze umów</h3>
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					$hid = array(
								"id_zaklad" => $row[0]->id_zaklad,
								"id_umowy" => $id
							);
					echo form_open('rejestr_u/zbiory/update/'.$id,$atr,$hid); 
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
<input name="nazwa_firmy" class="form-control" type="text" id="disabledInput" disabled value="<?php echo $row[0]->nazwa_firmy;?>">
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
		$('label').click(function () {
			console.log("klik");
                var checked = $(this).hasClass('active');
 			console.log(checked);
                $(this).removeClass(checked ? 'btn-success' : 'btn-danger');
					 $(this).addClass(checked ? 'btn-danger' : 'btn-success');
            });
			});
	</script>

<?php foreach($zbiory as $item):?>

<div class="form-group">
<label for="zbiory" class="col-sm-2 control-label"><?php echo $item->nazwa ?> 
	<?php if($item->flaga == 1):?>
		<a data-toggle="tooltip" data-container="body" title="Dane są publikowane" href="#"><img src="<?php echo base_url('img/on.png');?>"></a>
	<?php else:?>

	<a data-toggle="tooltip" data-container="body" title="Dane nie są publikowane" href="#"><img src="<?php echo base_url('img/off.png');?>"></a>
		
	<?php endif;?></label>
<div class="col-sm-6">
	
	<div class="btn-group" data-toggle="buttons">
		<?php 
		
			if(@$zbiory_zazn[$item->id]["odczyt"] == 1){
				 echo '<label id="redgeen" style="margin: 2px" class="btn btn-success btn-xs active">';
				 $ch = "checked";
			 }
			 else{
				 echo '<label id="redgreen" style="margin: 2px" class="btn btn-danger btn-xs">';
				 $ch = "";
			 }
	echo '<input name="'.$item->id.'[]" type="checkbox" data-complete-text="finished!" autocomplete="off" value="odczyt" '.$ch.'>odczyt</label>'; ?>
		 
		<?php 
		
			if( @$zbiory_zazn[$item->id]["wprowadzanie"] == 1){
				 echo '<label id="redgeen" style="margin: 2px" class="btn btn-success btn-xs active">';
				 $ch = "checked";
			 }
			 else{
				 echo '<label id="redgreen" style="margin: 2px" class="btn btn-danger btn-xs">';
				 $ch = "";
			 }
	echo '<input name="'.$item->id.'[]" type="checkbox" data-complete-text="finished!" autocomplete="off" value="wprowadzanie" '.$ch.'>wprowadzanie</label>'; ?>
 		 
	<?php 
	
		if(@$zbiory_zazn[$item->id]["modyfikacja"] == 1){
			 echo '<label id="redgeen" style="margin: 2px" class="btn btn-success btn-xs active">';
			 $ch = "checked";
		 }
		 else{
			 echo '<label id="redgreen" style="margin: 2px" class="btn btn-danger btn-xs">';
			 $ch = "";
		 }
echo '<input name="'.$item->id.'[]" type="checkbox" data-complete-text="finished!" autocomplete="off" value="modyfikacja" '.$ch.'>modyfikacja</label>'; ?>

		<?php 
		
			if(@$zbiory_zazn[$item->id]["usuwanie"] == 1){
				 echo '<label id="redgeen" style="margin: 2px" class="btn btn-success btn-xs active">';
				 $ch = "checked";
			 }
			 else{
				 echo '<label id="redgreen" style="margin: 2px" class="btn btn-danger btn-xs">';
				 $ch = "";
			 }
	echo '<input name="'.$item->id.'[]" type="checkbox" data-complete-text="finished!" autocomplete="off" value="usuwanie" '.$ch.'>usuwanie</label>'; ?>
	
		<?php 
		
			if(@$zbiory_zazn[$item->id]["archiwizacja"] == 1){
				 echo '<label id="redgeen" style="margin: 2px" class="btn btn-success btn-xs active">';
				 $ch = "checked";
			 }
			 else{
				 echo '<label id="redgreen" style="margin: 2px" class="btn btn-danger btn-xs">';
				 $ch = "";
			 }
	echo '<input name="'.$item->id.'[]" type="checkbox" data-complete-text="finished!" autocomplete="off" value="archiwizacja" '.$ch.'>archiwizacja</label>'; ?>
	
	
 
  	 
</div>
</div>
</div>
<?php endforeach;?>

<?php if(count($zbiory) > 0): ?>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-6">
	<button type="submit" class="btn btn-primary">Zapisz</button>
</div></div>
</fieldset>
</form>
<?php else:?>
<div class="alert alert-danger" role="alert">Brak dostępnych zbiorów!</div>
<?php endif;?>