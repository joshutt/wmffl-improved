<?php
$title = "The WMFFL Fantasy Football League";

$cssList = array("/base/css/index.css");
$javascriptList = array("/base/js/front.js");
//$cssList = array("/legacy/css/index.css");
//$javascriptList = array("/legacy/js/front.js");
include "base/menu.php";

require_once "utils/setup.php";

?>

<table width="100%" border="0">
    <TR>
        <TD VALIGN="top" width="*">

            <div class="card m-1">
                <?php include "article.php" ?>
            </div>
            <div class="card m-1">
                <?php include "quicklinks.php"; ?>
            </div>

        </TD>

        <td align="right" valign="top" width="260">
            <div class="card m-1">
                <?php include "scores.php" ?>
            </div>
            <div class="card m-1">
                <?php include "standings.php" ?>
            </div>
            <div class="card m-1">
                <?php include "forum/commentlist.php" ?>
            </div>
        </td>

    </TR>



</TABLE>

<?php
include "base/footer.php";
?>
