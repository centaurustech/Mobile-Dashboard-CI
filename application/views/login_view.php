<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Dashboard Tim</title>
        <meta name="author" content="Dashboard Tim" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <meta name="description" content="Dahboard Tim - Visualização dos totais de SMS's das operadoras" />
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
        <link href="assets/css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <body><div id="form_login">
            <h1><img src="assets/images/bg_logo_tim.gif" alt="" title=""></h1>
            <div id="erros">
                <?php print(validation_errors());?>
            </div>
            
            <?php print(form_open('login')); ?>
            <div class="fields">
                <?php print(form_label('Login:', 'login')); ?>
                <?php print(form_input('login', set_value('login'), 'id=login')); ?>
            </div>
            <div class="fields">
                <?php print(form_label('Password:', 'password')); ?>
                <?php print(form_password('password', '', 'id=passord')); ?>
            </div>
            <div class="fields">
                <?php print(form_submit('submit', 'Logar')); ?>
            </div>
            <?php print(form_close()); ?>
            <div style="clear:both;"></div>
            <div id="footer">
                <p>
                    <span>&copy; Dahsboard Tim Celular</span>
                    <a href="mailto:suporte@radiocontrolesms.com.br">suporte@radiocontrolesms.com.br</a>
                </p>
            </div>
        </div>
    </body>
</html>
