<?= $this->extend($base_view_folder . 'layout/body') ?>
<?= $this->section('content') ?>
<article>
    <div class="row row-form row-form-signup">
        <div class="myIn">
            <div class="login-signup-header">
                <?= h2(appLabel('Login', $app->labels, true), 'login-signup-title') ?>
            </div>
            <div class="login-signup-module">
                <div class="login-signup-form-cnt">
                    <?= view($base_view_folder . 'users/components/login-form') ?>
                </div>
                <div class="login-signup-altenative-cnt">
                    <?= view($base_view_folder . 'users/components/signup-login-alternative') ?>
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