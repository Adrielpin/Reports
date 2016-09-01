<?php
namespace Relatorio\Services;

class AdsArray {

	public static function dateCliques($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$cliques = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(date('Y-m-d', strtotime($row["day"])), (int)$row["clicks"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;
			return $a;
		});

		foreach ($tmp as $value) {
			array_push($cliques, array('c'=>['v'=>$value[0], 'f'=>null],['v'=>$value[1], 'f'=>null]));
		}

		$cliques = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Cliques','pattern'=>null,'type'=>'number')),'rows'=>$cliques);
		return json_encode($cliques, JSON_PRETTY_PRINT);

	}

}