<?php

/**
 * Classe transforma xml em objetos JSON utilizadas na construção de grafico
 *	Em proxima refactory trasformar a classe para utilização de LAVACHART ja incrementada no composer.json
 * 
 * @author Adriel Pinheiro <adriel.pinheiro@clinks.com.br> 
 */

namespace Relatorio;

class dateArrays {


	public static function cliques($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$tmpArray = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(strtotime($row["day"])*1000 , (int)$row["clicks"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;
			return $a;
		});

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>$value[1], 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Cliques','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function impressoes($returned) {
		
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

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>$value[1], 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Impressões','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function cpc($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$tmpArray = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(strtotime($row["day"])*1000, (int)$row["cost"]/1000000, (int)$row["clicks"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] and $a[$b[0]][2] += $b[2] : $a[$b[0]] = $b;
			return $a;
		});

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>($value[2] == 0) ? 0 : round((float)($value[1]/$value[2])*100,2), 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Cpc','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function investimento($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$tmpArray = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(strtotime($row["day"])*1000, (int)$row["cost"]/1000000));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;
			return $a;
		});

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>$value[1], 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Investimento','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function ctr($returned) {
		
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

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>($value[2] == 0) ? 0 : round((float)($value[1]/$value[2])*100,2), 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Ctr','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function position($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$tmpArray = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(strtotime($row["day"])*1000, (int)$row["impressions"]*(int)$row["avgPosition"], (int)$row["impressions"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] and $a[$b[0]][2] += $b[2] : $a[$b[0]] = $b;
			return $a;
		});

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>($value[2] == 0) ? 0 : round((float)($value[1]/$value[2]),1), 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Posição','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function conversao($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$tmpArray = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(strtotime($row["day"])*1000, (int)$row["conversions"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;
			return $a;
		});

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>$value[1], 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Conversoes','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);


	}

	public static function custoConversao($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$tmpArray = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(strtotime($row["day"])*1000, (int)$row["cost"]/1000000, (int)$row["conversions"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] and $a[$b[0]][2] += $b[2] : $a[$b[0]] = $b;
			return $a;
		});

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>($value[2] == 0) ? 0 : round((float)($value[1]/$value[2]),2), 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Custo por conversao','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function taxaConversao($returned) {
		
		$xml = simplexml_load_string($returned);
		$xml = $xml->table;
		
		$tmpArray = array();
		$tmp = array();

		foreach ($xml as $col) {
			foreach($col as $row) {
				array_push($tmp, array(strtotime($row["day"])*1000, (int)$row["clicks"], (int)$row["conversions"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] and $a[$b[0]][2] += $b[2] : $a[$b[0]] = $b;
			return $a;
		});

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>($value[2] == 0) ? 0 : round((float)($value[1]/$value[2])*100,2), 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Taxa de conversao','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function conversaoVisualizacao($returned) {
		
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

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>($value[2] == 0) ? 0 : round((float)($value[1]/$value[2])*100,2), 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Ctr','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function totalConversao($returned) {
		
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

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>($value[2] == 0) ? 0 : round((float)($value[1]/$value[2])*100,2), 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Ctr','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function taxaConversaoTotal($returned) {
		
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

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>($value[2] == 0) ? 0 : round((float)($value[1]/$value[2])*100,2), 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Ctr','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function custoConvesaoTotal($returned) {
		
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

		asort($tmp);

		foreach ($tmp as $value) {
			array_push($tmpArray, array('c'=>array(array('v'=>"Date($value[0])", 'f'=>null), array('v'=>($value[2] == 0) ? 0 : round((float)($value[1]/$value[2])*100,2), 'f'=>null))));
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Ctr','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function searchImpressionShare($returned){

		$xml = simplexml_load_string($returned);
		$xml = $xml->table;

		$tmpArray = array();
		$tmp = array();
		$tmp_2 = array();
		$val = 0;

		foreach ($xml as $col) {
			foreach($col as $row) {
				((float)$row["searchImprShare"] < 11 || (float)$row["searchImprShare"] > 89) ? $val = (100-((float)$row["searchLostISBudget"]+(float)$row["searchLostISRank"])) : $val = (float)$row["searchImprShare"];
				array_push($tmp, array(strtotime($row["day"])*1000, ($val == 0) ? 0 : ((int)$row["impressions"]/$val)*100));
				array_push($tmp_2, array(strtotime($row["day"])*1000, (int)$row["impressions"]));
			}
		}

		$tmp = array_reduce($tmp,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;
			return $a;
		});

		$tmp_2 = array_reduce($tmp_2,function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;
			return $a;
		});

		asort($tmp);

		foreach ($tmp as $value_1) {
			foreach ($tmp_2 as $value_2) {
				($value_1[0] == $value_2[0]) ? array_push($tmpArray, array('c'=>array(array('v'=>"Date($value_1[0])", 'f'=>null), array('v'=>($value_1[1] == 0) ? 0 : round(($value_2[1]/$value_1[1])*100, 2), 'f'=>null)))) : null;
			}
		}

		$tmpArray = array('cols'=>array(array('id'=>null, 'label'=>'Data','pattern'=>null ,'type'=>'date'),array('id'=>null,'label'=>'Parcela de Impressão','pattern'=>null,'type'=>'number')),'rows'=>$tmpArray);
		return json_encode($tmpArray, JSON_PRETTY_PRINT);

	}

	public static function searchImpressionxCost($returnded){

	}

	public static function searchImpressionxCliks($returnded){
		
	}

	public static function searchImpressionxImpressions($returnded){
		
	}

	public static function searchImpressionxConversions($returnded){
		
	}

	public static function searchImpressionxTotalConversions($returnded){
		
	}

}