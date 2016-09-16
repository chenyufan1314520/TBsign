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