<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Gerenciador de arquivos</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url('includes/bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('includes/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('includes/font-awesome/css/font-awesome.min.css'); ?>">
    </head>
    <body>

        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/files/">Gerenciador de Imagens</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url(); ?>index.php/files/">Página Inicial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>index.php/files/fotos">Fotos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>index.php/files/albuns">Álbuns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>index.php/files/lixeira">Lixeira</a>
                    </li>                    
                </ul>
                <?php
                echo form_open_multipart('files/do_upload', 'class="form-inline mt-2 mt-md-0"', 'id="formulario_upload"');
                echo form_input(array('type' => 'file', 'name' => 'userfile[]', 'class' => 'form-control mr-sm-2', 'placeholder' => 'Envie aqui seus arquivos!', 'contents' => 'aria-label="Enviar" multiple=""'));
                ?>
                <select class="form-inline mt-2 mt-md-0" name="diretorio">
                    <option value="./images/uploads/" selected>Álbum Padrão</option>
                    <?php
                    foreach ($directory as $file => $value):
                        $name = str_replace("/", "", $file);
                        $dir_name = stripslashes($name);
                        ?>                    
                        <option value="./images/albuns/<?php echo $dir_name; ?>/" <?php echo  set_select('diretorio', $dir_name); ?> ><?php echo $dir_name; ?> </option> 
                    <?php endforeach ?>
                </select>
                <?php
                echo form_submit(array('type' => 'submit', 'value' => 'Enviar', 'class' => 'btn btn-outline-success my-2 my-sm-0'));
                echo form_close();
                ?>
            </div>
        </nav>