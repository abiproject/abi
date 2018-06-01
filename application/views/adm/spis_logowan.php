<h2>Historia logowań użytkowników</h2>
<table class="table table-bordered table-hover table_logi">
    <thead>
        <tr>
			<th style="text-align:center">Data</th>
			<th style="text-align:center">Login</th>
			<th style="text-align:center">Adres IP</th>
         <th style="text-align:center">Typ logowania</th>
        </tr>
    </thead><tbody>
			 <tbody>
		 </tbody>
 </table>
  
  
  <style media="all" type="text/css">
      .alignRight { text-align: right; }
  	 .alignLeft { text-align: left; }
  	 .alignCenter { text-align: center; }
  </style>
  <script src="<?php echo base_url('js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('js/dataTables.bootstrap.js')?>"></script>
  <script>
   $('.table_logi').DataTable({
   "deferRender": true,
   "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Wszystkie"]],
   "processing": true,
	"order": [[ 0, "desc" ]],
   "ajax": "<?= $json_url;?>",
   "columns": [
		{ "data" : "data", sClass: "alignCenter" },
		{ "data": "login" , sClass: "alignCenter" },
		{ "data": "ip" , sClass: "alignCenter" },
 		{ "render": function ( data, type, full, meta ) {
  				 $("[data-toggle=tooltip]").tooltip();
            var stan  = full.stan;
  				if(stan == 0)
  					var text = '<button data-toggle="tooltip" rel="tooltip" title="Poprawne logowanie" class="btn btn-success btn-xs" type="button"><span class="glyphicon glyphicon-ok"></span></button>';
  				else
  					var text = '<button data-toggle="tooltip" rel="tooltip" title="Błędne logowanie" class="btn btn-danger btn-xs" type="button"><span class="glyphicon glyphicon-remove"></span></button>';
	 return text;
  	}, sClass: "alignCenter"
  }
  	
  		 		 	] 
  });
  </script>