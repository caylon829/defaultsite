define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'domain/index',
                    add_url: 'domain/add',
                    edit_url: 'domain/edit',
                    del_url: 'domain/del',
                    multi_url: 'domain/multi',
                    table: 'domain',
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
                        //{field: 'timeslot', title: __('Timeslot'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'domain', title: __('Domain'),operate:false},
                        {field: 'subdomain', title: __('Subdomain'),operate:false},
                        {field: 'lasttime', title: __('Lasttime'), operate:'RANGE', addclass:'datetimerange'},
                        //{field: 'redirecturl', title: __('Redirecturl')},
                        {field: 'ip', title: __('Ip'),operate:'LIKE'},
                        //{field: 'ping_ip', title: __('Ping_ip'),operate:'LIKE'},
                        //{field: 'customer_id', title: __('Customer_id'),operate:false},
                        //{field: 'engineroom_name', title: __('Engineroom_name'),operate:false},
                        //{field: 'icpstatus', title: __('Icpstatus'), searchList: {"0":__('Icpstatus 0'),"1":__('Icpstatus 1'),"2":__('Icpstatus 2')}, formatter: Table.api.formatter.status,operate:false},
                        //{field: 'psorgan', title: __('Psorgan'), searchList: {"0":__('Psorgan 0'),"1":__('Psorgan 1')}, formatter: Table.api.formatter.status,operate:false},
                        //{field: 'service_code', title: __('Service_code'), searchList: JSON.parse(Config.serviceCodeList), formatter: Table.api.formatter.normal},
                        //{field: 'status', title: __('Status'), searchList: {"0":__('Status_0'),"1":__('Status_1'),"2":__('Status_2')}, formatter: Table.api.formatter.status,operate:false},
                        //{field: 'state', title: __('State'), searchList: {"0":__('State_0'),"1":__('State_1')}, formatter: Table.api.formatter.status,operate:false},
                        {field: 'operatorname', title: __('Operatorname'),operate:false},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, buttons:[{
                                name: 'detail',
                                title: '详细',
                                classname: 'btn btn-xs btn-primary btn-dialog',
                                text: '详细',
                                icon: 'fa fa-pencil',
                                url: 'domain/edit',
                                /*confirm:function (row) {
                                    return '解析域名'+row.subdomain;
                                },
                                success: function (data, ret) {
                                    //Layer.alert(ret.msg + ",返回数据：" + JSON.stringify(data));
                                    Layer.alert(ret.msg);
                                    $(".btn-refresh").trigger("click");
                                    //如果需要阻止成功提示，则必须使用return false;
                                    //return false;
                                },
                                error: function (data, ret) {
                                    console.log(data, ret);
                                    Layer.alert(ret.msg);
                                    return false;
                                },
                                hidden:function(row){
                                    //121.201.15.204
                                    //console.log(row);
                                    if(typeof row.ping_ip == "undefined" || row.ping_ip == null || row.ping_ip === ""){

                                    }else{
                                        return  true;
                                    }
                                }
                            }*/}],formatter: Table.api.formatter.buttons}
                    ]
                ],
                //可以控制是否默认显示搜索单表,false则隐藏,默认为false
                searchFormVisible: true,
                search: false,
                showColumns: false,
                showToggle:false,
                showExport:false
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            $("#btn-export-file").click(function () {
                var searchtime=$("#lasttime").val();
                var ip=$("#ip").val();
                // console.log(searchtime+ip);
                // return false;
                /*var ajaxObj = new XMLHttpRequest();

                // （2）设置请求的参数。包括：请求的方法、请求的url。
                ajaxObj.open('get', "domain/export?stime="+searchtime+"&ip="+ip);

                // （3）发送请求
                ajaxObj.send();*/

                window.open("domain/export?stime="+searchtime+"&ip="+ip);
                //window.location.href="domain/export?stime="+searchtime+"&ip="+ip;
                /*$.ajax({
                    data:{stime:searchtime,ip:ip},
                    url:"domain/export?stime="+searchtime+"&ip="+ip,
                    success:function (msg,data) {
                        Layer.alert(msg);
                    },
                    error:function (msg) {
                        Layer.alert(msg);
                    }
                });*/
            });
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            $("#btn-close").click(function () {
               parent.Layer.closeAll();
            });
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