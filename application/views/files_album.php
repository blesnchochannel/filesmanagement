<div class="container">
    <div class="mt-3">
        <h1>Álbuns</h1>
    </div>
    <p class="lead">Abaixo estão todos os álbuns. Você pode criar novos, renomea-los ou excluí-los.</p>
</div>

<div class="container marketing">
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <?php
        foreach ($directory as $file => $value):
            //$dir_name = substr($file, 0, strrpos($file, "/\/"));
            $dir_name = stripslashes($file);
            ?>
            <div class="col-lg-4"><i class="fa fa-folder fa-5x" aria-hidden="true"></i>                
                <p>
                    <?php
                    echo form_open('files/dir_rename', 'id="formulario"');
                    echo form_input(array('name' => 'name', 'class' => 'form-control-plaintext', 'value' => $dir_name));
                    echo form_input(array('type' => 'hidden', 'name' => 'file', 'value' => $file));
                    echo form_close();
                    ?>
                </p>
                <p>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button class="btn btn-warning" onclick="submitForm()"><i class="fa fa-pencil fa-fw"></i></button>
                    <button class="btn btn-warning" onclick="window.location.href = 'dir_trash/<?php echo $file; ?>'"><i class="fa fa-trash-o fa-fw"></i></button>
                </div>
                </p>                    
            </div><!-- /.col-lg-4 -->
        <?php endforeach; ?>
    </div><!-- /.row -->
    <script>
        function submitForm() {
            document.getElementById("formulario").submit();
        }
    </script>