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
                    echo form_open('files/do_rename', 'id="formulario_rename"');
                    echo form_input(array('name' => 'name', 'class' => 'form-control-plaintext', 'value' => $no_extension));
                    echo form_input(array('type' => 'hidden', 'name' => 'file', 'value' => $file));
                    echo form_close();
                    ?>
                </p>
                <p>
                    <?php
                    echo form_open('files/do_trash', 'id="formulario_delete"');
                    echo form_input(array('type' => 'hidden', 'name' => 'file', 'value' => $file));
                    echo form_input(array('type' => 'hidden', 'name' => 'caminho', 'value' => $caminho));
                    echo form_close();
                    ?>
                </p>
                <p>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button class="btn btn-warning" onclick="submitRename()" data-toggle="tooltip" data-placement="bottom" title="Renomear"><i class="fa fa-pencil fa-fw"></i></button>
                    <button class="btn btn-warning" onclick="window.location.href='do_move/<?php echo $file; ?>'" data-toggle="tooltip" data-placement="bottom" title="Mover"><i class="fa fa-exchange fa-fw"></i></button>
                    <button class="btn btn-warning" onclick="window.location.href = 'do_mark/<?php echo $file; ?>'" data-toggle="tooltip" data-placement="bottom" title="Marca D'água"><i class="fa fa-tint fa-fw"></i></button>
                    <button class="btn btn-warning" onclick="window.location.href = 'do_resize/<?php echo $file; ?>'" data-toggle="tooltip" data-placement="bottom" title="Redimencionar"><i class="fa fa-expand fa-fw"></i></button>
                    <button class="btn btn-warning" onclick="submitDelete()" data-toggle="tooltip" data-placement="bottom" title="Lixeira"><i class="fa fa-trash-o fa-fw"></i></button>
                </div>
                </p>                    
            </div><!-- /.col-lg-4 -->
<?php endforeach; ?>
    </div><!-- /.row -->
    <script>
        function submitRename() {
            document.getElementById("formulario_rename").submit();
        }
        function submitDelete() {
            document.getElementById("formulario_delete").submit();
        }
    </script>