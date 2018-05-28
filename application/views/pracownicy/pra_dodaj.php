<h2>Pracownicy</h2>
<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Dodaj nowego pracownika</h3>
            </div>
            <div class="panel-body">
					<?php 
					$atr = array(
						"class" => "form-inline",
						"role"  => "form");
					echo form_open('pracownicy/dodaj',$atr); ?>
							    <fieldset>
								 <div class="form-group">
						        <input name="name" class="form-control" type="text" id="name" placeholder="Nazwisko i imię">
							  </div>
							 <div class="form-group">
								  <select class="form-control" name="plec" type="text" id="name">
									  <option>M</option>
									  <option>K</option>
								  </select>
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
			 <?php if(!empty($prac_bez_upo)):?>
			 <div class="alert alert-danger" role="alert">
			   <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			 <strong>Napraw poniższe błędy:</strong>
			 <ul>
			 <br/>Pracownicy bez upoważnień: <strong><?php echo count($prac_bez_upo);?></strong>
			 </div>
			 <?php endif;?>