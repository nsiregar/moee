<div>

  <p>ID: <?php echo $machine->id ?></p>

  <p>Machine Code: <?php echo h($machine->code) ?></p>

  <p>Machine Name: <?php echo h($machine->name) ?></p>

</div>

<hr/>
<?php echo link_to('Back to machines', 'machines') ?>

