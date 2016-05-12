<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DOKIFY</title>

  <!-- Bootstrap -->
  <link href="/api_ejemplo/assets/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
  <?php
    //Hubiera preferido utilizar Twig y reutilizar partes de las plantillas.
    //No fue posible por falta de tiempo
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>DOKIFY</h1>

        <form role="form" action="http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'] ?>" method="GET">
          <div class="form-group">
            <label for="empresas">Filtrar por empresa:</label>
            <select class="form-control" id="empresas" name="empresa">
              <option value="0">Selecciona empresa</option>
              <?php
                foreach($vars['empresas_ids'] as $key => $value){
                  if($vars['current'] == $value['id']) $selected = 'selected="selected"';
                  else $selected = '';

                  echo sprintf('<option %s value="%s">%s</option>', $selected, $value['id'], $value['nombre']);
                }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="order">Ordenador por:</label>
            <select class="form-control" id="empresas" name="order">
              <option value="0">Ordenar por</option>
              <option <?php echo ($vars['order'] == 'nombre' ? 'selected="selected"' : '') ?> value="nombre">Nombre</option>
              <option <?php echo ($vars['order'] == 'tipoRelacion' ? 'selected="selected"' : '') ?>  value="tipoRelacion">Relación</option>
            </select>
          </div>

          <button type="submit" class="btn btn-default">Submit</button>
        </form>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Relación</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($vars['list'] as $key => $value){
                echo sprintf('<tr><td>%s</td><td>%s</td></tr>', $value['nombre'], $value['tipoRelacion']);
              }
            ?>
          </tbody>
        </table>

        <a href="http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'] ?>?relaciones">
          <button type="button" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-forward" aria-hidden="true"></span> Ver relaciones
          </button>
        </a>

      </div>
    </div>
  </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="/api_ejemplo/assets/js/bootstrap.min.js"></script>
</body>
</html>