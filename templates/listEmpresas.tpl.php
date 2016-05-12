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

          <ul class="list-group">
          <?php

            $idConexion = NULL;

            foreach($vars as $key => $value){

              if($idConexion != $value['idConexion']){
                  echo sprintf('</li><li class="list-group-item">%s  --%s-->  %s', $value['idEmpresa1'], $value['tipoRelacion'], $value['idEmpresa2']);
              }
              else{
                echo sprintf('  --%s-->  %s', $value['tipoRelacion'], $value['idEmpresa2']);
              }

              $idConexion = $value['idConexion'];
            }

            echo '</li>';
          ?>
          </ul>

          <a href="http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'] ?>">
            <button type="button" class="btn btn-default btn-lg">
              <span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Volver
            </button>
          </a>

        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/api_ejemplo/assets/js/bootstrap.min.js"></script>
  </body>
</html>