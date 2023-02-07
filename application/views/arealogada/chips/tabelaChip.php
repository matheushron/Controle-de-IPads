<div style="border-bottom: 1px solid silver; color: #4f4f4f; margin-bottom: 10px;">
  <i class="fas fa-list"></i>
  <b>IPads</b>
</div>

<div>
 
<div style="overflow: auto; height: 300px ">
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
      <tr>
        <th>ID</th>  
        <th>Número da linha</th>  
        <th>SIM Card</th>  
        <th>Conta</th>  
        <th>Status</th>  
      </tr>
    </thead>
    <tbody>
      <?php
      foreach($tabelaChip as $row){
        ?>
        <tr>
          <td><?= $row['ID'] ?></td>
          <td><?= $row['NUMERO_LINHA'] ?></td> 
          <td><?= $row['NUMERO_FRENTE'] ?></td>
          <td><?= $row['CONTA'] ?></td>
          <td><?= $row['ATIVO'] ?></td>
        </tr>
        <?php
      }
      ?> 
    </tbody>
  </table>
    </div>  
</div>