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
    <?php
    foreach($execution->getExecutions() as $execution)
    {
        if ($execution->hasErrors())
        {
            ?>
                <div class="alert alert-danger" role="alert">
                    Execution failed: <br/>
                    
                    <?php echo implode('|', $execution->getErrors()); ?>
                    <br/>
                    <?php echo $execution->getExecutedSQL(); ?>
                </div>
            <?php
        }
        else
        {
            ?>
                <div class="alert alert-success" role="alert">
                    Execution Successful: <br/>
                    
                    <?php echo $execution->getExecutedSQL(); ?>
                </div>
            <?php
        }
    }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>