<?php
    require_once 'core/init.php';
    $dbinstall = DBInstaller::create(Config::get('mysql'));

    $dbinstall->addPackage(new UsersDB());
    $execution = $dbinstall->execute();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
  </head>
  <body>
    <div id="accordion">
        <?php
        $x = 0;
        foreach($execution->getExecutions() as $execution)
        {
            ?>
                <div class="card border-<?php echo ($execution->hasErrors() ? 'danger' : 'success') ?>">
                    <div class="card-header" id="heading<?php echo $x; ?>">
                        <h5 class="">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $x; ?>" aria-expanded="true" aria-controls="collapse<?php echo $x; ?>">
                                Execution <?php echo ($execution->hasErrors() ? 'wasn\'t successful' : 'successful') ?>: <br/>
                            </button>
                        </h5>
                    </div>

                    <div id="collapse<?php echo $x; ?>" class="collapse" aria-labelledby="heading<?php echo $x; ?>" data-parent="#accordion">
                        <div class="card-body">
                            <?php echo $execution->getExecutedSQL(); ?> <br/><hr/>
                            <?php
                                if($execution->hasErrors())
                                {
                                    foreach($execution->getErrors() as $error)
                                    {
                                        echo $error['message'] . "<br/>";
                                    }
                                }
                                else
                                {
                                    echo 'No Errors occured!<br/>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            $x++;
        }
        ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>