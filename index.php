<?php
    require_once 'core/init.php';

    include_once 'inc/placeholders/languageSetup.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Multi-Langue Login/Registration with account page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.css">
  </head>
  <body>
    <?php 
        include_once __DIR__.'/inc/placeholders/home_navbar.php';
    ?>
    
    <!-- Where to place content [START] -->

    <?php
        echo $langue->getDialog($lang, Session::flash('login_message'), isset($user->getData()->username) ? array('[name]' => ucfirst($user->getData()->username)) : array());
    ?>

    <div class="row" style="padding-left: 20px; min-height: 100vh;">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">News</h3>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nunc mi, eleifend a odio sed, interdum pharetra eros. Sed dolor dolor, lacinia non convallis id, tempor vitae nisi. Cras pulvinar hendrerit nibh eu lobortis. Cras et consectetur nibh, sed euismod nulla. Nullam tincidunt interdum purus nec laoreet. Nunc tempor massa risus, non ornare neque posuere quis. Vivamus at tellus nisl. Phasellus blandit quam non turpis faucibus eleifend. Vivamus ullamcorper lobortis urna ac consectetur. Suspendisse facilisis ornare ante, non egestas enim faucibus nec. Vivamus tristique nunc sed turpis vestibulum scelerisque. Proin vitae lectus tempor, elementum mauris eu, commodo nunc. Nullam vitae nunc dolor. Maecenas mattis arcu non sagittis facilisis. Aliquam elementum et purus a malesuada. Vivamus pellentesque at ipsum a congue.

                        Donec a faucibus erat. Mauris lobortis dignissim sem vitae scelerisque. Nunc mattis velit sem, ac consequat tellus porta sit amet. Morbi eleifend nisi ut pulvinar venenatis. Nulla ac urna ut mauris facilisis cursus id quis enim. Donec lacinia tempor nunc quis ornare. Nullam semper viverra massa sit amet condimentum. Proin quis tempor metus. Duis iaculis in metus eget luctus. Sed pretium augue id eros ullamcorper, at dictum ex semper. Donec eu erat nec turpis ullamcorper mattis sit amet nec libero. Donec quis eros non erat ultricies volutpat nec in odio. Vivamus et ante vel nibh rutrum tristique id vel massa. Suspendisse sed nisi sed est pellentesque gravida vel sit amet turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.

                        Suspendisse sed posuere lectus. Pellentesque volutpat pulvinar sem, eget euismod urna convallis et. Donec aliquet porta enim in lobortis. Nulla ut mauris auctor, auctor odio ac, efficitur dui. Pellentesque et ex ultrices, tempor felis sed, pulvinar metus. Donec metus mauris, aliquet vitae augue sollicitudin, egestas tincidunt lectus. Nunc eget tellus a ante efficitur ultricies nec sed ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla pellentesque turpis urna. Suspendisse tempor aliquam posuere. Vestibulum consequat, nunc non lacinia efficitur, diam mi aliquet nisi, id maximus lectus ligula id odio. Morbi sed suscipit mauris, quis posuere velit.

                        Donec in volutpat massa. Integer vestibulum tempor scelerisque. Quisque eu imperdiet diam. Nulla facilisi. Nullam eleifend neque id magna posuere rutrum. Integer eget libero at lacus varius rutrum. Sed venenatis feugiat massa. Proin dignissim tortor et sem dictum, at lacinia elit dapibus. Aliquam condimentum id quam sed elementum. Sed sit amet dolor ligula. Cras in libero pulvinar, elementum justo a, volutpat sapien. Sed sit amet tellus vitae ipsum condimentum hendrerit. Donec tempus rutrum magna, a tincidunt velit volutpat a.

                        Morbi magna erat, tincidunt vel iaculis ac, scelerisque eget neque. Aliquam turpis velit, imperdiet vitae massa vitae, tincidunt gravida mi. Integer non iaculis arcu. Sed lacinia risus a sapien suscipit congue. Donec iaculis nisi purus, eu dignissim tellus vulputate sit amet. Phasellus gravida venenatis magna quis volutpat. Ut efficitur sagittis fringilla.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Title</h3>
                    <p class="card-text">Text</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Where to place content [END] -->

    <?php 
        include_once __DIR__.'/inc/placeholders/home_footer.php';
    ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>