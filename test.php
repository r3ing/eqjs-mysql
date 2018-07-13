<?php

$jsonData = file_get_contents("querys.json");
$json = json_decode($jsonData, true);

getDataJson($json);

function getDataJson($json){

    $columns = new ArrayObject();
    $column = new stdClass();
    //column $c->col
    //order by $c->sort
    //function $c->func

    $conditions = new ArrayObject();
    $condition = new stdClass();
    //column $c->col
    //where $c->oper
    //value $c->value
    //dataType $c->type

    foreach ($json as $k => $v) {

        //conditions
        if($k == 'root'){
            foreach ($v as $k => $v) {
                if($k == 'conditions' && sizeof($v) > 0){
                    foreach ($v as $k => $v) {
                        foreach ($v as $k => $v) {
                            if($k == 'enabled' && !$v){
                                break;
                            }
                            if($k == 'operatorID'){
                                $condition->oper = $v;
                            }
                            if($k == 'expressions'){
                                foreach ($v as $k => $v) {
                                    foreach ($v as $k => $v) {
                                        if ($k == 'id') {
                                            $condition->col = $v;
                                        }
                                        if ($k == 'dataType') {
                                            $condition->type = $v;
                                        }
                                        if ($k == 'value') {
                                            $condition->value = $v;
                                            $conditions->append($condition);
                                            $condition = new stdClass();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

       //columns
       if ($k == 'columns' && sizeof($v) > 0) {
           foreach ($v as $k => $v) {
               foreach ($v as $k => $v) {
                   if($k == 'sorting'){
                       if ($v == 'Ascending'){
                           $column->sort = 'ASC';
                       }
                       elseif ($v == 'Descending') {
                           $column->sort = 'DESC';
                       }
                       else{
                           $column->sort = '';
                       }
                   }
                   if($k == 'expr'){
                       foreach ($v as $k => $v) {
                           if ($k == 'id') {
                               $column->col = $v;
                               $column->func = '';
                               $columns->append($column);
                               $column = new stdClass();
                           }

                           if ($k == 'func') {
                               $column->func = $v;
                           }
                           if ($k == 'argument') {
                               foreach ($v as $k => $v) {
                                    if($k == 'id'){
                                        $column->col = $v;
                                        $columns->append($column);
                                        $column = new stdClass();
                                    }
                               }
                           }
                       }
                   }
               }
           }
       }
    }

}
