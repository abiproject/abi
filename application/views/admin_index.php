<?php
// if(strlen($msg) > 0) echo '<div class="alert alert-success" role="alert" id="okMsg">'.$msg.'</div>';
?>
<div class="well">

<div class="alert alert-success" role="alert">
Witaj w aplikacji <strong><span  class="glyphicon glyphicon-tint"></span> ABI Informatics</strong>!
<br>
<br/>
<dl class="dl-horizontal">
<dt style="margin-bottom:5px;">Zalogowano jako:</dt><dd><span class="label label-success"><span class="glyphicon glyphicon-user"></span> <?php echo $nazwa;?></span> <span class="label label-success"><span class="glyphicon glyphicon-time"></span> Ostatnie logowanie: <?php echo $last_log; ?></span></dd>
<dt style="margin-bottom:5px;">Zakład:</dt><dd><span class="label label-success"><span class="glyphicon glyphicon-home"></span> <?php echo $zaklad; ?></span></dd>
<dt style="margin-bottom:5px;">Pracowników:</dt><dd><span class="label label-success"><span class="glyphicon glyphicon-briefcase"></span> <?php echo $suma_pracownikow; ?></span></dd>
<dt style="margin-bottom:5px;">Upoważnień:</dt><dd><span class="label label-success"><span class="glyphicon glyphicon-inbox"></span> <?php echo $suma_upo; ?></span> w tym wygasających w ciągu najbliższych 14 dni <a href="<?php echo site_url('admin/upo/wygasajace');?>"><span class="label label-danger"> <?php echo $suma_upo_wygasajacych;?></span></a></dd>
</dl></div>
<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-calendar"></span> <strong><?php echo date('d/m/Y H:i');?></strong><br/>Aktualnie zalogowani użytkownicy: <?php foreach($users_logged as $user): ?><strong><?php= $user;?></strong>, <?php endforeach;?>
<br/><br/>Dzisiaj mamy <strong><?php echo date('z') + 1;?></strong> dzień roku, jak się czujesz użytkowniku?<br/>
<?php if(date("N") > 5):?>
Dziś weekend!<br/>
<?php endif;?>
<?php if(date("N") == 5):?>
Piątek, piątunio, piąteczek.. nareszcie!<br/>
<?php endif;?>

<?php if(date("H") > 7 && date("H") < 10 && date("N") < 6):?>
Może czas na poranną kawę?
<?php endif;?>
<?php if(date("H") > 9 && date("H") < 12 && date("N") < 6):?>
A zjadłeś już śniadanie drogi użytkowniku :)?
<?php endif;?>
<?php if(date("H") > 11 && date("H") < 15 && date("N") < 6):?>
Ciężki dzień pracy...
<?php endif;?>
<?php if(date("H") > 13 && date("H") < 17 && date("N") < 6):?>
Jeszcze chwila i... po pracy?
<?php endif;?>
<?php if(date("H") > 16 or date("N") > 5):?>
Nadal pracujesz? Zrób sobie już przerwę :)
<?php endif;?>
</div>
<div class="row">
	<div class="col-md-6">
<div class="alert alert-warning" role="alert"><h4>Wersja: 4.1a</h4>
<strong>Lista zmian:</strong>
<ul><li>Poprawki w rejestrach umów i udostępnień </li>
<li>Poprawki w wydrukach do PDF </li></ul>

<strong>Drogi Użytkowniku!</strong>
Jeżeli znajdziesz błąd w aplikacji zgłoś go pod adres:<br/><span class="glyphicon glyphicon-envelope"></span> <a href="mailto:michal.terbert@gmail.com">michal.terbert@gmail.com</a>.
<br/><br/>Możesz także użyć Slack - <a href="https://informatics-jaw.slack.com/messages/general/"><img style="width: 25%" src="https://platform.slack-edge.com/img/sign_in_with_slack@2x.png"></a>
</div>
</div>
	<div class="col-md-6">
<div class="alert alert-danger" role="alert"><h4><span class="glyphicon glyphicon-question-sign"></span> Porady</h4>
	<ol><li>Zadbaj o poprawne uzupełnienie zbiorów i słowników</li>
		<li>Przed wprowadzaniem nowych umów zadbaj o zawartość zbiorów papierowych</li>
		<li>Poprawne uzupełnienie zbiorów papierowych stanowi podstawę do API</li>
		<li>Uzupełnij komórki organizacyjne zanim przygotujesz upoważnienie</li>
		<li>Transfer z HD posiada możliwość dołączenie tylko 1 załącznika</li>
		<li>API dla klienta wyświetla tylko opublikowane zbiory</li></ol>
</div>
</div>
</div>
</div>
