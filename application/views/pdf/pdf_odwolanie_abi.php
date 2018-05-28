<p align="ceter"><h1>ZGŁOSZENIE</h1>
<h2>ODWOŁANIA ADMINISTRATORA BEZPIECZEŃSTWA INFORMACJI DO REJESTRACJI GENERALNEMU INSPEKTOROWI OCHRONY DANYCH OSOBOWYCH</h2></p>
<div style="text-align: right;">Data wpłynięcia zgłoszenia:..................................... <br/>
(wypełnia Generalny Inspektor Danych Osobowych) </div><br/><br/>
<b>Część A. Oznaczenie administratora danych</b><br/>
<table border="1" cellpadding="5">
<tr>
<td>
<table border="0">
<tr>
	<td colspan="4">Nazwa administratora danych i adres jego siedziby albo nazwisko, imię i adres zamieszkania administratora danych oraz nr REGON - jeśli został nadany.
	</td>
</tr>
<tr><td width="30%">1. Administrator</td><td colspan="3"><em><?= $dane["nazwa_zakladu"];?></em></td></tr>
<tr><td width="30%">2. REGON: </td><td colspan="3"><em><?= $dane["regon"];?></em></td></tr>  
<tr><td width="30%">3. Adres: </td><td colspan="3"></td></tr>
<tr><td width="30%">&nbsp;&nbsp;&nbsp;&nbsp;ulica: </td><td colspan="3"><em><?= $dane["adres"];?></em></td></tr>
<tr><td width="30%">&nbsp;&nbsp;&nbsp;&nbsp;nr domu:  </td><td><em><?= $dane["nr_domu"];?></em></td><td width="30%">nr lokalu: </td><td><em><?= $dane["nr_lokalu"];?></em></td></tr>               
<tr><td width="30%">&nbsp;&nbsp;&nbsp;&nbsp;kod pocztowy:  </td><td colspan="3"><em><?= $dane["kod_pocztowy"];?></em></td></tr> 
<tr><td width="30%">&nbsp;&nbsp;&nbsp;&nbsp;miejscowość: </td><td colspan="3"><em><?= $dane["miasto"];?></em></td></tr>
</table>
</td>
</tr>
</table>
<br/>
<br/><b>Część B. Dane osobowe administratora bezpieczeństwa informacji</b><br/>
<table border="1" cellpadding="5">
<tr>
<td>
<table border="0">
<tr><td width="30%">1. Imię i nazwisko:</td><td colspan="3"><em><?= $dane["imie_nazwisko"];?></em></td></tr>
<tr><td colspan="4">2. Numer PESEL lub, gdy ten numer niezostał nadany, nazwa i seria/nr dokumentu stwierdzającego tożsamość:</td></tr>
<tr><td width="30%">PESEL:</td><td colspan="3"><em><?= @$dane["pesel"];?></em></td></tr>
<tr><td width="30%">nazwa dokumentu tożsamości:  </td><td><em><?= @$dane["nazwa_dokumentu"];?></em></td><td width="30%">seria/nr dokumentu tożsamości: </td><td><em><?= $dane["nr_dokumentu"];?></em></td></tr>               
</table>
</td>
</tr>
</table>
<br/><br/>
<b>Część C. Data i przyczyna odwołania administratora bezpieczeństwa informacji</b><br/>
<table border="1" cellpadding="5">
<tr>
<td>
<table border="0">
	<tr><td colspan="3" width="70%">1. Data odwołania administratora bezpieczeństwa informacji:</td><td><em><?= @$dane["data_odwolania"];?></em></td></tr>
	<tr><td colspan="3">2. Przyczyna odwołania administratora bezpieczeństwa informacji: </td></tr>
	<tr><td colspan="3"><em><?= @$dane["przyczyna_od"];?></em></td></tr>
</table>
</td>
</tr>
</table></div><br/><br/>
<p style="padding-left: 20px; text-align: right"><b>(data, podpis i pieczęć admnistratora dancyh)*</b><br /><br /><br /></p>
<u>Objaśnienia:</u><br />
*Pola nie należy wypełniać, jeśli zgłoszenie doręczone jest za pomocy środków komunikacji elektronicznej.<br />