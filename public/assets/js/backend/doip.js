define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'doip/index',
                    add_url: '',
                    edit_url: '',
                    del_url: '',
                    multi_url: '',
                    table: 'domain',
                }
            });

            var table = $("#table");

            //在普通搜索提交搜索前
            table.on('common-search.bs.table', function (event, table, query) {
                //这里可以获取到普通搜索表单中字段的查询条件
                console.log(query);
                var form = $("form", table.$commonsearch);

                //console.log( $("select[name='service_code']", form).val() )

                /*if(!$("select[name='service_code']", form).val()){
                    Layer.alert("请选择节点");
                    return false;
                }*/
                if(!$("input[name='lasttime']", form).val()){
                    Layer.alert("请选择时间");
                    return false;
                }
            });

            //当表格数据加载完成时
            table.on('load-success.bs.table', function (e, data) {
                //var form = $("form", table.$commonsearch);
                //console.log('-----' + $("input[name='timeslot']", form).val())
                if(!$('#nav_tabs li').hasClass('active')){
                    $('#nav_tabs li:first a').click();
                }
            });

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',

                columns: [
                    [
                        {checkbox: true},
                        //{field: 'id', title: __('Id')},
                        {field: 'ip', title: __('Ip'), formatter: Controller.api.formatter.myIp},
                        {field: 'timeslot', title: __('Timeslot'),operate:false},
                        {field: 'domain', title: __('Domain'),operate: false},
                        {field: 'subdomain', title: __('Subdomain'), operate: false},
                        {field: 'lasttime', title: __('Lasttime'), operate:'RANGE', addclass:'datetimerange'},
                        //{field: 'service_code', title: __('Service_code'), searchList: JSON.parse(Config.serviceCodeList), formatter: Table.api.formatter.normal},
                        //{field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1')}, formatter: Table.api.formatter.status},
                        //{field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ],

                //禁用默认搜索
                search: false,
                //启用普通表单搜索
                commonSearch: true,
                showExport:false,
                showColumns:false,
                showToggle:false,
                //可以控制是否默认显示搜索单表,false则隐藏,默认为false
                searchFormVisible: true,

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
        my: function () {
            Controller.api.bindevent();
        },
        editall: function () {
            Controller.api.bindevent();
        },
        editext: function () {
            Controller.api.bindevent();
        },
        detail: function () {

            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'doip/detail',
                    add_url: 'doip/add',
                    edit_url: '',
                    del_url: 'doip/del',
                    multi_url: 'doip/multi',
                    table: 'domain',
                }
            });

            var table = $("#table")

            //在普通搜索渲染后
            table.on('post-common-search.bs.table', function (event, table) {
                var form = $("form", table.$commonsearch);

                //时间
                $("input[name='timeslot']", form).addClass("form-control diycss")
                    .data("date-format","YYYY-MM-DD")
                    .data("use-current",true);

            });

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'id', title: __('Id')},
                        {field: 'ip', title: __('Ip'), formatter: Controller.api.formatter.ip},
                        {field: 'timeslot', title: __('Timeslot'), operate:'>=', addclass:'datetimepicker'},
                        {field: 'domain', title: '顶级域名', formatter: Controller.api.formatter.domain},
                        {field: 'subdomain', title: '二级域名', formatter: Controller.api.formatter.subdomain},
                        //{field: 'redirecturl', title: __('Redirecturl')},
                        //{field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1')}, formatter: Table.api.formatter.status},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'detail',
                                    title: __('核查'),
                                    classname: 'btn btn-xs btn-primary btn-dialog',
                                    icon: 'glyphicon glyphicon-edit',
                                    url: 'doip/editext',
                                    callback: function (data) {
                                        Layer.alert("接收到回传数据：" + JSON.stringify(data), {title: "回传数据"});
                                    }
                                }
                            ],
                            formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            Table.api.bindevent(table);
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            },
            formatter: {
                myIp: function (value, row, index) {
                    //这里我们直接使用row的数据
                    return '<a href="./doip/detail?service_code='+row.service_code+'&ip='+row.ip+'" class="btn btn-xs btn-browser btn-addtabs" title="核查IP:'+row.ip+'">' + row.ip + '</a>';
                },
                ip: function (value, row, index) {
                    //这里我们直接使用row的数据
                    return '' + row.ip + '';
                },
                domain: function (value, row, index) {
                    //这里我们直接使用row的数据
                    return '<a href="doip/editext/ids/'+row.id+'/url/'+row.domain+'" title="核查违法信息" class="btn btn-xs btn-browser btn-dialog">' + row.domain + ' <i class="glyphicon glyphicon-link"></i> </a> ';
                },
                subdomain: function (value, row, index) {
                    //这里我们直接使用row的数据
                    return '<a href="doip/editext/ids/'+row.id+'/url/'+row.subdomain+'" title="核查违法信息" class="btn btn-xs btn-browser btn-dialog">' + row.subdomain + ' <i class="glyphicon glyphicon-link"></i></a> ';
                },
            }

        }
    };
    return Controller;
});

function getNowFormatDate() {
    var date = new Date();
    date.setDate(date.getDate() -7);
    var seperator1 = "-";
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = year + seperator1 + month + seperator1 + strDate;
    return currentdate;
}