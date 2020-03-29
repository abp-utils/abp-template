<?php
use abp\component\Resource;
use model\User;

/** @var User $user */
?>
</div>
</main>
<footer class="footer mt-auto py-3">
    <div class="container">
        <span class="text-muted">Abp <?= date('Y')?></span>
    </div>
</footer>
</body>
    <?php
    Resource::register([
        [
            'file' => 'jquery',
            'type' => 'js',
        ],
        [
            'file' => 'bootstrap',
            'type' => 'js',
        ],
    ]);
    ?>
</html>
