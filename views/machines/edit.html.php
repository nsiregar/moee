<?php

echo html('machines/_form.html.php', null, array('machine' => $machine, 'method' => 'PUT', 'action' => url_for('machines', $machine->id)));

?>
