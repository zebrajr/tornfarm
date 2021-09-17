 <?php
  include "config.php";

  // Function to Display the Filter Options (Minimum-Maximum)
  function func_display_filter_options($int_minimum_level, $int_maximum_level, $str_maximum_rank, $int_minimum_playerid, $int_maximum_playerid, $str_faction_name, $intMaxXanax, $intMinXanax){
    # First Row, as in, "Max Values"
    echo "<tr>";
      echo "<td align='center' rowspan='2'><input type='text' value='" . $str_maximum_rank . "' name=maximum_rank></td>";
      echo "<td align='center' rowspan='2'><input type='text' placeholder='Not Implemented (Yet)' name=maximum_role disabled></td>";
      echo "<td align='center'><input type='text' value='" . $int_maximum_level . "' name=maximum_level></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=maximum_awards disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=maximum_age disabled></td>";
      echo "<td align='center'><input type='text' value='" . $int_maximum_playerid . "' name=maximum_playerid></td>";
      echo "<td align='center' rowspan='2'><input type='text' placeholder='Not Implemented (Yet)' name=maximum_playername disabled></td>";
      echo "<td align='center' rowspan='2'><input type='text' value='" . $str_faction_name . "' name=maximum_faction_name ></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=maximum_maximumlife disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=maximum_lastaction disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=maximum_lastcheck disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=maximum_totalCrimes disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=maximum_networth disabled></td>";
      echo "<td align='center'><input type='text' value ='" . $intMaxXanax . "' name=intMaxXanax ></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=maximum_energydrinks disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=maximum_energyrefills disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=maximum_se disabled></td>";
    echo "</tr>";
    echo "</tr>";
    # Second Row, as in, "Min Values"
    echo "<tr>";
      # echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_rank disabled></td>";
      # echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_role disabled></td>";
      echo "<td align='center'><input type='text' value='" . $int_minimum_level . "' name=minimum_level></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_awards disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_age disabled></td>";
      echo "<td align='center'><input type='text' value='" . $int_minimum_playerid . "' name=minimum_playerid></td>";
      # echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_playername disabled></td>";
      # echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_factionname disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_maximumlife disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_lastaction disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_lastcheck disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_totalCrimes disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_networth disabled></td>";
      echo "<td align='center'><input type='text' value='" . $intMinXanax . "' name=intMinXanax></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_energydrinks disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_energyrefills disabled></td>";
      echo "<td align='center'><input type='text' placeholder='Not Implemented (Yet)' name=minimum_se disabled></td>";
    echo "</tr>";
    echo "<tr>";
      echo "<td align='center' colspan='17'>";
        echo "<input type='submit' name='Filter' value='Update Filters'>";
      echo "</td>";
    echo "</tr>";
  }

  // Function to Display the Table Headers (Column Names)
  function func_display_table_header(){
    echo "<tr>";
      echo "<td align='center'>Rank</td>";
      echo "<td align='center'>Role</td>";
      echo "<td align='center'>Level</td>";
      echo "<td align='center'>Awards</td>";
      echo "<td align='center'>Age</td>";
      echo "<td align='center'>PlayerID</td>";
      echo "<td align='center'>Player Name</td>";
      echo "<td align='center'>Faction Name</td>";
      echo "<td align='center'>Maximum Life</td>";
      echo "<td align='center'>Last Action</td>";
      echo "<td align='center'>Last Check</td>";
      echo "<td align='center'>Total<br>Crimes</td>";
      echo "<td align='center'>Networth<br>(in M.)</td>";
      echo "<td align='center'>Xanax<br>Taken</td>";
      echo "<td align='center'>Energy<br>Drink<br>Used</td>";
      echo "<td align='center'>Energy<br>Refills</td>";
      echo "<td align='center'>SE<br>Used</td>";
    echo "</tr>";
  }




    // Function to Display the Navigation Pages
    function func_display_navigation($conn, $int_minimum_level, $int_maximum_level, $str_maximum_rank, $int_results_per_page, $int_minimum_playerid, $int_maximum_playerid, $str_faction_name, $intMaxXanax, $intMinXanax){
      $str_maximum_rank = $str_maximum_rank . '%';
      $str_faction_name = '%' . $str_faction_name . '%';
      $query = "SELECT count(id) FROM torn_list WHERE role in ('Civilian') AND level >= ? AND level <= ? AND rank LIKE ? AND faction_name LIKE ? AND playerid >= ? AND playerid <= ? and xanTaken <= ? and xanTaken >= ? ORDER BY level ASC";
      $obj_stmt_navigation = $conn->prepare($query);
      $obj_stmt_navigation->bind_param('iissiiii', $int_minimum_level, $int_maximum_level, $str_maximum_rank, $str_faction_name, $int_minimum_playerid, $int_maximum_playerid, $intMaxXanax, $intMinXanax);
      $obj_stmt_navigation->execute();
      $obj_stmt_navigation->bind_result($result_id);
      while($row = $obj_stmt_navigation->fetch()){
        $int_total_result = $result_id;
      }
      $int_total_pages = ceil($int_total_result / $int_results_per_page);
      echo "<table style='border:1px solid;'>";
      echo "<tr><td align='center' colspan='30'><b>Navigation Pages</b></td></tr>";
      echo "<tr>";
      for ($i = 1; $i <= $int_total_pages; $i++){
        if (($i % 30) == 1){
          echo "</tr><tr>";
        }
        echo "<td align='center'><input type='submit' name='page' value='" . $i . "'></td>";
      }
      echo "</tr></table>";
    }


  # Function to display the values from each indexed user in a Table Format
  function func_display_players($array_targets_selection){
    // $tr_switch is used to create the effect of a table design
    // using a bgcolor for the tr
    $tr_switch = false;
    foreach($array_targets_selection as $value){
      # Row Output
      # Simple Switch to improve table user readibility
      if ($tr_switch == false){
        echo "<tr bgcolor='lightgrey'>";
        $tr_switch = true;
      } else {
        echo "<tr>";
        $tr_switch = false;
      }
      # Actual Row information (Player Rank, Level, Name, etc)
      echo "<td align='center'>" . $value['rank'] . "</td>";
      echo "<td align='center'>" . $value['role'] . "</td>";
      echo "<td align='center'>" . $value['level'] . "</td>";
      echo "<td align='center'>" . $value['awards'] . "</td>";
      echo "<td align='center'>" . $value['age'] . "</td>";
      echo "<td align='center'><a href='https://www.torn.com/profiles.php?XID=" . $value['playerid'] . "' target='_blank'>" . $value['playerid'] . "</td>";
      echo "<td align='center'><a href='https://www.torn.com/profiles.php?XID=" . $value['playerid'] . "' target='_blank'>" . $value['name'] ."</td>";
      echo "<td align='center'>" . $value['faction_name'] . "</td>";
      echo "<td align='center'>" . $value['maximum_life'] . "</td>";
      echo "<td align='center'>" . $value['last_action'] . "</td>";
      echo "<td align='center'>";
        if($value['attack_date'] == "0000-00-00"){echo "";} else {echo $value['attack_date'];};
      echo "</td>";
      echo "<td align='center'>" . $value['totalCrimes'] . "</td>";
      echo "<td align='center'>";
        echo round(($value['totalNetworth']/1000000), 2);
      echo "</td>";
      echo "<td align='center'>" . $value['xanTaken'] . "</td>";
      echo "<td align='center'>" . $value['energyDrinkUsed'] . "</td>";
      echo "<td align='center'>" . $value['energyRefills'] . "</td>";
      echo "<td align='center'>" . $value['statEnchancersUsed'] . "</td>";
      echo "</tr>";
    }
  }


  # Function to get the values from the SQL Database
  # [TODO] Should be converted to sql_procedures
  function func_get_targets_selections($conn, $int_minimum_level, $int_maximum_level, $int_limit, $int_results_per_page, $str_maximum_rank, $int_minimum_playerid, $int_maximum_playerid, $str_faction_name, $intMaxXanax, $intMinXanax){
    $str_maximum_rank = $str_maximum_rank . '%';
	$str_faction_name = '%' . $str_faction_name . '%';
    $query = "SELECT rank, role, level, awards, age, playerid, name, faction_name, maximum_life, last_action, attack_date, totalCrimes, totalNetworth, xanTaken, energyDrinkUsed, energyRefills, statEnhancersUsed FROM torn_list WHERE role in ('Civilian') ";
    $query .= "AND level >= ? AND level <= ? AND rank LIKE ? AND faction_name LIKE ? AND playerid >= ? and playerid <= ? and xanTaken <= ? and xanTaken >= ? ORDER BY level ASC LIMIT ?, ?";
    $obj_stmt_query_players = $conn->prepare($query);
    $obj_stmt_query_players->bind_param('iissiiiiii', $int_minimum_level, $int_maximum_level, $str_maximum_rank, $str_faction_name, $int_minimum_playerid, $int_maximum_playerid, $intMaxXanax, $intMinXanax, $int_limit, $int_results_per_page);
    $obj_stmt_query_players->execute();
    $obj_stmt_query_players->bind_result($result_rank, $result_role, $result_level, $result_awards, $result_age, $result_playerid, $result_name, $result_faction_name, $result_maximum_life, $result_last_action, $result_attack_date, $result_totalCrimes, $result_totalNetworth, $result_xanTaken, $result_energyDrinkUsed, $result_energyRefills, $result_statEnchancersUsed);
    $array_targets_selection = array();
    while($row = $obj_stmt_query_players->fetch()){
      $array_values = array();
      $array_values["rank"] = $result_rank;
      $array_values["role"] = $result_role;
      $array_values["level"] = $result_level;
      $array_values["awards"] = $result_awards;
      $array_values["age"] = $result_age;
      $array_values["playerid"] = $result_playerid;
      $array_values["name"] = $result_name;
      $array_values["faction_name"] = $result_faction_name;
      $array_values["maximum_life"] = $result_maximum_life;
      $array_values["last_action"] = $result_last_action;
      $array_values["attack_date"] = $result_attack_date;
      $array_values["totalCrimes"] = $result_totalCrimes;
      $array_values["totalNetworth"] = $result_totalNetworth;
      $array_values["xanTaken"] = $result_xanTaken;
      $array_values["energyDrinkUsed"] = $result_energyDrinkUsed;
      $array_values["energyRefills"] = $result_energyRefills;
      $array_values["statEnchancersUsed"] = $result_statEnchancersUsed;
      $array_targets_selection[] = $array_values;
    }
    $obj_stmt_query_players->close();
    return $array_targets_selection;
  }



    // Function to add IP to the DB if it's a new IP
    // [TODO] Add SQL Injection Protection
    function func_display_visitors($conn){
        $user_ip = getUserIP();
        $sql = "SELECT * FROM visitors WHERE IP = " . "'" . $user_ip . "'" ;
        $result = $conn->query($sql);
        if ($result->num_rows <= 0){
          $sql = "INSERT INTO `visitors` (`ip`) VALUE (" . "'" . $user_ip . "'" . ")";
          $conn->query($sql);
        }
        $sql = "SELECT COUNT(ID) FROM visitors";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        #$result = $conn->query($sql);
        #$row = $result->fetch_assoc());
        #$visits = $row['count(id)'];
        echo $row[0];
    }


    // Function to Display the Server Stats (Visitors, Indexed players, Last Update etc)
    function func_display_server_stats($conn){
      // Gets a total of Available IDs
      $obj_stmt_targets_count_query = $conn->prepare("SELECT COUNT(ID) FROM torn_list");
      $obj_stmt_targets_count_query->execute();
      $obj_stmt_targets_count_query->bind_result($obj_stmt_targets_count_query_count);
      while($row = $obj_stmt_targets_count_query->fetch()){
        $int_count_targets = $obj_stmt_targets_count_query_count;
      }
      $obj_stmt_targets_count_query->close();

      // Gets a total of Ignored IDs
      $obj_stmt_ignored_count_query = $conn->prepare("SELECT COUNT(id) FROM torn_list_ignored");
      $obj_stmt_ignored_count_query->execute();
      $obj_stmt_ignored_count_query->bind_result($obj_stmt_ignored_count_query_count);
      while($row = $obj_stmt_ignored_count_query->fetch()){
        $int_count_ignored = $obj_stmt_ignored_count_query_count;
      }
      $obj_stmt_ignored_count_query->close();

    // Gets Last time since update tbl.torn_list
    # [TODO] TableSchema name should be read from config
    $obj_stmt_last_update_query = $conn->prepare("SELECT UPDATE_TIME FROM information_schema.tables WHERE TABLE_SCHEMA = 'tornFarm' AND TABLE_NAME = 'torn_list'");
    $obj_stmt_last_update_query->execute();
    $obj_stmt_last_update_query->bind_result($obj_stmt_last_update_datetime);
    while($row = $obj_stmt_last_update_query->fetch()){
      $str_last_update_datetime = $obj_stmt_last_update_datetime;
    }
    $obj_stmt_last_update_query->close();

      // Sum Available with Ignored IDs
      $int_total_targets = $int_count_targets + $int_count_ignored;

      // Displays the information
      echo "<tr>";
      echo "<td align='center'>Last Update (Frontend): <b>2021-07-15 20:00:00</b></td>";
      echo "<td align='center'>Total IDs Indexed: <b>" . $int_total_targets . "</b></td>";
      echo "</tr><tr>";
      echo "<td align='center'>Last Update (Database): <b>" . $str_last_update_datetime . "</b></td>";
      echo "<td align='center'>Total Players Indexed: <b>" . $int_count_targets . "</b></td>";
      echo "</tr>";
    }



?>
