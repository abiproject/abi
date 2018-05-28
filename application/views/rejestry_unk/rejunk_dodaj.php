<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Dodaj nową pozycję do rejestru uszkodzonych nośników komputerowych</h3>
            </div>
            <div class="panel-body">
					<?php 
					$atr = array(
						"role"  => "form");
					echo form_open('rejestry_unk/index/dodaj',$atr);?>
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
     <input name="data" class="form-control" AUTOCOMPLETE=OFF type="text" id="datepicker" placeholder="Data">
  </div>
	 <div class="col-xs-3">
		 				<script>
		 				  $(function() {
		 				   var availableTags = [
		 <?php foreach ($komorki as $item):?>
		 { label: '<?php echo $item["nazwa"];?>'},
		 <?php endforeach;?>
		 ];
		 				    $( "#tags" ).autocomplete({
		 				      source: availableTags
		 				    });
		 				  });
		 				  </script>
     <input name="komorka" class="form-control" type="text" id="tags" placeholder="Komórka organizacyjna">
						  </div>
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Dodaj</button>
</fieldset>
</form>
            </div>
          </div>
   			