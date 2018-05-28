<h3>Modyfikacja pozycji w słowniku</h3>
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					echo form_open("slowniki/index/update/".$id."/".$row['id']."",$atr); ?>
<fieldset>
<div class="form-group">
<label for="nazwa" class="col-sm-2 control-label">Nazwa</label>
<div class="col-sm-6">
<input name="name" class="form-control" type="text" id="name" value="<?php echo $row["nazwa"];?>">
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-6">
	<button type="submit" class="btn btn-primary">Zapisz</button>
</div></div>
</fieldset>
</form>