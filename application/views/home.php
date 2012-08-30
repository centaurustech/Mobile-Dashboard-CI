<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>
<div class="boxes">
    <div class="pizza_result">
        <h3>Total de<br> Mensagens</h3>
        <p><?php foreach($geral as $row): print($row->total_sms); endforeach;?>
    </div>
</div>
</body>
</html>