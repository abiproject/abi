<h2>Upoważnienia</h2>
<div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Wyszukaj upoważnienie</h3>
            </div>
            <div class="panel-body">
					<?php 
					$atr = array(
						"class" => "form-inline",
						"role"  => "form");
					echo form_open('admin/upo',$atr); ?>
				    <fieldset>
						 <div class="form-group">
				        <input class="form-control" name="name" type="text" id="name" placeholder="Pracownik" value="<?php echo (@$name != null) ? @$name : set_value("name") ;?>">
					  </div>
						<div class="form-group">
							 <div class="checkbox">
								 <label>
								       
						<input class="form-control" type="checkbox" name="aktualne" value="1" <?php echo (@$aktualne > 0) ? set_checkbox('aktualne','1', TRUE) : set_checkbox('aktualne','0'); ?>> pokaż tylko aktualne upoważnienia
						</label>
						  </div>
						 <div class="checkbox">
							 <label>
							       
						<input class="form-control" type="checkbox" name="sort" value="1" <?php echo (@$sort > 0) ? set_checkbox('sort','1', TRUE) : set_checkbox('sort','0'); ?>> pokaż od najstarszych
						</label>
						  </div>
						 <div class="checkbox">
							 <label>
						<input class="form-control" type="checkbox" name="sortid" value="tak" <?php echo (@$sortid != null) ? set_checkbox('sortid','tak', TRUE) : set_checkbox('sortid','nie'); ?>> sortowanie po nr
						</label>
						  </div>
						  <div class="checkbox">
							 <label>
						<input class="form-control" type="checkbox" name="puste" value="tak" <?php echo (@$puste != null) ? set_checkbox('puste','tak', TRUE) : set_checkbox('puste','nie'); ?>> pokaż puste
						</label>
						  </div>
					</div>
				       <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Wyszukaj</button>
				    </fieldset>
				</form>
	</div></div>
	<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
	<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>