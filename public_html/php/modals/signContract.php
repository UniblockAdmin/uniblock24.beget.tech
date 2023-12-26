<div class="modal" id="ss_modal" style="display:block;background-color:rgba(0,0,0,0.6);" hidden>
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Введите ваш приватный ключ</h5>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="ShowSignModal(false);" aria-label="Close"><i class="fa fa-close" aria-hidden="true"></i></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="ss_key">Ваш приватный ключ</label>
            <input type="text" class="form-control" id="ss_key" value="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="Sign();" class="btn btn-success">Подписать</button>
        <button type="button" onclick="ShowSignModal(false);" class="btn btn-dark">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<script>
function ShowSignModal(show){
    document.getElementById('ss_key').value = GetPrivateKey();
    document.getElementById('ss_modal').hidden = !show;
}

function Sign(){
    var roleId =  document.getElementById('sen').innerHTML;
    var column = "";
    var value = document.getElementById('ss_key').value;
    var column2 = "";
    var value2 = "";
    if(roleId == 0){
        column = "adminSign";
        column2 = "adminApproved";
        value2 = 1;
    }else{
        column = "clientSign";
        column2 = "clientApproved";
        value2 = 1;
    }
    $.post('php/signContract.php', {id: contractId, column : column, value : value, column2 : column2, value2: value2}, function(data){
                    alert("Успешно");
                    ShowSignModal(false);
                    window.location.href = "lk.php";
                
            });
            
}
</script>