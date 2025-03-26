<div class="table-responsive mx-auto">
  <table class="table" id="table-index">
    <thead class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($DepartamentoModel) : ?>
      <?php foreach ($DepartamentoModel as $obj) : ?>
          <tr class="text-center">
            <td><?php echo $obj["id"]; ?></td>
            <td><?php echo $obj["nom"]; ?></td>
            <td>
            	<div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" onclick="show(<?php echo $obj['id']; ?>)" class="btn btn-success" style="font-size: 0.5em;">SHOW</button>
                <button type="button" onclick="edit(<?php echo $obj['id']; ?>)" class="btn btn-warning" style="font-size: 0.5em;">EDIT</button>
                <button type="button" onclick="delete_(<?php echo $obj['id']; ?>)" class="btn btn-danger" style="font-size: 0.5em;">DELETE</button>
              </div>
            </td>
          </tr>
        <?php endforeach?>
      <?php endif?>
    </tbody>
    <tfoot class="table-dark">
      <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Actions</th>
      </tr>
    </tfoot>
  </table>
</div>