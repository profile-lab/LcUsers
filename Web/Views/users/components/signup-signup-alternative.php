<div class="lcuser-altenative">
    <?= h5(langLabel('Utente registrato?'), 'lcuser-altenative-title') ?>
    <?= txt('Vai alla pagina di login per accedere con le tue credenziali', 'lcuser-blocco-info') ?>
    <div class="cta_cnt">
        <a href="<?= route_to('web_login') . (($request->getGet('returnTo')) ? '?returnTo=' . urlencode($request->getGet('returnTo')) : '') ?>" class="button"><?= langLabel('Accedi') ?></a>

    </div>
</div>