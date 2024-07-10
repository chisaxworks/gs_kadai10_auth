// ユーザ名ボタンtoggle
$('#uname_disp').click(function () {

    if($('#uname_disp').hasClass('active')){
        $('#logout').slideUp(300);
        $('#uname_disp').removeClass('active');
    }else{
        $('#logout').slideDown(300);
        $('#uname_disp').addClass('active');
    };

});

// 色選択した時の動作
// 新規登録エリア
$(".colors .color").on("click", function () {
    // 選択したもの以外は半透明にする
    $('.colors .color').css('opacity', '0.6');
    $(this).css('opacity', '1.0');
});

// レコード削除時アラート
$(".delete_btn").on("click", function () {

    if(!confirm("削除してもよろしいですか？")){
        return false;
    }
});

// ログインボタンクリック時アラート
$("#login").on("click", function(){
    if ($("#usermail").val() === "") {
        alert("メールを入力してください");
        return false;
    }else if($("#password").val() === ""){
        alert("パスワードを入力してください");
        return false;
    }
});

// ユーザ登録ボタンクリック時アラート
$("#register").on("click", function(){
    if ($("#reg_username").val() === "") {
        alert("名前を入力してください");
        return false;
    }else if($("#reg_usermail").val() === ""){
        alert("メールを入力してください");
        return false;
    }else if($("#reg_password").val() === ""){
        alert("パスワードを入力してください");
        return false;
    }
});

// 更新（update）ボタンクリック時アラート
$("#update").on("click", function(){
    if ($("#up_sname").val() === "") {
        alert("サービス名は必須です");
        return false;
    }else if($("#up_url").val() === ""){
        alert("サービスURLは必須です");
        return false;
    }else if($("#up_mail").val() === ""){
        alert("メールアドレスは必須です");
        return false;
    }else if($("#up_plan").val() === ""){
        alert("利用プランは必須です");
        return false;
    }else if($("#up_payment").val() === ""){
        alert("支払有無は必須です");
        return false;
    }
    
});