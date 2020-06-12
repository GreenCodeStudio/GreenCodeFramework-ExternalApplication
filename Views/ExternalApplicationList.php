<div class="topBarButtons">
    <a href="/ExternalApplication/add" class="button"><span class="icon-add"></span> <?= t("CommonBase.add") ?></a>
</div>
<div class="grid page-ExternalApplication  page-ExternalApplication-list">
    <section class="card" data-width="6">
        <header>
            <h1><?= t("ExternalApplication.ExternalApplicationList.header") ?></h1>
        </header>
        <div class="dataTableContainer">
            <table class="dataTable" data-controller="ExternalApplication" data-method="getTable"
                   data-web-socket-path="ExternalApplication/ExternalApplication">
                <thead>
                <tr>
                    <th data-value="name" data-sortable><?= t("ExternalApplication.ExternalApplication.name") ?></th>
                    <th class="tableActions"><?= t("CommonBase.actions") ?>
                        <div class="tableCopy">
                            <a href="/ExternalApplication/edit" class="button" title="<?= t("CommonBase.edit") ?>"><span
                                        class="icon-edit"></span></a>
                        </div>
                    </th>
                </tr>
                </thead>
            </table>
        </div>
    </section>
</div>