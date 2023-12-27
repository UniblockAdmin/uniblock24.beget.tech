<?
$query = "SELECT * FROM `SmartContracts` WHERE `clientKey` = '".$user['wallet']."' OR `senderAddress` = '".$user['wallet']."';"; 
$link = mysqli_connect($db_server, $db_user, $db_password, $db_table);
$sql = mysqli_query($link, $query);

if($sql->num_rows == 0){
    echo "<div class=\"card p-3 mt-2\"><p>У вас нет активных контрактов.</p></div>";
    
}else{
    foreach($sql as $r){
    echo '<div class="card mt-2"><div class="row p-2">
                            <div class="col">
                                <p style="margin-top:15px;"><b>Название: </b>'.$r['name'].'</p>
                                <p><b>Адрес контракта: </b>0x'.$r['hash'].'</p>
                                <button align="right" style="float:right" class="btn btn-dark" onclick="ShowContract('.$r['id'].',\''.$r['name'].'\',\''.$r['created_date'].'\',\''.$r['fileName'].'\','.$r['adminApproved'].','.$r['clientApproved'].','.$r['id'].',\''.$r['genFile'].'\',\''.$r['hash'].'\',\''.$r['senderAddress'].'\',\''.$r['ticket'].'\');" title="Открыть информацию о контракте"><img style="width:22px;" src="../images/view.png"> Открыть контракт</button>
                            </div>
                        </div></div>';
    }
    
}
?>