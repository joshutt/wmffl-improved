<?php require_once "utils/start.php";
if (!$isin) {
    header("Location: http://wmffl.com");
    exit();
}

$errorMessage = "";
if (isset($change)) {
    if ($user != $username) {
        $errorMessage = "You can only change the password for your account";
    } else if ($newpassword1 != $newpassword2) {
        $errorMessage = "New passwords did not match each other";
    } else if ($oldpassword == $newpassword1) {
        $errorMessage = "Can not set new password to current password";
    } else {
        $errorMessage = "Success";

        // Make sure that the old password matches entered password
//        $theQuery = "SELECT name, email FROM user WHERE username='$username' AND (password=PASSWORD('$oldpassword') or password=MD5('$oldpassword'))";
        $thisQuery = $conn->createQueryBuilder()
            ->select("name","email")
            ->from("user")
            ->where("username=:username")
            ->andWhere("password=PASSWORD(:password) OR password=MD5(:password)")
            ->setParameter("username", $username)
            ->setParameter("password", $oldpassword);
        $result = $thisQuery->execute()->fetchAll(\Doctrine\DBAL\FetchMode::ASSOCIATIVE);
        $numrow = count($result);
        var_dump($result);

        if ($numrow != 1) {
            $errorMessage = "Old password does not equal current password";
        } else {
            $name = $result[0]['name'];
            $email = $result[0]['email'];

            // Save password in database
            $theQuery = $conn->createQueryBuilder()
                ->update("user")
                ->set("password", "MD5(:newpassword)")
                ->where("username=:user")
                ->setParameter("newpassword", $newpassword1)
                ->setParameter("user", $user);
            $theQuery->execute() or die("An error occured: " . $conn->error);

            // Send email confirming change
            $body = "$name,

Your password has been changed as you requested.  Please remember that your password is case sensitive.  If you ever forget your password you may have one generated for you automaticly.  Thank you.


Webmaster WMFFL";

            mail($email, "Notice of Password Change", $body, "From: webmaster@wmffl.com");
            header("Location: thankschange.php");
            exit();
        }
    }
}

$title = "Change Password";
?>


<?php include "base/menu.php"; ?>

<h1 align="center">Change WMFFL Password</h1>
<hr size="1"/>

<p><font color="red" size="+1" align="center">
<?php print $errorMessage; ?></font></p>

<form method="post" action="newpassword.php">
    <input type="hidden" name="change" value="true"/>
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" value="<?php print $user; ?>"/></td>
        </tr>

        <tr>
            <td>Old Password:</td>
            <td><input type="password" name="oldpassword"/></td>
        </tr>

        <tr>
            <td>New Password:</td>
            <td><input type="password" name="newpassword1"/></td>
        </tr>

        <tr>
            <td>Retype New Password:</td>
            <td><input type="password" name="newpassword2"/></td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Change Password"/>
            </td>
        </tr>
    </table>
</form>


<?php include "base/footer.php"; ?>
