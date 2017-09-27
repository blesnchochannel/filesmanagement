        <!-- Marketing messaging and featurettes
        ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container">
            <div class="mt-3">
                <h1>
                    <span>Lixeira</span>
                    <a class="btn btn-danger pull-right" href="do_empty"><i class="fa fa-trash-o fa-fw"></i> Esvaziar</a>
                </h1>
            </div>
            <p class="lead">Abaixo estão todas as fotos excluídas. Você pode restaurá-las ou excluí-las definitivamente agora.</p>
        </div>

        <div class="container marketing">

          <!-- Three columns of text below the carousel -->
            <div class="row">
                <?php foreach ($directory as $file):
                $no_extension = substr($file, 0, strrpos($file, "."));?>
                <div class="col-lg-4">
                    <img class="rounded-circle" src="http://rafahsborges.com.br/filesmanagement/images/excluded/<?php echo $file; ?>" width="140" height="140">
                    <p><?php echo $no_extension; ?></p>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-warning" href="do_undelete/<?php echo $file; ?>"><i class="fa fa-undo fa-fw"></i> Restaurar</a>
                        <a class="btn btn-warning" href="do_delete/<?php echo $file; ?>"><i class="fa fa-trash-o fa-fw"></i> Excluir</a>
                    </div>
                </div><!-- /.col-lg-4 -->
                <?php endforeach; ?>
            </div>