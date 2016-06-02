<?php

echo html('jobs/_form.html.php', null, array('job' => $job, 'method' => 'PUT', 'action' => url_for('jobs', $job->id)));

?>
