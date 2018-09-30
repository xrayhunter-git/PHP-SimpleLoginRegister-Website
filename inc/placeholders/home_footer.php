<?php
    require_once __DIR__.'/../../core/init.php';
    include_once __DIR__.'/languageSetup.php';
?>
<footer class="footer fixed-bottom bg-dark" style="max-width: 100%; color: white; text-decoration: none;">
    <div class="container">
        <div class="row">
            <div class="col-sm" style="">
                <h3>Social Links</h3>
                <ul>
                    <li><span><i class="fa fa-facebook-official" aria-hidden="true"></i> <a href="#">Facebook</span></a></li>
                    <li><span><i class="fas fa-twitter" aria-hidden="true"></i> <a href="#">Twitter</span></a></li>
                    <li><span><i class="fas fa-twitch" aria-hidden="true"></i> <a href="#">Twitch</span></a></li>
                    <li><span><i class="fa fa-google-plus-official" aria-hidden="true"></i> <a href="#">Google+</span></a></li>
                    <li><span><i class="fas fa-youtube" aria-hidden="true"></i > <a href="#">YouTube</span></a></li>
                </ul>
            </div>
            <div class="col-sm">
                <p>
                    <h4><a href="#">Careers</a></h4>
                    <h4><a href="#">About</a></h4>
                    <h4><a href="#">Support</a></h4>
                    <h4><a href="#">Contact Us</a></h4>
                </p>
                <h6><a href="#">Privacy</a> | <a href="#">Terms</a></h6>
            </div>
            <div class="col-sm">
                One of three columns
            </div>
        </div>
    </div>
    <div class="container text-center" style="max-width: 100%; color: white; background-color: #212529;">
        &copy; <?php echo date("Y"); ?> Copyright: <?php echo $langue->getDialog($lang, "company");?>
    </div>
</footer>