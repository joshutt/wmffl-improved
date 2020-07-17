<?php require_once "utils/start.php";
?>

<html>
<head>
    <title>Leave Comment</title>
    <script type="text/javascript" src="javascript/tiny_mce/tiny_mce.js"></script>

    <script type="text/javascript">
tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
            remove_linebreaks: true
});
    </script>

</head>

<?php include "base/menu.php"; ?>

<h1 align="center">Enter Comment</h1>
<hr/>

<?php if (!$isin) {
?>
<b>You must be logged in to submit a Trash Talk entry</b>
<?php } else {
?>

<form action="processEntry.php" method="post">
    <b>Subject:</b><br/>
<input type="text" size="60" name="subject"/><br/>
<b>Body:</b><br/>
<textarea name="body" cols="60" rows="20">
</textarea><br/>
<center>
<input type="submit" value="Submit Entry"/>
</center>

</form>

<?php }
?>

<?php include "base/footer.php"; ?>
