import {FormManager} from "../../../Core/js/form";
import {AjaxTask} from "../../../Core/js/ajaxTask";
import {pageManager} from "../../../Core/js/pageManager";
import {DatasourceAjax} from "../../../Core/js/datasourceAjax";
import {ObjectsList} from "../../../Core/js/ObjectsList/objectsList";
import {t as TCommonBase} from "../../../CommonBase/i18n.xml";

export class index {
    constructor(page, data) {
        const container = page.querySelector('.ExternalApplicationsList');
        let datasource = new DatasourceAjax('ExternalApplication', 'getTable', ['ExternalApplication', 'ExternalApplication']);
        let objectsList = new ObjectsList(datasource);
        objectsList.columns = [{name: "Nazwa", content: row => row.name}];
        objectsList.generateActions = (rows) => {
            if (rows.length == 1) {
                return [{name: TCommonBase("edit"), icon: 'edit', href: "/ExternalApplication/edit/" + rows[0].id}];
            } else {
                return [];
            }
        }
        container.append(objectsList);
        objectsList.refresh();
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
        if (data && data.selects)
            form.loadSelects(data.selects);

        form.submit = async newData => {
            await AjaxTask.startNewTask('ExternalApplication', 'insert', newData);
            pageManager.goto('/ExternalApplication');
        }
    }
}