// 刷新贴吧列表
function reftieba(bid){
    $("#reftieba").attr("disabled", "disabled");

    $.ajax({
        type: "post",
        url : "./ajax.php?mod=showtb",
        dataType: "json",
        data: "do=ref&bid="+bid,
        success: function(result){
            if (result.code == 0) {
                notie('success', '刷新成功', true);
                setTimeout("window.location.reload()",500)
            } else {
                notie('error', result.msg , true);
            }
            $("#reftieba").attr("disabled",false);
        }
    });
}
$('#refall').click(function(){
    $("#refall").attr("disabled", "disabled");
    $.ajax({
        type: "post",
        url : "./ajax.php?mod=showtb",
        dataType: "json",
        data: "do=refall",
        success: function(result){
            if (result.code == 0) {
                notie('success', '刷新成功', true);
                setTimeout("window.location.reload()",500)
            } else {
                notie('error', result.msg , true);
            }
            $("#refall").attr("disabled",false);
        }
    });
});

// 修改个人信息
$("#updata").click(function(){
    var email = $("#email").val();
    var password = $("#password").val();
    var avatar = $('input[name=avatar]:checked').val();

    $.ajax({
        type: "post",
        url : "./ajax.php?mod=profile",
        dataType: "json",
        data: "email="+email+"&password="+password+"&avatar_type="+avatar,
        success: function(result){
            if (result.code == 0) {
                notie('success', '修改成功', true);
            } else if (result.code == -1) {
                notie('error', result.msg, true)
            }
        }
    });
});

// 添加百度账号
$("#addbdid_submit").click(function(){
    var user = $("#user").val();
    var passwd = $("#passwd").val();
    var vcode = $("#vcode").val();
    var vcode_md5 = $("#vcode_md5").val();

    $.ajax({
        type: "post",
        url : "./ajax.php?mod=baiduid",
        dataType: "json",
        data: "do=login"+"&user="+user+"&password="+passwd+"&vcode="+vcode+"&vcode_md5="+vcode_md5,
        success: function(result){
            if(result.code==0){
                var tiebaret=eval("("+result.info+")");
                if(typeof(tiebaret.user)!='undefined'){
                    addbduss(tiebaret['user']['BDUSS']);
                }else{
                    switch(tiebaret.error_code){
                        case '5':
                            $("#yzm").html('<div class="input-group"><span class="input-group-addon">验证码</span><input type="text" class="form-control" id="vcode" placeholder="验证码"></div><br><img src="'+tiebaret.anti.vcode_pic_url+'"><input type="hidden" id="vcode_md5" value="'+tiebaret.anti.vcode_md5+'">');
                            break;
                        case '6':
                            $("#yzm").html('<div class="input-group"><span class="input-group-addon">验证码</span><input type="text" class="form-control" id="vcode" placeholder="验证码"></div><br><img src="'+tiebaret.anti.vcode_pic_url+'"><input type="hidden" id="vcode_md5" value="'+tiebaret.anti.vcode_md5+'">');
                            break;
                    }
                    notie('warning',tiebaret['error_msg'], true)
                }
            }else{
                notie('error',result.msg, true)
            }
        }
    });
});

$("#addbduss").click(function(){
    var bduss = $("#bduss").val();
    addbduss(bduss);
});

function addbduss(bduss){
    $.ajax({
        type: "post",
        url : "./ajax.php?mod=baiduid",
        dataType: "json",
        data: "do=add&bduss="+bduss,
        success: function(result){
            if (result.code == 0) {
                notie('success', '添加成功', true);
                setTimeout("window.location.reload()",500);
            } else {
                notie('error', result.msg , true)
            }
        }
    });
}

// 删除百度账号
function delbduss(bid){
    $.ajax({
        type: "post",
        url : "./ajax.php?mod=baiduid",
        dataType: "json",
        data: "do=delete&bid="+bid,
        success: function(result){
            if (result.code == 0) {
                notie('success', '删除成功', true);
                setTimeout("window.location.reload()",500);
            } else {
                notie('error', result.msg , true);
            }
        }
    });
}

