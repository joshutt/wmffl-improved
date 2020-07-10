<?php //require_once "base/conn.php";

if (isset($conn)) {
    // Determine the current season and current week
    $dateQuery = "SELECT season, week, weekname FROM weekmap ";
    $dateQuery .= "WHERE now() BETWEEN startDate and endDate ";
    $dateResult = $conn->query( $dateQuery);
    list($currentSeason, $currentWeek, $weekName) = $dateResult->fetch(\Doctrine\DBAL\FetchMode::NUMERIC);
}
?>
