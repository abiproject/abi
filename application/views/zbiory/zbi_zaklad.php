<h2>Wykaz zbiorów</h2>
<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Opis struktury zbiorów danych</h3>
            </div>
            <div class="panel-body">
					<?php 
					$atr = array(
						"class" => "form-inline",
						"role"  => "form");
					echo form_open("zbiory/index/",$atr); ?>
						    <fieldset>
						 <div class="form-group">
							   <select class="form-control" name="zaklad" type="text" id="name">
							<?php foreach($row as $item):?>	
								<option value="<?php echo $item["id"];?>"><?php echo $item["nazwa_zakladu"];?></option>
							<?php endforeach;?>
								</select>
							</div>
<button type="submit" class="btn btn-success">Wybierz</button>
</fieldset>
</form>
            </div>
          </div>