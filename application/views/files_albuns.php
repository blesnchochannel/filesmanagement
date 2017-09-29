<div class="container">
    <div class="mt-3">
        <h1>
            <span>Álbum - <?php echo $caminho; ?></span>
            <a class="btn btn-danger pull-right" href="dir_create"><i class="fa fa-folder-o fa-fw"></i> Novo</a>
        </h1>
    </div>
    <p class="lead">Abaixo estão todos os álbuns. Você pode criar novos, renomea-los ou excluí-los.</p>
</div>

<div class="container marketing">
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <?php
        foreach ($directory as $file):
            $no_extension = substr($file, 0, strrpos($file, "."));
            ?>
            <div class="col-lg-4">
                <img class="rounded-circle" src="<?php
                echo base_url('images/albuns/');
                echo $caminho . "/" . $file;
                ?>" width="140" height="140">
                <p>
                    <?php
                    echo form_open('files/do_rename', 'id="formulario"');
                    echo form_input(array('name' => 'name', 'class' => 'form-control-plaintext', 'value' => $no_extension));
                    echo form_input(array('type' => 'hidden', 'name' => 'file', 'value' => $file));
                    echo form_close();
                    ?>
                </p>
                <p>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button class="btn btn-warning" onclick="submitForm()"><i class="fa fa-pencil fa-fw"></i></button>
                    <button class="btn btn-warning" onclick="window.location.href = 'do_mark/<?php echo $file; ?>'"><i class="fa fa-tint fa-fw"></i></button>
                    <button class="btn btn-warning" onclick="window.location.href = 'do_resize/<?php echo $file; ?>'"><i class="fa fa-expand fa-fw"></i></button>
                    <button class="btn btn-warning" onclick="window.location.href = 'do_trash/<?php echo $caminho."&".$file; ?>'"><i class="fa fa-trash-o fa-fw"></i></button>
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