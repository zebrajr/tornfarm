<?php
  /*
    description : switches between tr with and without bg color
    in          : $trSwitch = bool
    out         : tr with bgcolor
  */
  function trSwitcher($trSwitch){
      if ($trSwitch == false){
        echo "<tr bgcolor='lightgrey'>";
        $trSwitch = true;
      } else {
        echo "<tr>";
        $trSwitch = false;
      }
      return $trSwitch;
  }


  /*
    description : display the returned users, if the filter (column) is selected
    in          :
    out         :
  */
  function displayPlayersAsTable($players, $filters){
    $trSwitch = false;
    foreach($players as $player){
      # Row Output
      # Simple Switch to improve table user readibility
      $trSwitch = trSwitcher($trSwitch);
      foreach ($filters as $value){
        $hideName = 'show' . $value;
        $checkGetCheckbox = $_GET[$hideName];
        if(isset($checkGetCheckbox)){
          echo "<td align='center'>";

          if(($value == "playerid") OR ($value == "name")){
            echo "<a href='https://www.torn.com/profiles.php?XID='" . $player[$value] . "'>";
          }
          echo $player[$value];
          if(($value == "playerid") OR ($value == "name")){
            echo "</a>";
          }
          echo "</td>";
        }
      }
      echo "</tr>";
      }
    }

  /*
    description : display the table header, if the filter (column) is selected
    in          :
    out         :
  */
  function displayTableHeader($filters){
    echo "<tr>";
    foreach ($filters as $value){
      $hideName = 'show' . $value;
      $checkGetCheckbox = $_GET[$hideName];
      if(isset($checkGetCheckbox)){
        echo ("<th>" . $value . "</th>");
      }
    }
    echo "</tr>";
  }


  /*
    description : display filters for the sql, if the filter (column) is selected
    in          :
    out         :
  */
  function displayFilters($filters, $integerTypes, $stringTypes){
    $preName = ["maximum", "minimum"];
    foreach ($preName as $pre){
      echo "<tr>";
      if ($pre == "maximum"){
        $integerValue = 999999999999;
      }
      if ($pre == "minimum"){
        $integerValue = 0;
      }
      foreach ($filters as $value){
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
        $hideName = 'show' . $value;
        $checkGetCheckbox = $_GET[$hideName];
        if(isset($checkGetCheckbox)){
          echo "<td width='30px'>";
          echo "<input type='text' name='" . $filterName . "' value='" . $tempVariable . "' enabled size='10px'></td>";
        }
      }
      echo "</tr>";
    }
  }


  /*
    description : display the reset / update form buttons
    in          :
    out         :
  */
  function displayUpdateFilterControls($totalCols){
    if ($totalCols % 2 != 0){
      $totalcols = $totalCols - 1;
    }
    $totalCols = $totalCols / 2;
    echo "<tr>";
      echo "<td colspan='$totalCols' align='right'>";
      echo "<input type='reset' name='reset' value='Reset Filters'>";
      echo "</td>";
      echo "<td>";
      echo "<td colspan='$totalCols' align='left'>";
      echo "<input type='submit' name='Filter' value='Update Filters'>";
      echo "</td>";
      echo "</td>";
    echo "</tr>";
  }



  /*
    description : show checkboxes to select which columns should be shown
    in          :
    out         :
  */
  function displayShowHideCols($filters){
    echo "<table border='0'>";
    $colCount = 0;
    echo "<tr>";
      foreach ($filters as $value){
        $filterName = 'show' . $value;
        echo "<td align='right'>" . $value;
        echo "</td><td>: <input type='checkbox' name='" . $filterName . "'";
        $hideName = 'show' . $value;
        $checkGetCheckbox = $_GET[$hideName];
        if(isset($checkGetCheckbox)){
          echo "checked";
        }
        echo ">";
        echo "</td>";
        if ($colCount == 4){
          $colCount = 0;
          echo "</tr><tr>";
        } else {
          $colCount = $colCount + 1;
        }
      }
    echo "</tr>";
    echo "</table>";
  }

?>
