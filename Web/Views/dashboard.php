<?= $this->extend($base_view_folder . 'layout/body') ?>
<?= $this->section('content') ?>
<article>
    <div class="row row-user row-user-dashboard">
        <div class="myIn">
            <div class="row-user-header user-dashboard-header">
                <?= h2(appLabel('Dashboard', $app->labels, true), 'user-dashboard-title') ?>
                <?= h4($user_welcome, 'user-welcome-mess') ?>
            </div>
            <div class="row-user-module user-dashboard-module">
                <div class="row-user-cnt user-dashboard-cnt">



                </div>
                <div class="row-user-sidebar">
                    <h5>Area Utente</h5>
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