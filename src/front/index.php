<?php
  error_reporting(E_ERROR | E_PARSE);
  echo "<html>";
  /*
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  */

  include "config.php";
  include "functions_header.php";
  include "rsc/databaseHelper.php";
  include "rsc/statistics.php";
  include "rsc/displayGUI.php";
  include "rsc/displayNavigation.php";
  include "oldFunctions.php";

  // Creates Headers
  func_create_header();

  echo "<body>";
  echo "<div style='margin:0 auto;'>";

  // Loads the default values for the GET properties
  include "rsc/defaultValues.php";


  // Gets the User IP
  getUserIP();

  // Estabilishes the MySQL connection
  $conn = mysqli_connect($server_name, $sqlusername, $sqlpassword, $sqldatabase)
    or die('Error connecting to MySQL server.');

  echo "<form id='filter' action='index.php' method='get'>";
  $filters = ["rank", "role", "level", "awards", "age", "playerid", "name", "faction_name", "maximum_life", "last_action", "attack_date", "totalCrimes", "totalNetworth", "xanTaken", "energyDrinkUsed", "energyRefills", "statEnhancersUsed"];
  $integerTypes = ["level", "awards", "age", "playerid", "life", "totalCrimes", "totalNetworth", "xanTaken", "energyDrinkUsed", "energyRefills", "statEnhancersUsed", "maximum_life"];
  $stringTypes = ["name", "rank", "role", "playerName", "factionName","last_action", "attack_date"];
  $totalCols = 17;

  // Display Unique Visitors count
  echo "If you want, feel free to <a href='https://www.torn.com/profiles.php?XID=2318723'>Donate</a>";
  echo "<br>Total Unique Visits: ";
  func_display_visitors($conn);
  // Display the filter sub menu
  displayShowHideCols($filters);


  echo "<table>";
  displayTableHeader($filters);
  displayFilters($filters, $integerTypes, $stringTypes);
  displayUpdateFilterControls($totalCols);

  //list($sqlString, $namedParameters) = getValuesFromForm($filters, $integerTypes, $stringTypes);
  $sqlString = getValuesFromForm($filters,$integerTypes, $stringTypes);



  $procName = "getPlayers";
   $players = getProcedure($server_name, $sqldatabase, $sqlusername, $sqlpassword, $procName, $sqlString);
  displayPlayersAsTable($players, $filters);
  echo "</table>";




  // // Create connection
  // $conn = mysqli_connect($server_name, $sqlusername, $sqlpassword, $sqldatabase)
  //   or die('Error connecting to MySQL server.');
  //
  // // Gets the first sort
  // $sort1 = $_GET["sort1"];
  // $int_selected_page = $_GET["page"];
  // $int_get_minimum_level = $_GET["minimum_level"];
  // $int_get_maximum_level = $_GET["maximum_level"];
  // $str_get_maximum_rank = $_GET["maximum_rank"];
  // $int_get_minimum_playerid = $_GET["minimum_playerid"];
  // $int_get_maximum_playerid = $_GET["maximum_playerid"];
  // $str_get_faction_name = $_GET["maximum_faction_name"];
  // $getIntMaxXanax = $_GET['intMaxXanax'];
  // $getIntMinXanax = $_GET['intMinXanax'];
  //
  //
  // // Displays the Server Stats
  // func_display_server_stats($conn);
  // echo "</table>";
  //
  // // Starts a New Table
  // echo "<table style='border:1px solid;'>";
  //
  // // Processes the $_GET if changed by the user
  // include "rsc/getProcessing.php";
  //
  // // Displays the Table Header
  // func_display_table_header();
  // // Displays Filtering Options
  // func_display_filter_options($int_minimum_level, $int_maximum_level, $str_maximum_rank, $int_minimum_playerid, $int_maximum_playerid, $str_faction_name, $intMaxXanax, $intMinXanax);
  //
  // // Gets and then Displays the Targets according to the selection (Filters + Pages)
  // $array_targets_selection = func_get_targets_selections($conn, $int_minimum_level, $int_maximum_level, $int_limit, $int_results_per_page, $str_maximum_rank, $int_minimum_playerid, $int_maximum_playerid, $str_faction_name, $intMaxXanax, $intMinXanax);
  // func_display_players($array_targets_selection);
  //
  // echo "</table>";
  //
  // // Displays the Navigation Pages
  // func_display_navigation($conn, $int_minimum_level, $int_maximum_level, $str_maximum_rank, $int_results_per_page, $int_minimum_playerid, $int_maximum_playerid, $str_faction_name, $intMaxXanax, $intMinXanax);
  //
  echo "</form>";
  // $conn->close();

  echo "</div>";
  echo "</body>";
  echo "</html>";
?>
