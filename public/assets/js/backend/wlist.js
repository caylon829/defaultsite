define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'wlist/index' + location.search,
                    add_url: 'wlist/add',
                    edit_url: 'wlist/edit',
                    del_url: 'wlist/del',
                    multi_url: 'wlist/multi',
                    table: 'wlist',
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
                        {field: 'id', title: __('Id'),operate:false},
                        {field: 'domain', title: __('Domain_id'),operate:false},
                        {field: 'type', title: __('Type'), searchList: {"1":__('Type 1'),"0":__('Type 0')}, formatter: Table.api.formatter.normal},
                        {field: 'wlist_creator', title: __('Wlist_creator'),operate:'LIKE'},
                        {field: 'wlist_createtime', title: __('Wlist_createtime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'updatetime', title: __('Updatetime'), addclass:'datetimerange',operate:false},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2')}, formatter: Table.api.formatter.status,operate:false},
                        //{field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                        {
                            field: 'buttons',
                            width: "120px",
                            title: __('操作'),
                            table: table,
                            events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'edit',
                                    text: __('审核'),
                                    title: __('审核'),
                                    classname: 'btn btn-xs btn-success btn-magic btn-dialog',
                                    icon: 'fa fa-magic',
                                    url: 'wlist/edit',
                                    hidden:function (row) {
                                        if(row.status>=1){
                                            return true;
                                        }
                                    }
                                }
                            ],
                            formatter: Table.api.formatter.buttons,operate:false
                        }
                    ]
                ],
                searchFormVisible: true,
                search: false,
                showColumns: false,
                showToggle:false,
                showExport:false
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        log:function(){
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    table: 'wlist_log',
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
                        {field: 'id', title: __('Id'),operate:false},
                        {field: 'domain', title: __('Domain_id'),operate:false},
                        {field: 'type', title: __('Type'), searchList: {"1":__('Type 1'),"0":__('Type 0')}, formatter: Table.api.formatter.normal},
                        {field: 'wlist_creator', title: __('Wlist_creator'),operate:'LIKE'},
                        {field: 'wlist_createtime', title: __('Wlist_createtime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'updatetime', title: __('Updatetime'), addclass:'datetimerange',operate:false},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2')}, formatter: Table.api.formatter.status,operate:false},
                        //{field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ],
                searchFormVisible: true,
                search: false,
                showColumns: false,
                showToggle:false,
                showExport:false
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