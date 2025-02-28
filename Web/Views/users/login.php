<?= $this->extend(customOrDefaultViewFragment('layout/body')) ?>
<?= $this->section('content') ?>
<article>
    <section class="lcshop-header">
        <div class="myIn">
            <hgroup>
                <?= h1($titolo) ?>
            </hgroup>
        </div>
    </section>
    <div class="row lcusers-content lcusers-content-login">
        <div class="myIn lcusers-flex">
            <div class="lcusers-login-or-signup-cnt">
                <?= view(customOrDefaultViewFragment('users/components/login-form', 'LcUsers')) ?>
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