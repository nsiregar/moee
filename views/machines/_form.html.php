<form method="POST" action="<?php echo $action ?>">
  <input type="hidden" name="_method" id="_method" value="<?php echo $method ?>" />

  <div>
    <p>Machine Code:</p>
    <p><input type="text" name="machine[code]" id="machine_code" value="<?php echo h($machine->code) ?>" /></p>
  </div>

  <div>
    <p>Machine Name:</p>
    <p><input type="text" name="machine[name]" id="machine_name" value="<?php echo h($machine->name) ?>" /></p>
  </div>

  <div>
    <p>
      <?php echo link_to('Cancel', 'machines'), "\n" ?>
      <input type="submit" value="Save" />
    </p>
  </div>

</form>
