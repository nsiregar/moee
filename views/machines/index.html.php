<?php echo link_to('Main page', '/') ?>
<hr/>

<ul>
<?php foreach ($machines as $machine) { ?>
  <li>
    <?php echo link_to($machine->code, 'machines', $machine->id) ?> (<?php echo $machine->name ?>)
    <?php echo link_to("Edit", 'machines', $machine->id, 'edit') ?>
    <a href="<?php echo url_for('machines', $machine->id);?>" onclick="if (confirm('Are you sure?')) { var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href; var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', '_method'); m.setAttribute('value', 'DELETE'); f.appendChild(m); f.submit(); };return false;">Delete</a>
  </li>
<?php } ?>
</ul>

<hr/>
<?php echo link_to('New machine', 'machines/new') ?>
