<h2>Wyniki wyszukiwania:</h2>
<?php if(strlen($error) > 0) echo '<div class="alert alert-danger" role="alert" id="errorMsg">'.$error.'</div>';?>
<?php if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';?>
<h3>Zgłoszenie #<?= $dane["0"]->id;?></h3>
<div>
<dl class="dl-horizontal">
  <dt>Tytuł</dt>
  <dd><?= $dane["0"]->short;?></dd>
  <dt>Opis</dt>
  <dd><?= $dane["0"]->description;?></dd>
  <dt>Użytkownik</dt>
  <dd><?= $dane["0"]->user;?></dd>
  <dt>Data zgłoszenia</dt>
  <dd><?= date("Y-m-d",$dane["0"]->create_date);?></dd>
</dl>

<?php if(isset($plik["0"])): ?>
Znaleziono plik <a href="https://hd.informatics.jaworzno.pl/attachments/<?= $plik["0"]->filename;?>"><?= $plik["0"]->filename;?></a> w zgłoszeniu o numerze <strong>#<?= $plik["0"]->tid;?></strong>
<?php else: ?>
Nie znaleziono załącznika w zgłoszeniu o numerze <strong>#<?= $dane["0"]->id;?></strong>
<?php endif;?>
</div></p>