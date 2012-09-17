<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Dashboard Tim</title>
        <meta name="author" content="Dashboard Tim" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <meta name="description" content="Dahboard Tim - Visualização dos totais de SMS's das operadoras" />
        <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
        <link href="assets/css/default.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery-ui-1.8.18.custom.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#tabs").slideDown(1000);
                $("#tabs").tabs();
            });
        </script>
    </head>
    <body>
        <div id="header">
            <div class="wrap">
                <h1><img src="assets/images/bg_logo_tim.gif" alt="" title=""></h1>
                <h2>Dashboard Tim</h2>
                <h3><img src="assets/images/bg_logo_radiocontrole.png" alt="" title=""></h3>
            </div>
        </div>
        <div id="container">
            <div id="content">
                <div id="entry_account">
                    <h2>Logado como <u><strong><?php print($usuario) ?></strong></u></h2>
                    <a id="btn_logout" href="<?php print("logout") ?>" title="Sair" alt="Sair">Sair</a>
                </div>
                <div id="tabs" style="display:none;">
                    <ul>
                        <li><a id="total" href="#tabs-1">Estatísticas Gerais</a></li>
                        <li><a id="media" href="#tabs-2">Canais</a></li>
                        <li><a id="portable" href="#tabs-3">Portabilidade</a></li>
                    </ul>

                    <!-- tabs-1 -->
                    <div id="tabs-1">
                        <div style="clear:both;"></div>
                        <div class="boxes">
                            <div class="pizza_result">
                                <h3>Total de<br> Mensagens</h3>
                                <p><?php foreach ($total_geral as $row): ?>
                                        <?php print($row->total_sms); ?>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                        </div>
                        <div class="boxes">
                            <div class="pizza_result">
                                <h3>Total de Mensagens<br> mês de <?php print($data) ?></h3>
                                <?php foreach ($total_mes as $row): ?>
                                    <p><?php print($row->total_mes); ?>
                                    <?php endforeach; ?></p>
                            </div>
                        </div>
                        <div class="boxes">
                            <div class="list_operators">
                                <h3>Total de Mensagens<br> por Operadora</h3>
                                <ul class="operators">
                                    <li><?php print("<strong>Tim</strong>" . "<span>" . $total_operadora->tim . "</span>"); ?></li>
                                    <li><?php print("<strong>Claro</strong>" . "<span>" . $total_operadora->claro . "</span>"); ?></li>
                                    <li><?php print("<strong>Vivo</strong>" . "<span>" . $total_operadora->vivo . "</span>"); ?></li>
                                    <li><?php print("<strong>Oi</strong>" . "<span>" . $total_operadora->oi . "</span>"); ?></li>
                                </ul>
                                <!--<a class="more" href="#">Ver todas</a>-->
                            </div>
                        </div>
                        <div class="boxes" id="last">
                            <div class="total_keywords">
                                <h3>Total Palavras-Chave</h3>
                                <table>
                                    <th>Ranking</th>
                                    <th>Palavra-chave</th>
                                    <th>Total</th>
                                    <?php $a = 1; foreach($total_pc as $row): ?>
                                        <tr>
                                            <td><?php print($a) ?></td>
                                            <td><?php print($row->operadora); ?></td>
                                            <td><?php print($row->total); ?></td>
                                        </tr>
                                    <?php $a++; endforeach; ?>
                                    <tr class="last-child">
                                        <td colspan="3"><!--<a href="#">Ver todas</a>--></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div>
                            <h3>Palavra-chaves X Dia</h3>
                            <table>
                                <th>Palavra-Chave</th>
                                //<?php
