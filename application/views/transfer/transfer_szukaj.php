<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Transfer pomiędzy HelpDesk a ABI</h3>
            </div>
            <div class="panel-body">
					<?php 
					$atr = array(
						"class" => "form-horizontal",
						"role"  => "form");
					echo form_open('transfer/index/szukaj',$atr); ?>
 <fieldset>	
									  <div class="form-group">
									      <label class="col-xs-3 control-label" for="id">Id zgłoszenia z HelpDesk:</label>

										<div class="col-xs-3">
 <input name="id_zgloszenia" class="form-control" AUTOCOMPLETE=OFF type="text" id="id_zgloszenia" placeholder="Id">
</div>
<div class="col-xs-2">
 <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Wyszukaj</button>
</fieldset>
</form>
</div>
</div>
