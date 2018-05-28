<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Dodaj nową pozycję do rejestru podmiotów zewnętrznych</h3>
            </div>
            <div class="panel-body">
					<?php 
					$atr = array(
						"role"  => "form");
					echo form_open('rejestry/rejestr_pz/dodaj',$atr); ?>
		    <fieldset>
	   <div class="row">
	     <div class="col-xs-3">
			   <select class="form-control" name="zaklad" type="text" id="zaklad">
			<?php foreach($zaklady as $row):?>	
				<option value="<?php echo $row["id"];?>"><?php echo $row["nazwa_zakladu"];?></option>
			<?php endforeach;?>
				</select>
			</div>

			 <div class="col-xs-3">
	        <input name="nazwa" class="form-control" type="text" id="nazwa" placeholder="Nazwa firmy">
		  </div>
			 <div class="col-xs-3">
	        <input name="zakres" class="form-control" type="text" id="zakres" placeholder="Zakres">
		  </div>
	  </div>
<div class="row" style="padding-top: 10px;">
<span style="margin-right:8px">
			<div class="col-xs-3">
	        <input name="nr_umowy" class="form-control" type="text" id="nr_umowy" placeholder="Nr umowy">
		  </div>
			 <div class="col-xs-6">
	        <input name="uwagi" class="form-control" type="text" id="uwagi" placeholder="Uwagi">
		  </div>
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Dodaj</button>
</fieldset>
</form>
</div>
          </div>
   			