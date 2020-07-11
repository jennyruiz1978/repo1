<!DOCTYPE html>
<?php
echo "este es un archivo alterado";
//incluyendo el modelo:
include "models/modelo.php";

//elimino warning:
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);

//recupero los datos a buscar:
if ((isset($_POST['campaign'])) && ($_POST['campaign'] != '') && (isset($_POST['date'])) && ($_POST['date'] != '')) {    
    $campaign = $_POST['campaign'];
    $date = $_POST['date'];
    $range = $_POST['range'];
    $nuevo = new Rank(); //instancio la clase
    $asd = $nuevo->ranking($_POST['campaign'], $_POST['date'], $_POST['range']);
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Ranking</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <header class="text-center">
                <h1>User Agents Ranking</h1>
                <hr/>
                <p class="lead">Esta es una app que permite <br/>
                    hacer la búsqueda de los user agents <br/>
                    más recurrentes de una campaña en una fecha específica</p>
            </header>

            <div class="row p-4">
                <div class="col-lg-10">
                    <h4>Ingrese los datos a buscar:</h4>
                    <form action="" method="post" class="col-lg-4" >
                        <label>Campaign ID</label><input type="text" name="campaign" class="form-control"/>    
                        <label>Date</label><input type="date" name="date" class="form-control" /><br>
                        <label>Tipo de Ranking</label>
                        <select id="opciones" name="range" type="text" class="text" >
                          <option disabled="disabled" selected="">Select</option>
                          <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="20">20</option>
                        </select>
                        <br>
                        <input id="boton" type="submit" value="Buscar" class="btn btn-success" />
                    </form>
                </div>
            </div>

            <div class="row p-4">
                <?php if ($asd) {
                ?>
                <p>Este es el resultado de la búsqueda Campaign <?php { echo $campaign ;}?> y Date <?php { echo $date;}?> </p>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th><strong>http_useragent</strong></th>
                            <th><strong>número de incidencias</strong></th>
                        </tr>
                    </thead>
                        <?php
                        
                        for ($i = 0; $i < count($asd); $i++)
                            {
                        ?>
                    <tbody>
                        <tr>
                            <td><?php echo $asd[$i]["http_useragent"]; ?></td>
                            <td><?php echo $asd[$i]["COUNT(id)"]; ?></td>
                        </tr>
                    </tbody>
                        <?php
                            }
                        ?>
                </table>
                <?php } else {
                    echo "No hay datos para mostrar";
                }
                ?>
            </div>

            <footer class="col-lg-12 text-center">
                Creado por Jenny Carolina Ruiz Razuri - <?php echo date("Y"); ?>
            </footer>
        </div>
    </body>
</html>