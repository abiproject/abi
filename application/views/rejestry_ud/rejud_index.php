<h2>Rejestr udostępnień danych:</h2>
<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>
<table class="table table-bordered table-striped table-hover table_ud">
    <thead>
        <tr>
			<th style="text-align:center">Lp</th>
			<th style="text-align:center; width: 15%">Zakład</th>
			<th style="text-align:center; width: 10%">Data</th>
			<th style="text-align:center">Podmiot</th>
			<th style="text-align:center">Podstawa</th>
			<th style="text-align:center">Zakres</th>
			<th style="text-align:center">Dane osobowe</th>
			<th style="text-align:center;">Załącznik</th>
			<?php if($perm == 2):?><th style="text-align:center; width: 10%">Opcje</th><?php endif;?>
		  </tr>
    </thead>
	 <tbody>
 </tbody>
</table>

<script src="<?php echo base_url('js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('js/dataTables.bootstrap.js')?>"></script>
<style media="all" type="text/css">
    .alignRight { text-align: right; }
	 .alignLeft { text-align: left; }
	 .alignCenter { text-align: center; }
</style>
<script>
$('.table_ud').DataTable({
 "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Wszystkie"]],
 "processing": true,
 "serverSide": true,
 "searchDelay": 0,
 "ajax": { "url": "<?= $json_url;?>",
	   "type": "POST",
	   "data": { "<?= $this->security->get_csrf_token_name();?>": "<?=$this->security->get_csrf_hash();?>"} ,
	   "error": function (xhr, error, thrown) {
    window.location.href = "/";
}
	},
 "columns": [
	 			 { "render": function ( data, type, row, meta ) {
	 					 return meta.row + meta.settings._iDisplayStart + 1;
					 
	 				}, sClass: "alignCenter", "orderable": false },	
             { "data": "nazwa_zakladu"},
             { "data": "data" , sClass: "alignCenter" },
             { "data": "podmiot" },
             { "data": "podstawa_prawna" },
	     { "data": "zakres" },
	     { "data": "dane_osobowe" },
		 { "render": function ( data, type, full, meta ) {
					var size = full.zalacznik_roz;
      			var id = full.id;
					if(size > 0)
						return '<a data-toggle="tooltip" rel="tooltip" title="Pobierz załącznik" href="<?php echo site_url('rejestry_ud/index/zalacznik/');?>/'+id+'"><img src="<?php echo base_url('img/zalacznik.png');?>"></a>';
					else
						return '';
	}, sClass: "alignCenter", "orderable": false
}			<?php if($perm == 2):?>,
		 		 { "render": function ( data, type, full, meta ) {
 				 $("[data-toggle=tooltip]").tooltip();
               var id = full.id;
					var flaga = full.flaga;
					if(flaga == 1)
					var text = '<a data-toggle="tooltip" title="Dane udostępniono" href="<?php echo site_url('rejestry_ud/index/nie/');?>/'+id+'"><img src="<?php echo base_url('img/accept.png');?>"></a>'
					else
					var text = '<a data-toggle="tooltip" title="Odmowa udostępnienia danych" href="<?php echo site_url('rejestry_ud/index/tak/');?>/'+id+'"><img src="<?php echo base_url('img/back.png');?>"></a>'
						
               return '<a data-toggle="tooltip"  title="Edytuj pozycję" href="<?php echo site_url('rejestry_ud/edytuj/');?>/'+id+'"><img src="<?php echo base_url('img/edit.png');?>"></a> <a data-toggle="tooltip"  title="Usuń pozycję" href="<?php echo site_url('rejestry_ud/index/usun/');?>/'+id+'"><img src="<?php echo base_url('img/delete.png');?>"></a> <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Dodaj załącznik"><a href="#" data-toggle="modal" data-target="#myModal'+id+'"><img src="<?php echo base_url('img/zalacznik_dodaj.png');?>"></a></span> '+text;
 		}, sClass: "alignCenter", "orderable": false, 
	}	<?php endif;?>] 
});
			 </script>
<?php if($perm == 2):?>
<?php foreach($rejestr as $row):?>	 
<div class="modal fade" id="myModal<?= $row["id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h4 class="modal-title">Dodaj załącznik dla <?= $row["nazwa_zakladu"];?> pozycja nr <?= $row["nr"]; ?></h4>
		      </div>
		      <div class="modal-body">
					<div class="alert alert-danger" role="alert"><strong>Uwaga</strong> Dodanie nowego załącznika powoduje nadpisanie poprzedniego!</div>
			<?php 
			$hidden = array("id" => $row["id"]);
			$atr = array(
				"class" => "form-inline",
				"role"  => "form");
			echo form_open_multipart('rejestry_ud/index/dodaj_zalacznik',$atr,$hidden); ?>
			 <div class="form-group">
				  <label for="zalacznik">Załącznik</label>
			<input type="file" name="userfile" id="zalacznik">
			</span> </div> 
		</fieldset>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
		        <button type="submit" class="btn btn-success">Dodaj załącznik</button>
		</form>
		      </div>
		    </div>
		  </div>
		</div>
<?php endforeach;?>
<?php endif;?>
