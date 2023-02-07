<div style="border-bottom: 1px solid silver; color: #4f4f4f; margin-bottom: 10px;">
  <i class="fas fa-list"></i>
  <b>IPads</b>
</div>

<div style="overflow: auto; height: 500px;">
  <table id="NovosAtivos" class="table table-striped table-bordered table-hover table-sm">
    <thead>
      <tr>
        <th>Nome do(a) Responsável</th>
        <th>Status</th>
        <th>E-mail</th>
        <th>Manutenção</th>
        <th>Modelo</th>
        <th>Part Number</th>
        <th>Serial</th>
        <th>IMEI</th>
        <th>Editar</th>
      </tr>
      <tr>
        <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
        <th>
          <select type="text" class="form-control" data-size="1" data-live-search="true" data-actions-box="true" id="txtNome">
            <option value="">--</option>
            <option value="ESTOQUE">ESTOQUE</option>
            <option value="ATIVO">ATIVO</option>
            <option value="TRÂNSITO">TRÂNSITO</option>
            <option value="ROUBADO">ROUBADO</option>                
            <option value="PERDIDO">PERDIDO</option>
          </select>
        </th>
        <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
        <th>
          <select class="form-control" data-size="1" data-live-search="true" data-actions-box="true" id="txtNome">
            <option value="">--</option>
            <option value="INTERNA">INTERNA</option>
            <option value="EXTERNA">EXTERNA</option>
            <option value="NÃO">NÃO</option>
          </select>
        </th>
        <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
        <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
        <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
        <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
        <th>--</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($list as $row) {
      ?>
        <tr>
          <td><?= $row['RESPONSAVEL'] ?></td>
          <td><?= $row['STATUS'] ?></td>
          <td><?= $row['EMAIL'] ?></td>
          <td><?= $row['MANUTENCAO'] ?></td>
          <td><?= $row['MODELO'] ?></td>
          <td><?= $row['PART_NUMBER'] ?></td>
          <td><?= $row['SERIAL'] ?></td>
          <td><?= $row['IMEI'] ?></td>
   
          <td>
            <button class="btn btn-info btn-sm" attr-id="<?= $row['ID'] ?>" onclick="btUpdate(this)">
              <i class="far fa-edit"></i>
            </button>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>
</div>

<script src="<?= base_url('js/arealogada/transportadora/filtro.js?v=1.10') ?>"></script>