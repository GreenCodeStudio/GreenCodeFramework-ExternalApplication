import {FormManager} from "../../../Core/js/form";
import {AjaxTask} from "../../../Core/js/ajaxTask";
import {pageManager} from "../../../Core/js/pageManager";
import {DatasourceAjax} from "../../../Core/js/datasourceAjax";
import {ObjectsList} from "../../../Core/js/ObjectsList/objectsList";
import {t as TCommonBase} from "../../../CommonBase/i18n.xml";
import {TaskNotification} from "../../../Notifications/js/TaskNotification";
import {Ajax} from "../../../Core/js/ajax";

export class index {
    constructor(page, data) {
        const container = page.querySelector('.ExternalApplicationsList');
        let datasource = new DatasourceAjax('ExternalApplication', 'getTable', ['ExternalApplication', 'ExternalApplication']);
        let objectsList = new ObjectsList(datasource);
        objectsList.columns = [{name: "Nazwa", content: row => row.name, sortName: 'name'}];
        objectsList.generateActions = (rows, mode) => {
            let ret = [];
            if (rows.length == 1) {
                ret.push({
                    name: TCommonBase("edit"),
                    icon: 'icon-edit',
                    href: "/ExternalApplication/edit/" + rows[0].id,
                    main: true
                });
                if(rows[0].token)
                ret.push({
                    name: 'Swagger',
                    icon: 'icon-show',
                    href: "/ApiDocs/?key=" + rows[0].token,
                    main: true
                });
            }
            if (mode != 'row') {
                ret.push({
                    name: TCommonBase("editInNewTab"), icon: 'icon-edit', showInTable: false, command() {
                        rows.forEach(x => window.open("/ExternalApplication/edit/" + x.id))
                    }
                });
            }
            return ret;
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
            await TaskNotification.Create(async () => {
                await Ajax.ExternalApplication.update(newData);
            }, "Zapisywanie", "Zapisano");
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
            await TaskNotification.Create(async () => {
                await Ajax.ExternalApplication.insert(newData);
            }, "Zapisywanie", "Zapisano");
            pageManager.goto('/ExternalApplication');
        }
    }
}