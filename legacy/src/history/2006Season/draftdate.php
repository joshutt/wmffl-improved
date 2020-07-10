<?php require_once "utils/start.php";

$title = "Determine Draft Date";
include "base/menu.php";
?>

<H1 ALIGN=Center>Draft Date Open</H1>
<HR size = "1"/>

<?php if ($isin) {
    $thequery = "SELECT DATE_FORMAT(d.date, '%m%e'), DATE_FORMAT(d.date, '%W, %M %D'), d.attend ";
    $thequery .= "FROM draftdate d, user u WHERE d.userid=u.userid and u.username='$user' AND d.date BETWEEN '2006-07-01' AND '2006-10-01' ORDER BY d.date";
    $results = $conn->query( $thequery);

?>

<p>The 2006 draft has been selected for August 26th.  The exact time and location will be announced at a future time.  If you are unable to attend on this day, please let Josh know.  Thanks.</p>

<!--
<P>The default date for the draft is August 26th.  As always we check to see if
a better date is available.  Please fill out the below form, letting us know 
when you can NOT make the draft.  The date will be announced on or about June 26.</P>
<P>NOTE: Monday, September 4th is Labor Day, all other days under consideration are
weekend days.
</P>

<P><FORM ACTION="processdraftdate.php" METHOD="POST">

<TABLE BORDER=1>
<TR><TH WIDTH=30%>Can Attend?</TH><TH WIDTH=70%>Date</TH></TR>

<?php while (list($date, $fulldate, $attend) = $results->fetch(\Doctrine\DBAL\FetchMode::NUMERIC)) {
        print "<TR><TD><INPUT TYPE=\"radio\" NAME=\"$date\" VALUE=\"Y\" ";
        if ($attend == 'Y') print "CHECKED ";
        print "/>Yes<INPUT TYPE=\"radio\" NAME=\"$date\" VALUE=\"N\" ";
        if ($attend == 'N') print "CHECKED ";
        print "/>No</TD><TD>$fulldate</TD></TR>";
    }
?>

<TR><TD COLSPAN=2 ALIGN=Center><INPUT TYPE="Submit" VALUE="Submit"></TD></TR>

</TABLE>
</FORM>
</P>
-->
<?php } else {
?>

<CENTER><B>You must be logged in to use this feature</B></CENTER>

<?php }
include "base/footer.html";
?>

