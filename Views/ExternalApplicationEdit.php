<form>
    <div class="topBarButtons">
        <button class="button" type="button"><span class="icon-cancel"></span><?= t("CommonBase.cancel") ?></button>
        <button class="button"><span class="icon-save"></span><?= t("CommonBase.save") ?></button>
    </div>
    <div class="grid page-ExternalApplication page-ExternalApplication-edit">
        <input name="id" type="hidden">
        <section class="card" data-width="6">
            <header>
                <h1>ExternalApplication</h1>
            </header>
            <label>
                <span><?= t("ExternalApplication.ExternalApplication.name") ?></span>
                <input type="text" name="name" required>
            </label>
        </section>
    </div>
</form>