define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'lawrule/index',
                    add_url: 'lawrule/add',
                    edit_url: 'lawrule/edit',
                    del_url: 'lawrule/del',
                    multi_url: 'lawrule/multi',
                    table: 'lawrule',
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
                        {field: 'lawtype', title: __('Lawtype'), searchList: JSON.parse(Config.lawtypeList), formatter: Table.api.formatter.normal},
                        {field: 'keywords', title: __('Keywords')},
                        {field: 'matchnum', title: __('Matchnum')},
                        {field: 'state_switch', title: __('State_switch'), searchList: {"0":__('State_switch 0'),"1":__('State_switch 1')}, formatter: Table.api.formatter.toggle},
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