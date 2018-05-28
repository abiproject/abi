<h3>Modyfikacja pracownika</h3>
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					echo form_open('pracownicy/edytuj/'.$pracownik["id"],$atr); ?>
  <fieldset>
	  <div class="form-group">
		  <label for="nazwa" class="col-sm-2 control-label">Nazwisko i imię: </label>
				<div class="col-sm-6">
     <input name="name" class="form-control type="text" id="name" placeholder="Nazwisko i imię" value="<?php echo $pracownik["nazwiskoimie"];?>">
<?php echo form_error('name','<div class="form-group has-error has-feedback"><label class="control-label" for="inputError2">', '</label><span class="glyphicon glyphicon-remove form-control-feedback"></span></div>'); ?>
</div>
							  </div>
						    <div class="form-group">
						     <label for="plec" class="col-sm-2 control-label">Płeć: </label>
							  <div class="col-sm-4">
								  <select class="form-control" name="plec" type="text" id="name">
									  <?php if($pracownik["plec"] == "M"):?>
										 	<option selected>M</option>
									  		<option>K</option>
										<?php else:?>
										 	<option>M</option>
									  		<option selected>K</option>
										<?php endif;?>
								  </select>
							  </div>
						  </div>
						    <div class="form-group">
			               <label for="zaklad" class="col-sm-2 control-label">Zakład: </label>
							   <div class="col-sm-6">
							   <select class="form-control" name="zaklad" type="text" id="name">
							<?php foreach($zaklady as $row):?>	
								<option <?php if($pracownik["id_zakladu"] == $row["id"]) echo "selected"?> value="<?php echo $row["id"];?>"><?php echo $row["nazwa_zakladu"];?></option>
							<?php endforeach;?>
								</select></div>
							</div>
							<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
<button type="submit" class="btn btn-primary">Zapisz</button>
</fieldset>
</form>
</div></div>