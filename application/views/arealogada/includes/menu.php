<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?= PORTAL_MARJAN_WEB ?>arealogada/principal">
    <img src="http://intranet.marjantidev/portalmarjanweb/images/logo_marjan_bco_100px.png" style="width: 120px;">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      
      <?php
        $desligados = base_url() . "arealogada/desligados/desligados";
        $chips = base_url() . "arealogada/chips/chips";
        $cadastro = base_url() . "arealogada/ipads/ipads";
        $link = base_url() . "arealogada/principal";
        $active = (strpos($link, $_SERVER['REQUEST_URI']) !== false ? "active" : "");
      ?>

      <li class="nav-item <?= $active ?>">
        <a class="nav-link" href="<?= $cadastro ?>">
        <i class="fa fa-plus-circle"></i> Cadastro de Novos Ipads <span class="sr-only">(current)</span>
        </a>
      </li>

      <li class="nav-item <?= $active ?>">
        <a class="nav-link" href="<?= $chips ?>">
        <i class="fas fa-sim-card"></i> Controle de Chips <span class="sr-only">(current)</span>
        </a>
      </li>

      <li class="nav-item <?= $active ?>">
        <a class="nav-link" href="<?= $desligados ?>">
        <i class="fa fa-solid fa-users-slash" ></i> Desligados <span class="sr-only">(current)</span>
        </a>
      </li>

      <li class="nav-item <?= $active ?>">
        <a class="nav-link" href="<?= $link ?>">
          <i class="fas fa-home"></i> Principal <span class="sr-only">(current)</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= 'http://' . $_SERVER['SERVER_NAME'] . '/portalmarjanweb/'."/login/logout" ?>">
          <i class="fas fa-sign-out-alt"></i> Sair
        </a>
      </li>
      
    </ul>
    
    <span class="navbar-text">
      <?= $_SESSION['nome_usua'] ?>
    </span>

      
  </div>
</nav>