//                                $a = 1;
//                                $result = array();
//                                while ($a <= 4) {
//                                    print('<th>' . date('d-m', strtotime($fns->subDaysFromCurrentDate($a))) . '</th>');
//                                    $a++;
//                                }
//                                
//                                $fns->totalKeywordPerDay(3);
//                                ?>
                                
                            </table>
                        </div>
                    </div>

                    <!-- tabs-2 -->
                    <div id="tabs-2">
                        <div class="the_tables">
                            <h3>Canais X Operadoras</h3>
                            <table>
                                <th>Canal</th>
                                <th>Total SMS</th>
                                <th>Tim</th>
                                <th>Claro</th>
                                <th>Vivo</th>
                                <th>Oi</th>
                                <?php
                                $result = $fns->totalChannelPerCarrier();
                                foreach ($result as $row) {
                                    foreach ($row as $r) {
                                        print('<tr>');
                                        print('<td>' . $r['canal'] . '</td>');
                                        print('<td>' . $r['total'] . '</td>');
                                        print('<td>' . $r['tim'] . '</td>');
                                        print('<td>' . $r['claro'] . '</td>');
                                        print('<td>' . $r['vivo'] . '</td>');
                                        print('<td>' . $r['oi'] . '</td>');
                                        print('</tr>');
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>

                    <!-- tabs-3 -->
                    <div id="tabs-3">
                        <div class="boxes_portability">
                            <div class="the_tables">
                                <h3>Operadora X Dia</h3>
                                <table>
                                    <th>Últimos 3 Dias</th>
                                    <th>SMS</th>
                                    <th>Tim</th>
                                    <th>Claro</th>
                                    <th>Vivo</th>
                                    <th>Oi</th>
                                    <?php
                                    $a = 0;
                                    while ($a <= 2) {
                                        print('<tr>');
                                        $data = date('d-m', strtotime($fns->subDaysFromCurrentDate($a)));
                                        print('<td>' . $data . '</td>');
                                        print('<td>' . $fns->totalPerDay($a) . '</td>');
                                        $result = $fns->totalPerCarrierDay($a);
                                        foreach ($result as $row) {

                                            if ($row['op'] == 'TIM' || $a < 4) {
                                                print('<td>' . $row['total'] . '</td>');
                                            } else if ($row['op'] == 'Claro' || $a < 4) {
                                                print('<td>' . $row['total'] . '</td>');
                                            } else if ($row['op'] == 'Vivo' || $a < 4) {
                                                print('<td>' . $row['total'] . '</td>');
                                            } else if ($row['op'] == 'Oi' || $a < 4) {
                                                print('<td>' . $row['total'] . '</td>');
                                            } else {
                                                print('<td>0</td>');
                                            }
                                        }
                                        $a++;
                                        if ($a >= 10) {
                                            break;
                                        }
                                        print('</tr>');
                                    }
                                    ?>
                                </table>
                            </div>    
                            <div class="the_tables">
                                <h3>Operadora X Mês</h3>
                                <table>
                                    <th>Mês</th>
                                    <th>Total SMS</th>
                                    <th>Total Tim</th>
                                    <th>Total Claro</th>
                                    <th>Total Vivo</th>
                                    <th>Total Oi</th>
                                    <?php
                                    $a = 0;
                                    while ($a <= 2) {
                                        print('<tr>');
                                        print('<td>' . $fns->translateMonth(date('m') - $a) . '</td>');
                                        print('<td>' . $fns->totalMessagesMonth($a) . '</td>');
                                        foreach ($fns->totalPerCarrierMonth($a) as $row) {
                                            switch ($row['op']) {
                                                case 'TIM' :
                                                    print('<td>' . $row['total'] . '</td>');
                                                    break;
                                                case 'Claro' :
                                                    print('<td>' . $row['total'] . '</td>');
                                                    break;
                                                case 'Vivo' :
                                                    print('<td>' . $row['total'] . '</td>');
                                                    break;

                                                case 'Oi' :
                                                    print('<td>' . $row['total'] . '</td>');
                                                    break;
                                            }
                                        }
                                        $a++;
                                        print('</tr>');
                                    }
                                    ?>
                                </table>
                            </div>
                            <!-- <div class="the_tables">
                                    <h3>Operadora X Palavra-Chave</h3>
                                </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">
                <div class="wrap">
                    <p>
                        <strong>&copy Dashboard Tim Celular</strong>
                        <a href="mailto:suporte@radiocontrolesms.com.br">suporte@radiocontrolesms.com.br</a>
                    </p>
                </div>
            </div>	
        </div>
    </body>
</html>




<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= $title ?></title>
    </head>
    <body>

    </body>
</html>