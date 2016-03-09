<?
AddEventHandler("sale", "OnSaleStatusOrder", "OnSaleStatusOrderHandler");	
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");

function OnSaleStatusOrderHandler($ID,$val)
{
		AddMessage2Log($ID." ".$val, "my_module_id");
	if($val == 'F') {
		AddMessage2Log($ID." ".$val, "my_module_id");
		
		CModule::IncludeModule('sale');
		
		$arOrder = CSaleOrder::GetByID($ID);
		
		$arFilter = Array(
		   "USER_ID" => $arOrder['USER_ID'],
		   'STATUS_ID' => 'F',
		);

		$sum = 0;
		$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
		while ($ar_sales = $db_sales->Fetch())
		{
		   $sum += $ar_sales["PRICE"];
		}
		
		AddMessage2Log("sum = ".$sum, "my_module_id");
		
		$arGroups = array(3,4);
		if($sum <10000)
		{
			$arGroups[] = 5;
			CUser::SetUserGroup($arOrder['USER_ID'], $arGroups);
		}
		if($sum >= 10000 && $sum <30000)
		{
			$arGroups[] = 6;
			CUser::SetUserGroup($arOrder['USER_ID'], $arGroups);
		}
		else if ($sum >= 30000 && $sum <40000)
		{
			$arGroups[] = 7;
			CUser::SetUserGroup($arOrder['USER_ID'], $arGroups);
		}
		else if ($sum >= 40000 && $sum <50000)
		{
			$arGroups[] = 8;
			CUser::SetUserGroup($arOrder['USER_ID'], $arGroups);
		}
		else if ($sum >= 50000 && $sum <60000)
		{
			$arGroups[] = 9;
			CUser::SetUserGroup($arOrder['USER_ID'], $arGroups);
		}
		else if ($sum >= 60000 && $sum <70000)
		{
			$arGroups[] = 10;
			CUser::SetUserGroup($arOrder['USER_ID'], $arGroups);
		}
		else if ($sum >= 70000 && $sum <80000)
		{
			$arGroups[] = 11;
			CUser::SetUserGroup($arOrder['USER_ID'], $arGroups);
		}
		else if ($sum >= 80000 && $sum <90000)
		{
			$arGroups[] = 12;
			CUser::SetUserGroup($arOrder['USER_ID'], $arGroups);
		}
		else if ($sum >= 100000)
		{
			$arGroups[] = 13;
			CUser::SetUserGroup($arOrder['USER_ID'], $arGroups);
		}
		
		//mail('kaner@rambler.ru','1111',$sum);
		/*
		if(count($arGroups)>2)
		{
			$ID = $arOrder['USER_ID'];
			CUser::Logout();
			CUser::Authorize($ID);
		}
		*/
	}
}
	
?>