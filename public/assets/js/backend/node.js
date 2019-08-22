define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'node/index',
                    add_url: 'node/add',
                    edit_url: 'node/edit',
                    del_url: 'node/del',
                    multi_url: 'node/multi',
                    table: 'node',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'code', title: __('Code')},
                        {field: 'name', title: __('Name')},
                        {field: 'db_host', title: __('Db_host')},
                        {field: 'db_user', title: __('Db_user')},
                        {field: 'db_db', title: __('Db_db')},
                        {field: 'db_port', title: __('Db_port')},
                        {field: 'db_charset', title: __('Db_charset')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});