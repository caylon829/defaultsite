define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'doinfo/index',
                    add_url: 'doinfo/add',
                    edit_url: 'doinfo/edit',
                    del_url: 'doinfo/del',
                    multi_url: 'doinfo/multi',
                    table: 'doinfo',
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
                        {field: 'timeslot', title: __('Timeslot')},
                        {field: 'domain', title: __('Domain')},
                        {field: 'subdomain', title: __('Subdomain')},
                        {field: 'ip', title: __('Ip')},
                        {field: 'icpstatus', title: __('Icpstatus')},
                        {field: 'service_code', title: __('Service_code')},
                        {field: 'lasttime', title: __('Lasttime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'lawtype', title: __('Lawtype')},
                        {field: 'status', title: __('Status')},
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