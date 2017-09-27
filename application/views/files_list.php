        <div class="container">
            <div class="mt-3">
                <h1>Fotos</h1>
            </div>
            <p class="lead">Abaixo estão todas as fotos enviadas. Você pode renomea-las ou excluí-las.</p>
        </div>
        
        <div class="container marketing">
          <!-- Three columns of text below the carousel -->
            <div class="row">
                <?php foreach ($directory as $file):
                $no_extension = substr($file, 0, strrpos($file, "."));?>
                <div class="col-lg-4">
                    <img class="rounded-circle" src="<?php echo base_url('images/uploads/$file'); ?>" width="140" height="140">
                    <p>
                        <?php
                            echo form_open('files/do_rename');
                            echo form_input(array('name' => 'name', 'class' => 'form-control-plaintext', 'value' => $no_extension));
                            echo form_input(array('type' => 'hidden', 'name' => 'file', 'value' => $file));
                            echo form_button(array('type' => 'submit', 'class' => 'btn btn-warning', 'content' => '<i class="fa fa-pencil fa-fw"></i> Renomear'));
                            echo form_close();
                        ?>
                    </p>
                    <p>
                        <a class="btn btn-warning" href="do_trash/<?php echo $file; ?>"><i class="fa fa-trash-o fa-fw"></i> Lixeira</a>
                    </p>
                    <!--<p>
                        <div class="btn-group open">
                            <a class="btn btn-primary" data-toggle="dropdown" href="#">
                                <span class="fa fa-caret-down" aria-hidden="true" title="Ações"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                    echo form_open('files/do_rename');
                                    echo form_input(array('name' => 'name', 'class' => 'form-control-plaintext'));
                                    echo form_input(array('type' => 'hidden', 'name' => 'file', 'value' => $file));
                                    echo form_button(array('type' => 'submit', 'class' => 'btn btn-info', 'content' => '<i class="fa fa-pencil fa-fw"></i> Renomear'));
                                    //echo form_submit(array('value' => 'Renomear', 'class' => 'btn btn-info', 'content' => '<i class='fa fa-pencil fa-fw'></i>'));
                                    echo form_close();
                                ?>
                                    <li><a href="do_trash/<?php echo $file; ?>"><i class="fa fa-trash-o fa-fw"></i> Lixeira</a></li>
                            </ul>
                        </div>
                    </p>-->
                </div><!-- /.col-lg-4 -->
            <?php endforeach; ?>
            </div><!-- /.row -->