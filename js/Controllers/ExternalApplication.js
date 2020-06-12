import {FormManager} from "../../../Core/js/form";
import {AjaxTask} from "../../../Core/js/ajaxTask";
import {pageManager} from "../../../Core/js/pageManager";
import {DatasourceAjax} from "../../../Core/js/datasourceAjax";
import {TableManager} from "../../../Core/js/table";

export class index {
    constructor(page, data) {
        const table = page.querySelector('.dataTable');
        let datasource = new DatasourceAjax('ExternalApplication', 'getTable', ['ExternalApplication', 'ExternalApplication']);
        table.datatable = new TableManager(table, datasource);
        table.datatable.refresh();
    }
}

export class edit {
    constructor(page, data) {
        let form = new FormManager(page.querySelector('form'));
        form.loadSelects(data.selects);
        form.load(data.ExternalApplication);

        form.submit = async newData => {
            await AjaxTask.startNewTask('ExternalApplication', 'update', newData);
            pageManager.goto('/ExternalApplication');
        }
    }
}
export class add {
    constructor(page, data) {
        let form = new FormManager(page.querySelector('form'));
        if(data && data.selects)
            form.loadSelects(data.selects);

        form.submit = async newData => {
            await AjaxTask.startNewTask('ExternalApplication', 'insert', newData);
            pageManager.goto('/ExternalApplication');
        }
    }
}