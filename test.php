<?php


/*
$json = json_decode(json_encode($json, true));

$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode(json_encode(file_get_contents("querys.json"), true))),
    RecursiveIteratorIterator::SELF_FIRST);
foreach ($jsonIterator as $key => $val) {
    echo $val ."\n";

    if(is_array($val)) {
        //echo "$key:\n";
    } else {
        //echo "$key => $val\n";
    }
}

$json = json_decode(json_encode(file_get_contents("querys.json"), true));//json_decode(file_get_contents("querys.json"), true); //;//

foreach($json as $key => $value) {
    echo $value->root;
}
*/


$jsonData = file_get_contents("querys.json");
$json = json_decode($jsonData, true);

getDataJson($json);


/*
foreach($json as $key => $val) {
    if(is_array($val)) {
        echo "$key:\n";
    } else {
        echo "$key => $val\n";
    }
}
*/

//echo $json['root'][0];

/*
foreach ($json as $key => $value) {
    if (!is_array($value)) {
        echo $key . '=>' . $value . '<br/>';
    } else {
        foreach ($value as $key => $val) {
            echo $key . '=>' . $val . '<br/>';
        }
    }
}
*/


function getDataJson($json){

    $columns = array();
    $column = new stdClass();

    foreach ($json as $key => $value) {
        if ($key == "columns") {
            if (is_array($value)) {
                foreach ($value as $col => $valCol) {
                    foreach ($valCol as $col => $valCol) {
                        if($col == 'expr'){
                            foreach ($valCol as $k => $v) {
                                if ($k == "id") {
                                    $column->col = $v;
                                    $column->func = "";
                                    array_push($columns, $column);
                                }
                                if ($k == "func") {
                                    $column->func = $v;
                                }
                                if ($k == "argument") {
                                    foreach ($v as $k1 => $v1) {
                                         if($k1 == "id"){
                                             $column->col = $v1;
                                         }
                                    }
                                    array_push($columns, $column);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    echo sizeof($columns);


    foreach($columns as $c) {
        echo $c->col . "  ". $c->func . '<br/>';
    }
/*
      if (is_array($col)) {
        foreach ($key1 as $key2 => $value2) {
            if ($key2 == "id") {
                array_push($columns, $value2);
             }
         }
       }


                if (!is_array($value)) {
                    echo $key . '=>' . $value . '<br/>';
                } else {
                    foreach ($value as $key => $value) {
                        echo $key . '=>' . $value . '<br/>';
                    }
                }


            /*
            if (!is_array($value)) {
                echo $key . '=>' . $value . '<br/>';
            } else {
                foreach ($value as $key => $val) {
                    echo $key . '=>' . $val . '<br/>';
                }
            }*/



/*
    foreach($json as $key => $val) {
        if(is_array($key)){
            //echo "$key => $val". "<br>";
            getDataJson($key as $keys);
        }
        else{
            //echo "$key => $val". "<br>";
        }
    }
    */

}