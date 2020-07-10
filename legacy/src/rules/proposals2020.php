<?php
$title = "WMFFL Rule Proposals";

$cssList = array("rules.css");
include "base/menu.php"; 
?>

<h1 align=center>Current Rule Proposals</h1>
<hr SIZE = "1"/>

<p>This is the list of proposals to be voted on for the 2018 WMFFL season.
If you would like to suggest a rule proposal, you may
do so on the <a href="proposesubmit.php">proposals page</a>.  The part of
each proposal that appears in <i>Italics</i> is what effect this proposal will
have on the ruleset, if passed.</p>

<div class="card m-2 p-2 bg-light">
<b>Proposal 2020.1 - Add Injured Reserve</b>
<b>Sponsor: Jon Hall </b><br/>
<span class="ballot">Status: <span class="status">Under consideration</span></span><br/>
Add an injured reserve.  Any player on the NFL IR may be designated by the WMFFL team as an IR player.  If so designated
that player will remain on their roster but will not count towards the 25 rostered players.  A player on IR may not be
activated.  Once removed from the IR by the NFL team, the player must be removed from the WMFFL IR and the team must restore
thier roster limits.<br/>
<blockquote class="mb-0 mt-2 px-3"><i>Add rule IV.C reading:<br/>
    C. Any player listed by the NFL as being on injured reserve, may be played on IR by the WMFFL team<br/>
&nbsp;&nbsp;&nbsp;&nbsp;    1. The WMFFL team must explicitly designate a player as being on IR<br/>
&nbsp;&nbsp;&nbsp;&nbsp;    2. Any player on IR will not be counted towards the roster limits in rule IV.A.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;    3. When the NFL removes a player from IR, the will be removed from the WMFFL IR 
</i></blockquote>

<blockquote class="mb-0 mt-2 px-3"><i>Add rule V.A.3.d reading:<br/>
    d. Activating a player on IR will result in a $1 fine and a 2 point penalty per violation
</i></blockquote>
</div>

<div class="card m-2 p-2 bg-light">
<b>Proposal 2020.2 - Require Monday Night Activations</b>
<b>Sponsor: Josh Utterback</b><br/>
<span class="ballot">Status: <span class="status">Under consideration</span></span><br/>
Each week every WMFFL team must activate at least one player whose team plays on Monday night.  Failure to do so will result
in that team's flex player being considered an illegal activation.<br/>
<blockquote class="mb-0 mt-2 px-3"><i>Add rule V.A.3.d (or V.A.3.e if proposal 2020.1 passes) reading:</br>
    d. Failure to activate a player whose NFL team plays on Monday will result in the flex position activation being treated as if they were not on an NFL team</br>
&nbsp;&nbsp;&nbsp;&nbsp;   i. This restriction will be waived in any week where there are not any NFL games scheduled for Monday.
</i></blockquote>
</div>

<? include "base/footer.html"; ?>
