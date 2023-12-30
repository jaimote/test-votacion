<?php require('../../app/votacion.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de votación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../assets/css/style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../assets/js/main.js"></script>
</head>
<body>
    <div class="container">
        <span class="titulo titulo-superior">FORMULARIO DE VOTACIÓN</span>
        <form action="" onsubmit="return formVotacion()">
            <table>
                <tr>
                    <td>Nombre y Apellido</td>
                    <td>
                        <input type="text" name="nombre" id="nombre">
                        <div class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>Alias</td>
                    <td>
                        <input type="text" name="alias" id="alias">
                        <div class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>RUT</td>
                    <td>
                        <input type="text" name="rut" id="rut">
                        <div class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="text" name="email" id="email">
                        <div class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>Región</td>
                    <td>
                        <select name="region" id="region">
                            <option value="">(seleccionar)</option>
                            <?php
                            foreach($regiones as $key => $value){
                                echo "<option value=".$value['id'].">".$value["nombre"]."</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Comuna</td>
                    <td>
                        <select name="comuna" id="comuna">
                            <option value="">(seleccionar)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Candidato</td>
                    <td>
                        <select name="candidato" id="candidato">
                            <option value="">(seleccionar)</option>
                            <?php
                            foreach($candidatos as $key => $value){
                                ?>
                            <option value="">(seleccionar)</option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>Como se enteró de nosotros</td>
                    <td>
                        <input type="checkbox" id="web"><label for="web">Web</label>
                        <input type="checkbox" id="tv"><label for="tv">TV</label>
                        <input type="checkbox" id="rrss"><label for="rrss">Redes Sociales</label>
                        <input type="checkbox" id="amigo"><label for="amigo">Amigo</label>
                    </td>
                </tr>
            </table>
            <button type="submit">Votar</button>
        </form>
    </div>
</body>
</html>