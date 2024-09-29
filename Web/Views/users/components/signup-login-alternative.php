<div class="lcuser-altenative">
    <?= h6(langLabel('Non sei ancora registrato?'), 'lcuser-altenative-title') ?>
    <?= cta((route_to('web_signup') . (($request->getGet('returnTo')) ? '?returnTo=' . urlencode($request->getGet('returnTo')) : '')), langLabel('Registrati adesso'), 'lcuser-altenative') ?>
</div>