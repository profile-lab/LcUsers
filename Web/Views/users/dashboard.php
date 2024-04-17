<?= $this->extend(customOrDefaultViewFragment('layout/body')) ?>
<?= $this->section('content') ?>
<article>
    <div class="row row-user row-user">
        <div class="myIn">
            <header class="user-header">
                <?= h1($titolo, 'user-title') ?>
            </header>
            <div class="user-module">
                <div class="user-module-main">
                    <?= h4($user_welcome, 'user-welcome-mess') ?>
                </div>
                <aside class="sidebar user_sidebar ">
                    <?= view(customOrDefaultViewFragment('users/components/sidebar', 'LcUsers')) ?>
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