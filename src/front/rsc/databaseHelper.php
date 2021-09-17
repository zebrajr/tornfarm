<?php
  /*
    description :
    in          :
    out         :
  */
  # Function to get the values from the SQL Database
  # [TODO] Should be converted to sql_procedures
  function getProcedure($serverName, $dbName, $dbUser, $dbPwd, $procName, $inValues){
    $sqlString = "CALL " . $procName . "(";
    foreach ($inValues as $value){
      $sqlString = $sqlString . "'" . $value . "', ";
    }
    $sqlString = rtrim($sqlString, ", ");
    $sqlString = $sqlString . ")";
    //echo $sqlString;
    $mysqli = new mysqli($serverName, $dbUser, $dbPwd, $dbName);
    //$result = $mysqli->query("CALL getPlayers('%', '%')");
    $result = $mysqli->query($sqlString);
    #var_dump($result->fetch_assoc());
    return $result;
  }



  /*
    description :
    in          :
    out         :
  */
  function getValuesFromForm($filters, $integerTypes, $stringTypes){
    $sqlStringSETs = "";
    $namedParameters = "CALL getPlayers (";
    $preName = ["maximum", "minimum"];
    $sqlStringVariables = [];
    foreach ($filters as $value){
      // Switch between Maximum and Minimum do to SQL Procedure Logic
      foreach ($preName as $pre){
        if($value == "role"){
          continue;
        }
        if ($pre == "maximum"){
          $integerValue = 999999999999;
        }
        if ($pre == "minimum"){
          $integerValue = 0;
        }
        $filterName = $pre . $value;
        $checkGet = $_GET[$filterName];
        if (in_array($value, $integerTypes)){
          $tempVariable = $integerValue;
        }
        if (in_array($value, $stringTypes)){
          $tempVariable = '%';
        }
        if(isset($checkGet)){
          $tempVariable = $checkGet;
        }
        //$sqlStringVariables = $sqlStringSETs . "SET @$filterName = '$tempVariable'; ";
        //$namedParameters = $namedParameters . "@$filterName, ";
        $sqlStringVariables[] = $tempVariable;
      }
    }
    // $namedParameters = rtrim($namedParameters, ", ");
    // $namedParameters = $namedParameters . ");";
    // return array($sqlStringVariables, $namedParameters);
    return $sqlStringVariables;
  }

 ?>
