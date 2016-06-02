<?php

echo html('machines/_form.html.php', null, array('machine' => $machine, 'method' => 'POST', 'action' => url_for('machines')));

?>
