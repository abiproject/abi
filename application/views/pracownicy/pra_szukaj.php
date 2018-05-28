<div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Wyszukaj pracownika</h3>
            </div>
            <div class="panel-body ">
					<?php 
					$atr = array(
						"class" => "form-inline",
						"role"  => "form");
					echo form_open('pracownicy/index',$atr); ?>
						    <fieldset>
								 <div class="form-group">
						        <input name="szukaj" class="form-control" type="text" id="name" placeholder="Nazwisko i imię">
							  </div>
	<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Wyszukaj</button>
</fieldset>
</form>
            </div>
          </div>