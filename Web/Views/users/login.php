<?= $this->extend(customOrDefaultViewFragment('layout/body')) ?>
<?= $this->section('content') ?>
<article>
    <div class="row row-form row-form-signup">
        <div class="myIn">
            <div class="login-signup-header">
                <?= h2(appLabel('Login', $app->labels, true), 'login-signup-title') ?>
            </div>
            <div class="login-signup-module">
                <div class="login-signup-form-cnt">
                    <?= view(customOrDefaultViewFragment('users/components/login-form', 'LcUsers')) ?>
                </div>
                <div class="login-signup-altenative-cnt">
                    <?= view(customOrDefaultViewFragment('users/components/signup-login-alternative', 'LcUsers')) ?>
                </div>
            </div>
        </div>

</article>


<?= $this->endSection() ?>
<?= $this->section('footer_script') ?>

<script type="text/javascript">
    $(document).ready(function() {



    });
</script>
<?= $this->endSection() ?>