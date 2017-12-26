<!DOCTYPE html>
<html id="signin-page" class=" js no-mobile desktop no-ie customer-section w-1366 gt-240 gt-320 gt-480 gt-640 gt-768 gt-800 gt-1024 gt-1280 lt-1440 lt-1680 lt-1920 no-portrait landscape gradient rgba opacity textshadow multiplebgs boxshadow borderimage borderradius no-cssreflections csstransforms csstransitions no-touch no-retina fontface domloaded"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <meta name="Login" content="width=device-width">
    <title>Login</title>
    <link href="/Login_Files/Login.css" rel="stylesheet" type="text/css">
    <link href="/Login_Files/DropdownStyle.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="divLoading" style="display: none">
        <h2>Loading... please wait</h2>
    </div>
    <div id="mainholder">
        <form action="" method="POST" name="fLogin">
            <center>
                <div class="content">
                    <div class="wrapper">
                        <div class="inputContainer">
                            <div class="logo">
                            </div>
                            <table>
                                <tbody><tr>
                                        <td class="header">
                                            <div class="title" id="divTitle">Login</div>
                                            <div class="language-box">
                                                <div id="ddLanguage" class="language-select ddSelect">
                                                </div>
                                                <input value="en-US" id="hidLanguage" name="hidLanguage" type="hidden">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="row">
                                            <input id="txtUserName" name="LoginFormAdmin[username]" class="custom-textbox username" placeholder="Username" tabindex="1" autocomplete="off" maxlength="50" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="row">
                                            <input id="txtPassWord" name="LoginFormAdmin[password]" tabindex="2" placeholder="Password" class="custom-textbox password" value="" type="password">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="row custom-row">
                                            <label class="showPass">
                                                <input id="chbShowPass" class="checkShowPass" onclick="Sphinx.Login.showPassword(this)" tabindex="3" type="checkbox">
                                                <span id="lbShowPass">Show password</span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="row custom-row" id="captcha">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="row">
                                            <input class="btnLogin" id="btnLogin" value="Login" onclick="return Sphinx.Login.doLogin();" tabindex="5" type="button">
                                        </td>
                                    </tr>
                                </tbody></table>
                            <div style="display: block;" class="errorMessage" errcode="1" id="errmsg">
                                <?php
                                if ($model->getErrors() != null) {
                                    foreach ($model->getErrors() as $errors) {
                                        foreach ($errors as $error) {
                                            echo '<p>' . $error . '</p>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div id="divPopupMobileVersion" style="color: #000; font-size: 14px; padding-top: 20px;">
                    </div>
                </div>
            </center>
        </form>
    </div>

    <script src="/Login_Files/jquery-1.js" type="text/javascript"></script>
    <script src="/Login_Files/head.js" type="text/javascript"></script>
    <script src="/Login_Files/bootstrap-dropdown.js" type="text/javascript"></script>
    <script src="/Login_Files/Core.js" type="text/javascript"></script>
    <script src="/Login_Files/PlaceHolder.js" type="text/javascript"></script>
    <script src="/Login_Files/Resources.js" type="text/javascript"></script>
    <script src="/Login_Files/Login.js" type="text/javascript"></script>
    <script src="/Login_Files/Dropdown.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">
        var _page = {
            errCode: 0,
            errMsg: '',
            language: 0,
            ip: '',
            __utms: 'F797E5A68C7A38AC76799C78BF528F',
            domain: 'b88ag.com',
            captcha: '1124',
            fpsActivator: '//sc.detecas.com/di/activator.ashx'
        };

        window.rootUrl = '/';

        if(parseInt(_page.errCode) === -1) {
            $('#mainholder').css('display', 'none');
            $('#divLoading').css('display', 'block');
            $("body").css("background", "none");
            window.location.href = '';
        }
    </script>
    <!--<script type="text/javascript" src="/Login_Files/activator.ashx"></script>-->
</body>
</html>