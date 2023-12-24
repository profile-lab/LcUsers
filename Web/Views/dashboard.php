<?= $this->extend($base_view_folder . 'layout/body') ?>
<?= $this->section('content') ?>
<article>
    <div class="row row-user row-user">
        <div class="myIn">
            <header class="user-header">
                <?= h1(appLabel('Dashboard', $app->labels, true), 'user-title') ?>
                <?= h4($user_welcome, 'user-welcome-mess') ?>
            </header>
            <div class="user-module">
                <div class="user-module-main">



                </div>
                <aside class="sidebar user_sidebar ">
                    <?= view($base_view_folder . 'users/components/sidebar') ?>
                </aside>
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