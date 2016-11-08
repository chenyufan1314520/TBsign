// 用户管理
$(function () {
    $('#setting_panel_toggle').on("click", function(e){
        e.preventDefault();
        $('#setting_panel').toggleClass('settings-show');
    });

});
$("#revise").click(function(){
    var list= $('input:radio[name="do"]:checked').val();
    var uid = $('input[name="uid"]:checked').val();
    if(list==null){
        notie('error', '请选中一个', true)
    } else if(list=="cookie"){
        $.ajax({
            type: "post",
            url : "./ajax.php?mod=admin-user",
            dataType: "json",
            data: "do=cookie&uid[]="+uid,
            success: function(result){
                if (result.code == 0) {
                    notie('success', '删除成功', true);
                    setTimeout("window.location.reload()",500)
                } else {
                    notie('error', result.msg , true);
                }
            }
        });
    } else if(list=="delete"){
        $.ajax({
            type: "post",
            url : "./ajax.php?mod=admin-user",
            dataType: "json",
            data: "do=delete&uid[]="+uid,
            success: function(result){
                if (result.code == 0) {
                    notie('success', '删除成功', true);
                    setTimeout("window.location.reload()",500)
                } else {
                    notie('error', result.msg , true);
                }
            }
        });
    } else if(list=="group"){
        $.ajax({
            type: "post",
            url : "./ajax.php?mod=admin-user",
            dataType: "json",
            data: "do=group&uid[]="+uid+"&gid="+$('option:selected') .val(),
            success: function(result){
                if (result.code == 0) {
                    notie('success', '修改成功', true);
                    setTimeout("window.location.reload()",500)
                } else {
                    notie('error', result.msg , true);
                }
            }
        });
    }

});

// 系统设置
$("#set").click(function(){
    var siteurl = $("#siteurl").val();
    var sitename = $("#sitename").val();
    var beian = $("#beian").val();
    var sitenotice = $("#sitenotice").val();

    // Ajax 提交开始
    $.ajax({
        type: "post",
        url : "./ajax.php?mod=admin-set",
        dataType: "json",
        data: "siteurl="+siteurl+"&sitename="+sitename+"&sitebeian="+beian+"&sitenotice="+sitenotice,
        success: function(result){
            if (result.code == 0) {
                notie('success', '提交成功', true)
                setTimeout("window.location.reload()",500)
            } else if (result.code == -1) {
                notie('error', result.msg, true)
            }
        }
    });
});


// 插件管理
function activate(pcn) {
    $.ajax({
        type: "post",
        url : "./ajax.php?mod=admin-plugins",
        dataType: "json",
        data: "do=activate&pcn="+pcn,
        success: function(result){
            if (result.code == 0) {
                notie('success', '启用成功', true);
                setTimeout("window.location.reload()",500)
            } else {
                notie('error', result.msg , true);
            }
        }
    });
}

function deactivate(pcn) {
    $.ajax({
        type: "post",
        url : "./ajax.php?mod=admin-plugins",
        dataType: "json",
        data: "do=deactivate&pcn="+pcn,
        success: function(result){
            if (result.code == 0) {
                notie('success', '禁用成功', true);
                setTimeout("window.location.reload()",500)
            } else {
                notie('error', result.msg , true);
            }
        }
    });
}

function pluginisit(pcn, pluginame) {
    $('#myModalLabel').html(pluginame);
    $.ajax({
        type: "post",
        url : "./ajax.php?mod=admin-plugins",
        data: "do=config&pcn="+pcn,
        success: function(result){
            $('#plugin-sit').html(result);
        }
    });
}
// 绑定页面
function user_search(user){
    $.ajax({
        type: "POST",
        url:"https://panel.tbsign.in/function.php?mod=user_search",
        data: 'user=' + user,
        dataType: "json",
        async: false,

        success: function(result) {
            uid = result.uid;
        }
    });
    return uid;
}
$("body").keydown(function() {
    if (event.keyCode == "13") {
        $("#login").click();
    }
});
$("#login").click(function(){
    var user = $("#user").val();
    var uid = user_search(user);
    var password = $("#password").val();

    $.ajax({
        type: "post",
        url : "https://panel.tbsign.in/ajax.php?mod=login",
        dataType: "json",
        data: "uid="+uid+"&password="+password,
        success: function(result){
            if (result.code == 0) {
                $.ajax({
                    type: "post",
                    url : "./ajax.php?mod=admin-cloud",
                    dataType: "json",
                    data: "do=claim&uss="+result.uss,
                    success: function(claim){
                        if (claim.code == 0) {
                            notie('success', '绑定成功', true);
                        } else {
                            notie('error', claim.msg, true);
                        }
                    }
                });
            } else {
                notie('error', result.msg, true);
            }
        }
    });
});