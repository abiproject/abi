<h2>Pozycje w słowniku <strong><?php echo $slownik_nazwa;?></strong>:</h2>
<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>
<table class="table table-bordered table-hover table_slownik">
    <thead>
        <tr>
			<th style="text-align:center">Nazwa pozycji</th>
			<th style="text-align:center">Zakład</th>
         <th style="text-align:center">Opcje</th>
        </tr>
    </thead>
	 <tbody>
  	 </tbody>
    <tfooter>
        <tr>
			<th style="text-align:center">Nazwa pozycji</th>
			<th style="text-align:center">Zakład</th>
         <th style="text-align:center">Opcje</th>
        </tr>
    </tfooter>
</table>
<script src="<?php echo base_url('js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('js/dataTables.bootstrap.js')?>"></script>
<style media="all" type="text/css">
   .alignRight { text-align: right; }
 .alignLeft { text-align: left; }
 .alignCenter { text-align: center; }
</style>
<script>
$('.table_slownik').DataTable({
"lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Wszystkie"]],
"processing": true,
"ajax": "<?= $json_url;?>",
"columns": [
            { "data": "nazwa", sClass: "alignCenter" },
				{ "data": "nazwa_zakladu", sClass: "alignCenter" }
			<?php if($perm == 2):?>,
	 		 { "render": function ( data, type, full, meta ) {
				 $("[data-toggle=tooltip]").tooltip();
              var id = full.pid;
				  var t1 = "";
				  <?php if($slownik_nazwa == "Zbiory papierowe"):?>
				  var flaga = full.flaga;
				  if(flaga == 1)
				  {
				 t1 = '<a data-toggle="tooltip" data-container="body" title="Dane są publikowane" href="<?php echo site_url('zbiory/niepublikuj/');?>/'+ id +'/<?= $a;?>"><img src="<?php echo base_url('img/on.png');?>"></a> ';
			     }
				  else
				  {
				  t1 = '<a data-toggle="tooltip" data-container="body" title="Dane nie są publikowane" href="<?php echo site_url('zbiory/publikuj/');?>/'+ id +'/<?= $a;?>"><img src="<?php echo base_url('img/off.png');?>"></a> ';
			     }
					  
				  t1 = t1 + '<a data-toggle="tooltip" data-container="body" title="Edycja opisu zbioru" href="<?php echo site_url('zbiory/edit_opis/');?>/'+ id +'/<?= $a;?>"><img src="<?php echo base_url('img/edit.png');?>"></a> ';
				  	  
				  t1 = t1 + '<a data-toggle="tooltip" rel="tooltip" title="Edycja zabezpieczeń zbiorów danych" href="<?php echo site_url('zbiory/edytuj_zab/');?>/'+ id +'/<?= $a;?>"><a data-toggle="tooltip" rel="tooltip" title="Edycja zabezpieczeń zbiorów danych" href="<?php echo site_url('zbiory/edytuj_zab/');?>/'+ id +'/<?= $a;?>"><img src="<?php echo base_url('img/lock.png');?>"></a> <a data-toggle="tooltip" rel="tooltip" title="Edycja zakresu gromadzonych danych" href="<?php echo site_url('zbiory/edytuj/');?>/'+ id + '/<?= $a;?>"><img src="<?php echo base_url('img/zakres_zbiorow.png');?>"></a>';
				  <? endif;?>
				  var t2 = ' <a data-toggle="tooltip" rel="tooltip" title="Zmień nazwę pozycji" href="<?php echo site_url('slowniki/index/edytuj/');?>/<?=$a;?>/'+ id +'"><img src="<?php echo base_url("img/grupa_e.png");?>"></a> <a data-toggle="tooltip" rel="tooltip" title="Usuń pozycję" href="<?php echo site_url('slowniki/index/usun/');?>/<?=$a;?>/'+ id +'"><img src="<?php echo base_url("img/delete.png");?>"></a>';

			  	 return t1+t2;					  
		}, sClass: "alignCenter"
}	<?php endif;?>] 
});
</script>