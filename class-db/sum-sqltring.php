<?php
class YNDealCustom{

	public static function totalAmount($arFilter = array()){
		global $DB;
		//check input
		$arFilter['NAME'] = $DB->ForSql($arFilter['NAME']);
		
		$strSql = 'SELECT STAGE_ID , CURRENCY_ID, TITLE, SUM(OPPORTUNITY) AS TOTAL FROM b_crm_deal ';

		$sWhere .= strlen($arFilter['NAME']) > 0 ? ' TITLE LIKE \'%'.$arFilter['NAME'].'%\' AND' : '';
		$sWhere .= intval($arFilter['RESPONSIBLE']) > 0 ? ' ASSIGNED_BY_ID='.intval($arFilter['RESPONSIBLE']) . ' AND' : '';
		$sWhere .= strlen($arFilter['DATEFROM']) > 0 ? ' DATE_CREATE > \''.$arFilter['DATEFROM'] . '\' AND' : '';
		$sWhere .= strlen($arFilter['DATETO']) > 0 ? ' DATE_CREATE < \''.$arFilter['DATETO']  .'\'': '';


		$sWhere = rtrim($sWhere, 'AND');
		$strSql .= strlen($sWhere) > 0 ? 'WHERE ' . $sWhere : '';
		$strSql .= ' 	GROUP BY STAGE_ID'; 
		$res = $DB->Query($strSql);
		return $res;
	}
}
?>