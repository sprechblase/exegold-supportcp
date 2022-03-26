<?php
$host = '147.135.186.145:E:\GTA5\Roleplay.FDB';
$dbh = ibase_connect($host, "TEST", "FFz9fDuAd9Kgmua8");
$stmt = 'SELECT * FROM PLAYER_ACCOUNT';
$sth = ibase_query($dbh, $stmt);
while ($row = ibase_fetch_object($sth)) {
    echo $row->PASSWORD, "\n";
}
ibase_free_result($sth);
ibase_close($dbh);
?>