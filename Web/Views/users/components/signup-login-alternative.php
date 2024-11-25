<div class="lcuser-altenative">
    <?= h4(langLabel('Non sei ancora registrato?'), 'lcuser-altenative-title') ?>
    <?= h5(langLabel('Procedi come nuovo utente'), 'lcuser-altenative-title') ?>
    <?= txt('La creazione di un account ha molti vantaggi.<br />In futuro tutto sarà più semplice e veloce.', 'lcuser-blocco-info') ?>
    <div class="cta_cnt">
        <a href="<?= route_to('web_signup') . (($request->getGet('returnTo')) ? '?returnTo=' . urlencode($request->getGet('returnTo')) : '') ?>" class="button"><?= langLabel('Crea un account') ?></a>
    </div>
</div>