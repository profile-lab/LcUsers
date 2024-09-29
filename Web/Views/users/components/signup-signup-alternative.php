<div class="lcuser-altenative">
    <?= h6(langLabel('Sei già registrato?'), 'lcuser-altenative-title') ?>
    <?= cta((route_to('web_login') . (($request->getGet('returnTo')) ? '?returnTo=' . urlencode($request->getGet('returnTo')) : '')), langLabel('Accedi'), 'lcuser-altenative') ?>
</div>