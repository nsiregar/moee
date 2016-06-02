<?php echo link_to('Main page', '/') ?>
<hr/>

<ul>
<?php foreach ($jobs as $job) { ?>
  <li>
    <?php echo link_to($job->jn, 'jobs', $job->id) ?> (<?php echo $job->name ?>)
    <?php echo link_to("Edit", 'jobs', $job->id, 'edit') ?>
    <a href="<?php echo url_for('jobs', $job->id);?>" onclick="if (confirm('Are you sure?')) { var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href; var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', '_method'); m.setAttribute('value', 'DELETE'); f.appendChild(m); f.submit(); };return false;">Delete</a>
  </li>
<?php } ?>
</ul>

<hr/>
<?php echo link_to('New job', 'jobs/new') ?>
