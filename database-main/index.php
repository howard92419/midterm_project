<?php
//登入頁面

// Start the session
session_name('homework');
session_start();

?>


<html>
<head>
    <title>Login </title>
    <style>
        .login{
           background-position: center;
           background-size: cover;
           background-repeat: no-repeat;
           width:100%;
           height:400px;
           background-image:url(background_pattern.jpg);
        }
        .login_logo{
            position: absolute;
            top:  2.5em;
            left: 2.5em;
        }
        .login_content{
            padding-bottom: 9px;
            margin: 40px 0 20px;
            border-bottom: 1px solid;
        }
        .fa_fw{
            width: 1.28571429em;
            text-align: center;
        }
        .fa{
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
        }
        .fa_sign_in:before {
            content: "➱";
        }
        .text_warning {
            color: #a94442;
        }
        .content{
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }
        .input{
            position: relative;
            display: table;
            border-collapse: separate;
        }
        .input_form{
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        *{
            box-sizing: border-box;
        }
        .input_group{
            border-left: 0;
        }
        .fa_user{
            content: "☺";
        }
        .box {
            background: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,.07);
        }
        .login-bpx {
            margin: 20px auto;
            width: 100%;
            padding: 20px;
            font: inherit;
            vertical-align: baseline;
            box-sizing: border-box;
            display: block;
            color: #555;


        }
        .p1{
            margin: 0;
            padding: 0;
            border: 0;
            font: inherit;
            vertical-align: baseline;
            margin-bottom: 20px;
            color: #555;
            font-size: 16px;
            line-height: 24px;
            display: block;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;

        }
        .label{
            display: block;
            width: 100%;
            margin-right: 0;
            color: #000;
            vertical-align: middle;
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            line-height: 24px;
            font-family: "Noto Sans TC",'Microsoft JhengHei',sans-serif;
            box-sizing: border-box;
        }
        .field .field:before{
            clear: both;
            display: table;
            content: " ";
            line-height: 24px;
            margin-bottom: 10px;
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            vertical-align: baseline;
            box-sizing: border-box;
            display: block;
            font-family: "Noto Sans TC",'Microsoft JhengHei',sans-serif;
            color: #555;

        }
        .field:after{
            clear: both;
            display: table;
            content: " ";
        }
        :after{
            box-sizing: border-box;
        }
        :before{
            box-sizing: border-box;
        }
        .txt{
            display: block;
            width: 100%;
            color: #888;
            vertical-align: middle;
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            box-sizing: border-box;
            line-height: 24px;
            font-family: "Noto Sans TC",'Microsoft JhengHei',sans-serif;

        }
        input{
            background: #fff;
            border-radius: 0;
            width: 100%;
            margin: 3px 0;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ddd;
            font-family: 'Microsoft JhengHei',sans-serif;
            outline: none;
            -webkit-appearance: none;
            -webkit-box-shadow: none;
            vertical-align: middle;
            box-sizing: border-box;
            writing-mode: horizontal-tb !important;
            font-style: ;
            font-variant-ligatures: ;
            font-variant-caps: ;
            font-variant-numeric: ;
            font-variant-east-asian: ;
            font-variant-alternates: ;
            font-weight: ;
            font-stretch: ;
            font-optical-sizing: ;
            font-kerning: ;
            font-feature-settings: ;
            font-variation-settings: ;
            text-rendering: auto;
            letter-spacing: normal;
            word-spacing: normal;
            line-height: normal;
            text-transform: none;
            text-indent: 0px;
            text-shadow: none;
            -webkit-rtl-ordering: logical;
            margin: 0em;
        }
        .txt-cener{
            text-align: center;
        }
        .m-t-m{
            margin-top: 20px;
        }
        .clerb{
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            vertical-align: baseline;
            box-sizing: border-box;
            display: block;
            font-family: "Noto Sans TC",'Microsoft JhengHei',sans-serif;
            color: #555;
            line-height: 1;
        }
        .btn-green{
            background: #18aa94;
            color: #fff;
        }
        .btn{
            text-align: center;
            outline: none;
            -webkit-appearance: none;
            border: none;
            -webkit-box-shadow: none;
            box-sizing: border-box;
            display: inline-block;
            padding: 8px 25px;
            font-size: 16px;
            cursor: pointer;
            font-family: "Noto Sans TC",'Microsoft JhengHei',sans-serif;
            border-radius: 3px;
            vertical-align: middle;
            writing-mode: horizontal-tb !important;
            font-style: ;
            font-variant-ligatures: ;
            font-variant-caps: ;
            font-variant-numeric: ;
            font-variant-east-asian: ;
            font-variant-alternates: ;
            font-weight: ;
            font-stretch: ;
            font-optical-sizing: ;
            font-kerning: ;x
            font-feature-settings: ;
            font-variation-settings: ;
            text-rendering: auto;
            letter-spacing: normal;
            word-spacing: normal;
            line-height: normal;
            text-transform: none;
            text-indent: 0px;
            text-shadow: none;
            -webkit-rtl-ordering: logical;
            margin: 0em;
        }

    </style>
</head>

<body>
    <div class="login">
        <img class="login_logo" src="title_img.png" width="250" heigh="100" >
    </div>

    <div class="login_content">
        <h3>
            <i class="fa fa_fw fa_sign_in"></i>
            <b>選課登入系統</b>

        </h3>
    </div>

    <div class="content">
        <section>
            <div class="box login-bpx">
                <p class="p1">請輸入逢甲大學帳號與密碼</p>
                <div class="field">
                    <form name="form1" method="post" action="check.php">
                        <div class="label">帳號</div>
                        <div class="txt">
                            <input name="MyHead" class="input">
                        </div>
                    </form>
                </div>
                <div class="field">
                    <form name="form2" method="post" action="check.php">
                        <div class="label">密碼</div>
                        <div class="txt">
                            <input name="password" class="input">
                        </div>
                    </form>
                </div>

                <div class="clerb txt-center m-t-m">
                    <input type="submit" value="登入" class="btn btn-green">
                </div>
                
            </div>
            

        </section>
    </div>
    
    
    

</body>


