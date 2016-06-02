<form method="POST" action="<?php echo $action ?>">
  <input type="hidden" name="_method" id="_method" value="<?php echo $method ?>" />

  <div>
    <p>Job Number:</p>
    <p><input type="text" name="job[jn]" id="job_code" value="<?php echo h($job->jn) ?>" /></p>
  </div>

  <div>
    <p>Job Name:</p>
    <p><input type="text" name="job[name]" id="job_name" value="<?php echo h($job->name) ?>" /></p>
  </div>

  <div>
    <p>WO:</p>
    <p><input type="text" name="job[wo]" id="job_wo" value="<?php echo h($job->wo) ?>" /></p>
  </div>

  <div>
    <p>Unit:</p>
    <p><input type="text" name="job[unit]" id="job_unit" value="<?php echo h($job->unit) ?>" /></p>
  </div>

  <div>
    <p>Model:</p>
    <p><input type="text" name="job[model]" id="job_model" value="<?php echo h($job->model) ?>" /></p>
  </div>

  <div>
    <p>Stamp:</p>
    <p><input type="text" name="job[stamp]" id="job_stamp" value="<?php echo h($job->stamp) ?>" /></p>
  </div>

  <div>
    <p>
      <?php echo link_to('Cancel', 'jobs'), "\n" ?>
      <input type="submit" value="Save" />
    </p>
  </div>

</form>
