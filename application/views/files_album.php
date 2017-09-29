<div class="container">
    <div class="mt-3">
        <h1>
            <span>Álbuns</span>
            <a class="btn btn-danger pull-right" href="dir_create"><i class="fa fa-folder-o fa-fw"></i> Novo</a>
        </h1>
    </div>
    <p class="lead">Abaixo estão todos os álbuns. Você pode criar novos, renomea-los ou excluí-los.</p>
</div>

<div class="container marketing">
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <?php
        foreach ($directory as $file => $value):
            $name = str_replace("/", "", $file);
            $dir_name = stripslashes($name);
            ?>
            <div class="col-lg-4"><a href="files_albuns/<?php echo $dir_name; ?>"><i class="fa fa-folder fa-5x" aria-hidden="true"></i></a>                
                <p>
                    <?php
                    echo form_open('files/dir_rename', 'id="formulario"');
                    echo form_input(array('name' => 'name', 'class' => 'form-control-plaintext', 'value' => $dir_name));
                    echo form_input(array('type' => 'hidden', 'name' => 'file', 'value' => $dir_name));
                    echo form_close();
                    ?>
                </p>
                <p>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button class="btn btn-warning" onclick="submitForm()"><i class="fa fa-pencil fa-fw"></i></button>
                    <a class="btn btn-warning" href="dir_delete/<?php echo $file; ?>"><i class="fa fa-trash-o fa-fw"></i></a>
                </div>
                </p>                    
            </div><!-- /.col-lg-4 -->
        <?php endforeach; ?>
    </div><!-- /.row -->
    <select class="form-inline mt-2 mt-md-0" name="diretorio">
        <option value="./images/uploads/" selected>Álbum Padrão</option>
        <?php
        foreach ($directory as $file => $value):
            $name = str_replace("/", "", $file);
            $dir_name = stripslashes($name);
            ?>
            <option value="<?php echo $file; ?>" <?php echo  set_select('diretorio', $file); ?> ><?php echo $dir_name; ?> </option> 
        <?php endforeach ?>
    </select>
    <script>
        function submitForm() {
            document.getElementById("formulario").submit();
        }
    </script>