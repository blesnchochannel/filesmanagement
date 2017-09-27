        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                    if ( $directory !== false ) {
                    $filecount = count($directory);
                        for ($i=0; $i<$filecount; $i++){
                ?>  
                            <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>"></li>
                <?php
                        }
                    } else {
                        echo "Não há imagens disponíveis, insira novas!";
                    }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php foreach ($directory as $file):
                    $no_extension = substr($file, 0, strrpos($file, "."));
                    if ($directory[0] == $file){ ?>
                        <div class="carousel-item active">
                            <img src="http://rafahsborges.com.br/filesmanagement/images/uploads/<?php echo $file; ?>" alt="<?php echo $file; ?>">
                            <div class="container">
                                <div class="carousel-caption d-none d-md-block">
                                    <h1>Imagem: <?php echo $no_extension; ?></h1>
                                    <p>Essa é a imagem: <?php echo $no_extension; ?></p>
                                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                                </div>
                            </div>
                        </div>
                <?php } else { ?>
                        <div class="carousel-item">
                            <img src="http://rafahsborges.com.br/filesmanagement/images/uploads/<?php echo $file; ?>" alt="<?php echo $file; ?>">
                            <div class="container">
                                <div class="carousel-caption d-none d-md-block">
                                    <h1>Imagem: <?php echo $no_extension; ?></h1>
                                    <p>Essa é a imagem: <?php echo $no_extension; ?></p>
                                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                                </div>
                            </div>
                        </div>
                <?php } endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div>
        
        <script type="text/javascript">
	            $('.carousel').carousel();
        </script>