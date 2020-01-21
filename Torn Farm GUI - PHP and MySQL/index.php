<?php
  echo "<html>";
  /*
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  */
  
  include "config.php";
  include "functions_header.php";
  include "functions.php";

  // Creates Headers
  func_create_header();

  echo "<body>";
  echo "<div style='margin:0 auto;'>";

  // Declare variables
  $int_results_per_page = 100;
  $int_minimum_level = 5;
  $int_maximum_level = 100;
  $int_minimum_playerid = 1;
  $int_maximum_playerid = 3500000;
  $int_limit = 0;
  $str_faction_name = '%';
  $str_maximum_rank = '%';


  // Gets the User IP
  getUserIP();

  // Estabilishes the MySQL connection
  $conn = mysqli_connect($server_name, $sqlusername, $sqlpassword, $sqldatabase)
    or die('Error connecting to MySQL server.');

  // Display Unique Visitors count
  echo "<form id='filter' action='index.php' method='post'>";
  echo "<table border='0' width='100%>";
  echo "<tr>";
  echo "<td colspan='3' align='center'>";
  echo "Total Unique Visits: ";

  func_display_visitors($conn);
  echo "</td>";
  echo "</tr>";

  // Create connection
  $conn = mysqli_connect($server_name, $sqlusername, $sqlpassword, $sqldatabase)
    or die('Error connecting to MySQL server.');

  // Gets the first sort
  $sort1 = $_GET["sort1"];
  $int_selected_page = $_POST["page"];
  $int_post_minimum_level = $_POST["minimum_level"];
  $int_post_maximum_level = $_POST["maximum_level"];
  $str_post_maximum_rank = $_POST["maximum_rank"];
  $int_post_minimum_playerid = $_POST["minimum_playerid"];
  $int_post_maximum_playerid = $_POST["maximum_playerid"];
  $str_post_faction_name = $_POST["maximum_faction_name"];

  // Displays the Server Stats
  func_display_server_stats($conn);
  echo "</table>";

  // Starts a New Table
  echo "<table style='border:1px solid;'>";


  // SQL SELECT to get Indexed Players
  // If the Minimum Level Filter was changed
  if (isset($int_post_minimum_level)){
    $int_minimum_level = $int_post_minimum_level;
  }
  // If the Maximum Level Filter was changed
  if (isset($int_post_maximum_level)){
    $int_maximum_level = $int_post_maximum_level;
  }
  // If the Maximum Rank was changed
  if (isset($str_post_maximum_rank)){
    $str_maximum_rank = $str_post_maximum_rank;
  }
  // If the Minimum PlayerID was changed
  if (isset($int_post_minimum_playerid)){
    $int_minimum_playerid = $int_post_minimum_playerid;
  }
  // If the Maximum PlayerID was changed
  if (isset($int_post_maximum_playerid)){
    $int_maximum_playerid = $int_post_maximum_playerid;
  }
  // If the Faction Name was changed
  if (isset($str_post_faction_name)){
	$str_faction_name = $str_post_faction_name;
  }
  
  
  // Handler for the Page Selection. Default to user selected, else to page 1
  if (isset($int_selected_page)){
    $int_limit = ($int_selected_page-1) * $int_results_per_page;
  }

  // Displays the Table Header
  func_display_table_header();
  // Displays Filtering Options
  func_display_filter_options($int_minimum_level, $int_maximum_level, $str_maximum_rank, $int_minimum_playerid, $int_maximum_playerid, $str_faction_name);

  // Gets and then Displays the Targets according to the selection (Filters + Pages)
  $array_targets_selection = func_get_targets_selections($conn, $int_minimum_level, $int_maximum_level, $int_limit, $int_results_per_page, $str_maximum_rank, $int_minimum_playerid, $int_maximum_playerid, $str_faction_name);
  func_display_players($array_targets_selection);

  echo "</table>";

  // Displays the Navigation Pages
  func_display_navigation($conn, $int_minimum_level, $int_maximum_level, $str_maximum_rank, $int_results_per_page, $int_minimum_playerid, $int_maximum_playerid, $str_faction_name);

  echo "</form>";
  $conn->close();

  echo "</div>";
  echo "</body>";
  echo "</html>";
?>
