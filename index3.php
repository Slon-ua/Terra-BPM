<style>
   .example {
    1display: inline-block;
    float: left;
    width:49%;
    margin: 5px;
   }
   .tab {
   	 border:'1'; 
   	 width:100%;
   }
   .div1{
   	text-align:center;
   	1display: inline-block;
   }
   .center {
   	text-align:center;
   }
   .div2{
	1float: futer;
	clear:left;
   }
</style>

<?php

 function var_dump_pre($mixed = null) {
  echo '<pre>';
  var_dump($mixed);
  echo '</pre>';
  return null;
}

echo '<input type="file" name="#" value="" onchange="ChangeInput(this,\'extra_in\')" />';
echo '<script> function ChangeInput(obj,name) {
		/*document.getElementById(name).value = obj.value;*/
		var file = obj.value;
		//document.write(file);
	window.location.href = "index3.php?width="+file;}
	  </script>';

$file=preg_split("/fakepath\\\/",$_GET['width']);

if (!$file[1]==null)
{
	$text = file($file[1]);


	#$text = file('Processing-bridge_2017-07-25.log');

	var_dump_pre($text);


	#$subject='[2017-07-14 14:37:47.162]: > GetCardInfo > URL: http://172.16.46.2/Processing.WebApp/GetCardInfo > Request: {"CardNumber":"29100000005"} < Response: {"resultContactInfo":{"ContactId":"f93d32bf-33ee-4317-be78-46866dbdc392","ContactFullName":"Иванов Иван Иванович","ContactPhone":"","CardInfoCollection":[{"CardNumber":"29100000005","CardType":"1","CardStatus":"4"}],"BonusInfoCollection":[]},"Result":0,"Code":0}';
	#$subject2= '[2017-07-14 14:38:15.677]: > SetPurchaseInfo > URL: http://172.16.46.2/Processing.WebApp/SetPurchaseInfo > Request: {"CardNumber":"29100000005","PreprocessingId":"","PointOfSaleCode":1,"Date":"2017-07-14T14:38:02.0000000","PurchaseNumber":"1297286871","TotalAmount":11.54,"BonusesPaidAmount":0,"IsReturn":false,"WriteOffBonusesAvaliable":true,"Offline":false,"CashierName":"АНДРЕЙЯШИН","CashBox":"335","Products":[{"Position":1,"ReturnPosition":0,"ProductExtId":1083258,"Quantity":1,"Price":11.54,"TotalPrice":11.54,"DiscountAmountPos":0,"DiscountCodePos":""}],"Coupons":[]} < Response: {"PreprocessingId":"39e05311-3c18-8fd3-3e47-fb4c584b1680","PurchaseNumber":"1297286871","CardNumber":"29100000005","PointOfSaleCode":"1","Date":"2017-07-14T14:38:02.0000000","TotalAmount":11.54,"BonusesPaidAmount":0,"IsReturn":false,"DiscountAmount":0,"CashPaidAmount":11.54,"CashierName":"АНДРЕЙЯШИН","CashBox":"335","AvailableBonuses":0,"ContactId":"f93d32bf-33ee-4317-be78-46866dbdc392","Result":0,"ResultCodeDescription":{},"Products":[{"Position":1,"ProductExtId":"1083258","CashPaidAmountTotal":11.54,"BonusesPaidAmount":0,"Quantity":1,"DiscountAmountProc":0,"ReturnPosition":0,"Price":11.54,"TotalPrice":11.54,"DiscountAmountPos":0,"DiscountCodePos":""}]}';
	#$subject3='[2017-07-14 14:38:15.912]: > CommitPurchaseInfo > URL: http://172.16.46.2/Processing.WebApp/CommitPurchaseInfo > Request: {"PreprocessingId":"39e05311-3c18-8fd3-3e47-fb4c584b1680"} < Response: {"PreprocessingId":"39e05311-3c18-8fd3-3e47-fb4c584b1680","PurchaseNumber":"1297286871","CardNumber":"29100000005","PointOfSaleCode":"1","Date":"2017-07-14T14:38:02.0000000","TotalAmount":11.54,"BonusesPaidAmount":0,"AccruedBonuses":0,"TotalBonusesEmployee":0,"TotalBonuses":0,"IsReturn":false,"DiscountAmount":0,"CashPaidAmount":11.54,"CashierName":"АНДРЕЙЯШИН","CashBox":"335","AvailableBonuses":0,"ContactId":"f93d32bf-33ee-4317-be78-46866dbdc392","Result":0,"ResultCodeDescription":{},"Products":[{"Position":1,"ProductExtId":"1083258","CashPaidAmountTotal":11.54,"BonusesPaidAmount":0,"Quantity":1,"DiscountAmountProc":0,"ReturnPosition":0,"Price":11.54,"TotalPrice":11.54,"DiscountAmountPos":0,"DiscountCodePos":""}]}';





	$pattern1 = '/.*(> GetCardInfo).*/';
	$pattern2 = '/.*(> SetPurchaseInfo).*/';
	$pattern3 = '/.*(> CommitPurchaseInfo >).*/';
	$i=0;

	foreach ($text as $content) { // читаем построчно
			
			if(preg_match($pattern1, $content))
			{++$i;
				echo "<div class='div2'><br><b>GetCardInfo  $i</b><hr><hr><hr><br>";
				echo '<pre>'; print_r(preg_split("/(\> )+|(\: \{)+|(\} )+/",$content));  echo '</pre>';
				$qw=preg_split("/(\> )+|(\: \{)+|(\} \<)+|(\} \))+/",$content);

				//echo '<br><br>@@<pre>';  print_r(json_decode('{'.$qw[4].'}'));  echo "</pre>@@";
				//echo '<br>@@@@@<pre>';  print_r(json_decode('{'.$qw[6]));  echo "</pre>@@@@@";
				
				echo "<div class='div1'> <b>Таблица GetCardBalanceInfo</b></div>	<div class='example'> <table class='tab' border='1';> <caption><b>Request</b></caption>	<tr><th>Описание</th><th>Данные из JSON</th></tr><tr>";
				foreach(json_decode('{'.$qw[4].'}',true) as $brand => $massiv1){
					if ($brand=='CardNumber') echo"<td><br>Номер карты -------- </td>";
					if ($brand=='ContactId') echo"<td><br>Id контакта   -------- </td>";
					if ($brand=='ContactPhone') echo"<td><br>Номер мобильного телефона контакта  -------- </td>";
					echo "<td> [$brand]= <b>$massiv1 </b></td></tr>"; 
				} echo '</table></div>';

			    echo"<div class='example'> <table class='tab' border='1';> <caption><b>Response</b></caption>	<tr><th>Описание</th><th>Данные из JSON</th></tr><tr>";
				foreach(json_decode('{'.$qw[6],true) as $brand => $massiv1){
					if ($brand=='resultContactInfo') echo"<td><br>Контактные данные: -------- </td>";
					if ($brand=='Code') echo"<td><br>Id Код ошибки.   -------- </td>";
					if ($brand=='Result') echo"<td><br>Результат.  -------- </td>";
					if ($brand=='Description') echo"<td><br>Результат.  -------- </td>";
					echo "<td>.   [$brand]= $massiv1  </td></tr>"; 
					if (is_array($massiv1))		
					{	foreach($massiv1 as  $inner_key1 => $massiv2){
						echo '<tr class="center">';
							if ($inner_key1=='ContactId') echo"<td><br>Id контакта: -------- </td>";
							if ($inner_key1=='ContactFullName') echo"<td><br>ФИО контакта:   -------- </td>";
							if ($inner_key1=='ContactPhone') echo"<td><br>Мобильный телефон контакта:  -------- </td>";
							if ($inner_key1=='CardInfoCollection') echo"<td><br>Информация по карте -------- </td>";
							if ($inner_key1=='BonusInfoCollection') echo"<td><br>Информация по бонусам -------- </td>";
							echo "<td class='center' colspan='2'><br><b>[$inner_key1]= $massiv2</b><br></td></tr>";
							if (is_array($massiv2)){	
								foreach($massiv2 as  $inner_key2 => $massiv3){
									if (is_array($massiv3)){	
										foreach($massiv3 as  $inner_key3 => $massiv4){
											echo '<tr>';
											if ($inner_key3=='CardNumber') echo"<td><br>Номер карты -------- </td>";
											if ($inner_key3=='CardType') {
												if ($massiv4==0) echo"<td><br>Тип карты:----<b>«Виртуальная» </b></td>"; 
												else if ($massiv4==1) echo"<td><br>Тип карты: ----<b>«Физическая» </b></td>";  
											}
											if ($inner_key3=='CardStatus'){ 
												if ($massiv4==0) echo"<td><br>Состояние карты: ----<b>«Не эмитирована» </b></td>";
												else if ($massiv4==1) echo"<td><br>Состояние карты: ----<b>«Отправлена на эмиссию»</b>  </td>";
												else if ($massiv4==2) echo"<td><br>Состояние карты: ----<b>«Новая»</b>.</td>";
												else if ($massiv4==3) echo"<td><br>Состояние карты: ----<b>«Выдана».</b></td>";
												else if ($massiv4==4) echo"<td><br>Состояние карты: ----<b>«Активирована».</b> </td>";
												else if ($massiv4==5) echo"<td><br>Состояние карты: ----<b>«Заблокирована». </b></td>";									
											}
											if ($inner_key3=='BonusAmount') echo"<td><br>Количество бонусов -------- </td>";
											if ($inner_key3=='BonusTypeCode') {
												if ($massiv4==0) echo"<td><br>Тип бонусов: ----<b>«Бонус сотрудника».</b> </td>";
												else if ($massiv4==1) echo"<td><br>Тип бонусов: ----<b>«Бонус УПЛ».</b></td>";
											}
											if ($inner_key3=='BonusStatus') {
												if ($massiv4==1) echo"<td><br>Состояние бонусов: -----<b>«Доступны».</b> </td>";
												else if ($massiv4==2) echo"<td><br>Состояние бонусов: -----<b>«Сгорели».</b> </td>"; 
												else if ($massiv4==3) echo"<td><br>Состояние бонусов: -----<b>«Не активны».</b> </td>"; 
											}
											echo "<td><br>-- [$brand][$inner_key1][$inner_key2][$inner_key3]= <b>$massiv4</b><br></td></tr>";
										}
									}	
								}
							}	
						}
					}
				}echo '</table></div></div>';
			}
			
			 if (preg_match($pattern2, $content)) 
			{
				echo "<div class='div2'><br><b>SetPurchaseInfo</b><hr><br>";
				echo '<pre>'; print_r(preg_split("/(\> )+|(\: \{)+|(\} )+/",$content));  echo '</pre>';
				$qw=preg_split("/(\> )+|(\: \{)+|(\} \<)+|(\} \))+/",$content);

				//echo '<br><br>@@<pre>';  print_r(json_decode('{'.$qw[4].'}'));  echo "</pre>@@";
				//echo '<br>@@@@@<pre>';  print_r(json_decode('{'.$qw[6]));  echo "</pre>@@@@@";

				echo "<div class='div1'> <b>Таблица SetPurchaseInfo</b></div>	<div class='example'> <table class='tab' border='1';> <caption><b>Request</b></caption>	<tr><th>Описание</th><th>Данные из JSON</th></tr><tr>";
				foreach(json_decode('{'.$qw[4].'}',true) as $brand => $massiv1){
					if ($brand=='CardNumber') echo"<td><br>Номер карты -------- </td>";
					if ($brand=='PreprocessingId') echo"<td><br>Id препроцессинга покупки   -------- </td>";
					if ($brand=='PurchaseNumber') echo"<td><br>Номер покупки  -------- </td>";
					if ($brand=='PointOfSaleCode') echo"<td><br>Код торговой точки -------- </td>";
					if ($brand=='Date') echo"<td><br>Дата покупки  -------- </td>";
					if ($brand=='TotalAmount') echo"<td><br>Общая сумма  -------- </td>";
					if ($brand=='BonusesPaidAmount') echo"<td><br>Оплата бонусами -------- </td>";
					if ($brand=='WriteOffBonusesAvaliable') {
						if ($massiv1==true){ echo"<td><br>Количество бонусов к списанию за покупку ---- <b> списания доступно.</b></td>";}
						else if ($massiv1==false){ echo"<td><br>Количество бонусов к списанию за покупку ----<b> списания не доступно.</b></td>";}
					}
					if ($brand=='Offline') {
						if ($massiv1==true) echo"<td><br>Офлайн покупка -----<b> в режиме офлайн (бонусы не списываются,скидка не применяется). </b></td>";
						else if($massiv1==false) echo"<td><br>Офлайн покупка ----- <b>в режиме онлайн. </b></td>";
					}
					if ($brand=='IsReturn') {
						if ($massiv1==true) echo"<td><br>Возврат ----<b> покупка является возвратом</b></td>";
						else if($massiv1==false) echo"<td><br>Возврат ----<b> покупка является продажей</b></td>";
					} 
					if ($brand=='CashierName') echo"<td><br>Кассир -------- </td>";
					if ($brand=='CashBox') echo"<td><br>Номер кассы  -------- </td>";
					if ($brand=='Products') echo"<td><br>Товары:  -------- </td>";
					if ($brand=='Coupons') echo"<td><br>Купоны:  -------- </td>";
					if ($brand=='ParentPurchaseNumber') echo"<td><br>Родительская покупка:  -------- </td>";
					
					echo "<td> [$brand]= <b> $massiv1 </b></td></tr>"; 
					if (is_array($massiv1))		
					{	foreach($massiv1 as  $inner_key1 => $massiv2){
							#echo "<br>[$brand][$inner_key1]=$massiv2<br>";
							echo "<tr><td class='center' colspan='2'><br><b>[$brand]=".++$inner_key1."<b><br></td></tr>";
							foreach($massiv2 as  $inner_key2 => $massiv3){
								echo '<tr class="center">';
								if ($inner_key2=='Position') echo"<td><br>Позиция в покупке -------- </td>";
								if ($inner_key2=='ReturnPosition') echo"<td><br>Родительская позиция (отражается при возврате)   -------- </td>";
								if ($inner_key2=='ProductExtId') echo"<td><br>ExtId продукта  -------- </td>";
								if ($inner_key2=='Quantity') echo"<td><br>Количество продуктов в позиции -------- </td>";
								if ($inner_key2=='Price') echo"<td><br>ДЦена за единицу продукта  -------- </td>";
								if ($inner_key2=='TotalPrice') echo"<td><br>Общая сумма  -------- </td>";
								if ($inner_key2=='DiscountAmountPos') echo"<td><br>Сумма скидки POS -------- </td>";
								if ($inner_key2=='DiscountCodePos') echo"<td><br>Код скидки POS -------- </td>";
								echo "<td><br>[$brand][$inner_key2]=<b>$massiv3</b><br> </td></tr>";
							}
						}
					}
				} echo '</table></div>';

			    echo"<div class='example'> <table class='tab' border='1';> <caption><b>Response</b></caption>	<tr><th>Описание</th><th>Данные из JSON</th></tr><tr>";
				foreach(json_decode('{'.$qw[6],true) as $brand => $massiv1){
					if ($brand=='CardNumber') echo"<td><br>Номер карты -------- </td>";
					if ($brand=='PreprocessingId') echo"<td><br>Id препроцессинга покупки   -------- </td>";
					if ($brand=='PurchaseNumber') echo"<td><br>Номер покупки  -------- </td>";
					if ($brand=='PointOfSaleCode') echo"<td><br>Код торговой точки -------- </td>";
					if ($brand=='Date') echo"<td><br>Дата покупки  -------- </td>";
					if ($brand=='TotalAmount') echo"<td><br>Общая сумма  -----Сумма без учета скидок и списанных бонусов</td>";
					if ($brand=='BonusesPaidAmount') echo"<td><br>Оплата бонусами -------- </td>";
					if ($brand=='IsReturn') {
						if ($massiv1==true) echo"<td><br>Возврат ----<b>покупка является возвратом</b></td>";
						else if($massiv1==false) echo"<td><br>Возврат ----<b>покупка является продажей</b></td>";
					} 
					if ($brand=='CashierName') echo"<td><br>Кассир -------- </td>";
					if ($brand=='CashBox') echo"<td><br>Номер кассы  -------- </td>";
					if ($brand=='Products') echo"<td><br>Товары:  -------- </td>";
					if ($brand=='DiscountAmount') echo"<td><br>Общая сумма скидки -------- </td>";
					if ($brand=='CashPaidAmount') echo"<td><br>Сумма оплаты -------- </td>";
					if ($brand=='AvailableBonuses') echo"<td><br>Количество доступных бонусов к списанию по текущей покупке ---- </td>";
					if ($brand=='ContactId') echo"<td><br>Id контакта (владельца карты) -------- </td>";
					if ($brand=='Result') echo"<td><br>Результат ошибки:  -------- </td>";
					if ($brand=='ResultCodeDescription') echo"<td><br>Код и значение ошибки:  -------- </td>";
					if ($brand=='ParentPurchaseNumber') echo"<td><br>Родительская покупка ---- </td>";
					if ($brand=='CompensationChargeEmployeeBonuses') echo"<td><br>Начисленные бонусы сотрудника при возврате -------- </td>";
					if ($brand=='CompensationChargeBonuses') echo"<td><br>Начисленные бонусы УПЛ при возврате  -------- </td>";
					if ($brand=='CompensationWriteOffEmployeeBonuses') echo"<td><br>Списанные бонусы сотрудника при возврате ---- </td>";		
					if ($brand=='CompensationWriteOffBonuses') echo"<td><br>Списанные бонусы УПЛ при возврате ---- </td>";
					if ($brand=='ErrorCode') echo"<td><br>ErrorCode ---- </td>";
					if ($brand=='Errors') echo"<td><br> Описание ошибки ---- </td>";

					echo "<td> [$brand]=<b> $massiv1  </b></td></tr>"; 
					if (is_array($massiv1))		
					{	foreach($massiv1 as  $inner_key1 => $massiv2){
						echo "<tr><td class='center' colspan='2'><br><b>[$brand]=".++$inner_key1."<b><br></td></tr>";
							foreach($massiv2 as  $inner_key2 => $massiv3){
								echo '<tr class="center">';
								if ($inner_key2=='Position') echo"<td><br>Номер позиции в покупке -------- </td>";
								if ($inner_key2=='ReturnPosition') echo"<td><br>Номер возврата   -------- </td>";
								if ($inner_key2=='ProductExtId') echo"<td><br>ExtId продукта  -------- </td>";
								if ($inner_key2=='Quantity') echo"<td><br>Количество продуктов в позиции -------- </td>";
								if ($inner_key2=='Price') echo"<td><br>Цена за единицу  -------- </td>";
								if ($inner_key2=='TotalPrice') echo"<td><br>Общая сумма  -------- </td>";
								if ($inner_key2=='DiscountAmountPos') echo"<td><br>Сумма скидки POS -------- </td>";
								if ($inner_key2=='DiscountCodePos') echo"<td><br>Код скидки POS -------- </td>";
								if ($inner_key2=='CashPaidAmountTotal') echo"<td><br>Сумма оплаты -------- </td>";
								if ($inner_key2=='BonusesPaidAmount') echo"<td><br>Оплата бонусами -------- </td>";
								if ($inner_key2=='DiscountAmountProc') echo"<td><br>Сумма скидки правила ПЛ -------- </td>";
								if ($inner_key2=='DiscountAmountCodeProc') echo"<td><br>Код скидки правила ПЛ -------- </td>";
								if ($inner_key2=='Key') echo"<td><br>Код ошибки. -------- </td>";
								if ($inner_key2=='Value') echo"<td><br>Описание ошибки. -------- </td>";
								if ($inner_key2=='ErrorCode') echo"<td><br> Код ошибки: -------- </td>";
								if ($inner_key2=='FieldName') echo"<td><br> Название ошибки: -------- </td>";
								if ($inner_key2=='Message') echo"<td><br> Описание ошибки: -------- </td>";

								echo "<td><br>[$brand][$inner_key1][$inner_key2]= <b> $massiv3 </b><br></td></tr>";
							}
						}
					}
				}echo '</table></div></div>';
			}
			
			 if (preg_match($pattern3, $content)) 
			{
				echo "<div class='div2'><br><b> CommitPurchaseInfo</b><hr><br>";
				echo '<pre>'; print_r(preg_split("/(\> )+|(\: \{)+|(\} )+/",$content));  echo '</pre>';
				$qw=preg_split("/(\> )+|(\: \{)+|(\} \<)+|(\} \))+/",$content);

				//echo '<br><br>@@<pre>';  print_r(json_decode('{'.$qw[4].'}'));  echo "</pre>@@";
				//echo '<br>@@@@@<pre>';  print_r(json_decode('{'.$qw[6]));  echo "</pre>@@@@@";

				echo "<div class='div1'> <b>Таблица CommitPurchaseInfo</b></div>	<div class='example'> <table class='tab' border='1';> <caption><b>Request</b></caption>	<tr><th>Описание</th><th>Данные из JSON</th></tr><tr>";
				foreach(json_decode('{'.$qw[4].'}',true) as $brand => $massiv1){
					if ($brand=='PreprocessingId') echo"<td><br>Id препроцессинг а покупки   -------- </td>";
					if ($brand=='IsReturn') {
						if ($massiv1==true) echo"<td><br>Возврат ----<b>покупка является возвратом</b></td>";
						else if($massiv1==false) echo"<td><br>Возврат ----<b>покупка является продажей</b></td>";
					} 
					echo "<td> [$brand]= <b>$massiv1 </b></td></tr>"; 
				} echo '</table></div>';

				echo"<div class='example'> <table class='tab' border='1';> <caption><b>Response</b></caption>	<tr><th>Описание</th><th>Данные из JSON</th></tr><tr>";
					foreach(json_decode('{'.$qw[6],true) as $brand => $massiv1){
						if ($brand=='CardNumber') echo"<td><br>Номер карты -------- </td>";
						if ($brand=='PreprocessingId') echo"<td><br>Id препроцессинг а покупки   -------- </td>";
						if ($brand=='PurchaseNumber') echo"<td><br>Номер покупки  -------- </td>";
						if ($brand=='PointOfSaleCode') echo"<td><br>Код торговой точки -------- </td>";
						if ($brand=='Date') echo"<td><br>Дата покупки  -------- </td>";
						if ($brand=='TotalAmount') echo"<td><br>Общая сумма  -----Сумма без учета скидок и списанных бонусов</td>";
						if ($brand=='BonusesPaidAmount') echo"<td><br>Оплата бонусами -------- </td>";
						if ($brand=='IsReturn') {
						    if ($massiv1==true) echo"<td><br>Возврат ----<b> покупка является возвратом</b></td>";
						    else if($massiv1==false) echo"<td><br>Возврат ----<b> покупка является продажей</b></td>";
					    } 
					 	if ($brand=='CashierName') echo"<td><br>Кассир -------- </td>";
						if ($brand=='CashBox') echo"<td><br>Номер кассы  -------- </td>";
						if ($brand=='Products') echo"<td><br>Товары:  -------- </td>";
						if ($brand=='DiscountAmount') echo"<td><br>Общая сумма скидки -------- </td>";
						if ($brand=='CashPaidAmount') echo"<td><br>Сумма оплаты -------- </td>";
						if ($brand=='AvailableBonuses') echo"<td><br>Количество доступных бонусов к списанию по текущей покупке ---- </td>";
						if ($brand=='ContactId') echo"<td><br>Id контакта (владельца карты) -------- </td>";
						if ($brand=='Result') echo"<td><br>Результат ошибки:  -------- </td>";
						if ($brand=='ResultCodeDescription') echo"<td><br>Код и значение ошибки:  -------- </td>";
						if ($brand=='AccruedBonuses') echo"<td><br>Количество начисленных бонусов за покупку:  -------- </td>";
						if ($brand=='TotalBonusesEmployee') echo"<td><br>Количество бонусов сотрудника на балансе клиента:  -------- </td>";
						if ($brand=='TotalBonuses') echo"<td><br>Общее количество бонусов на балансе клиента:  -------- </td>";
						if ($brand=='ParentPurchaseNumber') echo"<td><br>Родительская покупка ---- </td>";
						if ($brand=='CompensationChargeEmployeeBonuses') echo"<td><br>Начисленные бонусы сотрудника при возврате -------- </td>";
						if ($brand=='CompensationChargeBonuses') echo"<td><br>Начисленные бонусы УПЛ при возврате  -------- </td>";
						if ($brand=='CompensationWriteOffEmployeeBonuses') echo"<td><br>Списанные бонусы сотрудника при возврате ---- </td>";		
						if ($brand=='CompensationWriteOffBonuses') echo"<td><br>Списанные бонусы УПЛ при возврате ---- </td>";
						
						echo "<td> [$brand]=<b> $massiv1  </b></td></tr>"; 
						if (is_array($massiv1))		
						{	foreach($massiv1 as  $inner_key1 => $massiv2){
							echo "<tr><td class='center' colspan='2'><br><b>[$brand]=".++$inner_key1."<b><br></td></tr>";
								foreach($massiv2 as  $inner_key2 => $massiv3){
									echo '<tr class="center">';
									if ($inner_key2=='Position') echo"<td><br>Номер позиции в покупке -------- </td>";
									if ($inner_key2=='ReturnPosition') echo"<td><br>Номер возврата   -------- </td>";
									if ($inner_key2=='ProductExtId') echo"<td><br>ExtId продукта  -------- </td>";
									if ($inner_key2=='Quantity') echo"<td><br>Количество продуктов в позиции -------- </td>";
									if ($inner_key2=='Price') echo"<td><br>ДЦена за единицу  -------- </td>";
									if ($inner_key2=='TotalPrice') echo"<td><br>Общая сумма  -------- </td>";
									if ($inner_key2=='DiscountAmountPos') echo"<td><br>Сумма скидки POS -------- </td>";
									if ($inner_key2=='DiscountCodePos') echo"<td><br>Код скидки POS -------- </td>";
									if ($inner_key2=='CashPaidAmountTotal') echo"<td><br>Сумма оплаты -------- </td>";
									if ($inner_key2=='BonusesPaidAmount') echo"<td><br>Оплата бонусами -------- </td>";
									if ($inner_key2=='DiscountAmountProc') echo"<td><br>Сумма скидки правила ПЛ -------- </td>";
									if ($inner_key2=='DiscountAmountCodeProc') echo"<td><br>Код скидки правила ПЛ -------- </td>";
									if ($inner_key2=='Key') echo"<td><br>Код ошибки. -------- </td>";
									if ($inner_key2=='Value') echo"<td><br>Описание ошибки. -------- </td>";
									echo "<td><br>[$brand][$inner_key1][$inner_key2]=<b>$massiv3</b><br></td></tr>";
								}
							}
						}
					}echo '</table></div></div>';
				}
			}
}
?>

