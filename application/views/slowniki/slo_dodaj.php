<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Dodaj nową pozycję do słownika</h3>
            </div>
            <div class="panel-body">
					<?php 
					$atr = array(
						"class" => "form-inline",
						"role"  => "form");
					echo form_open('slowniki/dodaj/'.$a.'/',$atr); ?>
						    <fieldset>
								 <div class="form-group">
						        <input name="name" class="form-control" type="text" id="name" placeholder="Nazwa">
							  </div>
						 <div class="form-group">
							   <select class="form-control" name="zaklad" type="text" id="name">
							<?php foreach($zaklady as $row):?>	
								<option value="<?php echo $row["id"];?>"><?php echo $row["nazwa_zakladu"];?></option>
							<?php endforeach;?>
								</select>
							</div>
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Dodaj</button>
</fieldset>
</form>
            </div>
          </div>