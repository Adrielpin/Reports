<?php
namespace Relatorio;

class AdsArray {

	public static function dateCliques($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$tmpArray = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(strtotime($row["day"])*1000, (int)$row["clicks"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;
			return $a;
		});

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>$value[1], 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Cliques','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function dateImpressions($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$tmpArray = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(strtotime($row["day"])*1000, (int)$row["impressions"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;
			return $a;
		});

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>$value[1], 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Impressões','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function dateCtr($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$tmpArray = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(strtotime($row["day"])*1000, (int)$row["clicks"], (int)$row["impressions"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] and $a[$b[0]][2] += $b[2] : $a[$b[0]] = $b;
			return $a;
		});

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>round((float)($value[1]/$value[2])*100,2), 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Ctr','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function datePosition($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$tmpArray = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(strtotime($row["day"])*1000, (int)$row["clicks"], (int)$row["impressions"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] and $a[$b[0]][2] += $b[2] : $a[$b[0]] = $b;
			return $a;
		});

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>round((float)($value[1]/$value[2])*100,2), 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Ctr','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function dateImpressionShare($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$tmpArray = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(strtotime($row["day"])*1000, (int)$row["clicks"], (int)$row["impressions"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] and $a[$b[0]][2] += $b[2] : $a[$b[0]] = $b;
			return $a;
		});

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>round((float)($value[1]/$value[2])*100,2), 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Ctr','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

}