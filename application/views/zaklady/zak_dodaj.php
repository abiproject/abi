<h2>Zarządzanie zakładami</h2>
<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Dodaj nowy zakład</h3>
            </div>
            <div class="panel-body">
					<?php
					$atr = array(
						"class" => "form-inline",
						"role"  => "form");
					echo form_open('zaklady/dodaj',$atr); ?>
						    <fieldset>
								 <div class="form-group">
						        <input name="name" class="form-control" type="text" id="name" placeholder="Nazwa">
							  </div>
								 <div class="form-group">
						        <input name="miasto" class="form-control" type="text" id="name" placeholder="Miasto">
							  </div>
								 <div class="form-group">
						        <input name="adres" class="form-control" type="text" id="name" placeholder="Adres">
							  </div>
								 <div class="form-group">
						        <input name="nip" class="form-control" type="text" id="name" placeholder="NIP">
							  </div>
								 <div class="form-group">
						        <input name="regon" class="form-control" type="text" id="name" placeholder="REGON">
							  </div>
<br/><br/>
    <div class="col-sm-offset-11">
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Dodaj</button>
</fieldset>
</form>
            </div>
          </div>