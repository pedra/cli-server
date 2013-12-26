<?php
$msg = null;
$val = 0 + (isset($_POST['tempo']) ? $_POST['tempo'] : 1800);

if(isset($_POST['reset'])) {
    exec('shutdown /a');
    $msg = 'Desligamento <b>Cancelado</b>.';
}
if(isset($_POST['run'])){
    if($val >= 1800 && $val <= 12600) {
        exec('shutdown /s /f /t '.$val);
        $msg = 'Desligamento agendado para <b>'.date('H:i:s', $val).'</b> Hms.';
    }
}

function sel($var){
    global $val;
    if($var == $val) echo ' selected ';
}

?>
        <h1>Power<span>&copy;</span></h1>
        
        
        <form  method="post" action="">
            <?php if($msg != null) echo '<div class="msg" id="msg">'.$msg.'</div>';?>
            <select name="tempo">
                <option value="1800"<?php sel(1800)?>>30 minutos</option>
                <option value="3600"<?php sel(3600)?>>1 hora</option>
                <option value="5400"<?php sel(5400)?>>1 hora & 30 minutos</option>
                <option value="7200"<?php sel(7200)?>>2 horas</option>
                <option value="9000"<?php sel(9000)?>>2 horas & 30 minutos</option>
                <option value="12600"<?php sel(12600)?>>3 horas</option>
            </select>
            <button name="reset">Reset</button>
            <button name="run">Run</button>
            <p>Selecione o tempo de desligamento e click em "Run".<br>Para cancelar click em "Reset".</p>
        </form>

