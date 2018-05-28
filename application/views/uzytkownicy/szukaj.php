<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Wyszukaj użytkownika</h3>
            </div>
            <div class="panel-body">
					<?php 
					$atr = array(
						"class" => "form-inline",
						"role"  => "form");
					echo form_open('uzytkownicy/',$atr); ?>
						    <fieldset>
						 <div class="form-group">
				        <input class="form-control" name="name" type="text" id="name" placeholder="Użytkownik">
					  </div>
				       <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Wyszukaj</button>
						 <a href=<?php echo site_url("uzytkownicy/nowy");?> class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus-sign"></span> Dodaj nowego</a>
				    </fieldset>
				</form>
	</div></div> 
<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>