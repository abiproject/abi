<div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">Dodaj nowe upoważnienie</h3>
            </div>
            <div class="panel-body">
<?php foreach ($row as $item):?>
<a class="btn btn-success" style="margin-bottom: 5px" href='<?php echo site_url("admin/upo_nowe/".$item['id']."");?>'>
	<span  class="glyphicon glyphicon-plus-sign"></span> <?php echo $item["nazwa_zakladu"];?></a>
<?php endforeach;?>
	</div></div>

