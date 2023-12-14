<?= $this->extend($base_view_folder . 'layout/body') ?>
<?= $this->section('content') ?>
<article>
    <div class="row row-form row-form-signup">
        <div class="myIn">
            <div class="user-dashboard-header">
                <?= h2(appLabel('Dashboard', $app->labels, true), 'user-dashboard-title') ?>
            </div>
            <div class="user-dashboard-module">
                <div class="user-dashboard-form-cnt">
                    
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