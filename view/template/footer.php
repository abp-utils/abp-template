<?php
use abp\component\Resource;
use model\User;

/** @var User $user */
?>
</div>
</main>
<footer class="footer mt-auto py-3">
    <div class="container">
        <p class="float-left">© My Company <?= date('Y')?></p>
        <p class="float-right">Powered by <a href="https://github.com/abp-utils/abp" rel="external" target="_blank">Abp Framework</a>
        <img class="footer-logo" src="/resource/img/logo.png"></p>
    </div>
</footer>
</body>
    <?php Resource::printRegistredJsFiles() ?>
</html>
