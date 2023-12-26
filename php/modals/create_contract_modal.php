<div class="modal" id="create_contract_modal" style="display:block;background-color:rgba(0,0,0,0.6);" hidden>
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Создание смарт контракта</h5>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="EnableCreateContract(false);" aria-label="Close"><i class="fa fa-close" aria-hidden="true"></i></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="contract_name">Наименование контракта:</label>
            <input type="text" class="form-control" id="contract_name" placeholder="Введите наименование контракта...">
        </div>
        <div class="form-group">
            <label for="contract_desc">Описание контракта:</label>
            <textarea class="form-control" id="contract_desc" rows="3" placeholder="Введите описание контракта..."></textarea>
        </div>
        <div class="form-group">
            <label for="contract_wallet">Адрес кошелька клиента:</label>
            <input type="text" class="form-control" id="contract_wallet" placeholder="Введите адрес кошелька клиента...">
        </div>
        <div class="form-group">
            <label for="contract_tokens">Количество токенов</label>
            <input type="text" class="form-control" id="contract_tokens" placeholder="Введите количество токенов...">
        </div>
        <div class="form-group" hidden>
            <label for="contract_name">Документ контракта</label>
            <br>
            <button class="btn btn-dark" id="cc_selbtn" onclick="document.getElementById('cc_file').click();">Выбрать файл</button>
            <input onchange="CreateContractChange(this);" type="file" id="cc_file" hidden />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="CreateContractRequest()" class="btn btn-primary">Создать контракт</button>
      </div>
    </div>
  </div>
</div>

<script>
var cc_hash_file = "";
var cc_name_file = "";
function EnableCreateContract(show){
    document.getElementById('create_contract_modal').hidden = !show;
}

function CreateContractRequest(){
    var contractName = document.getElementById('contract_name').value;
    var contractDesc = document.getElementById('contract_desc').value;
    var contractWallet = document.getElementById('contract_wallet').value;
    var contractTokens = document.getElementById('contract_tokens').value;
    var wallet = "<? echo $user['wallet']; ?>";
    var privateKey = "<? echo $user['private_key']; ?>";
    $.post('php/create_contract.php', {
        name: contractName,
        desc: contractDesc,
        wallet: contractWallet,
        hash: cc_hash_file,
        fileName: cc_name_file,
        tokens: contractTokens,
        sWallet : wallet,
        sKey : privateKey,
        owner: <? echo $_SESSION['id']; ?>,
    }, function(data){
        alert("Контракт успешно создан!");
        EnableCreateContract(false);
        window.location.href = "lk.php";
    });
    EnableCreateContract(false);
}

function CreateContractChange(el){
    var fileInput = el;
    var file = fileInput.files[0];

    var formData = new FormData();
    formData.append('file', file);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../tools/uploadFile.php', true);

    xhr.onload = function() {
        if (this.status === 200) {
            var response = JSON.parse(this.responseText);
            if (response.success) {
                cc_hash_file = response.hash;
                cc_name_file = response.name;
            } else {
                alert('Ошибка загрузки файла: ' + response.message);
            }
        }
    };

    xhr.send(formData);
    
    document.getElementById('cc_selbtn').innerText =  el.files[0].name;
}
</script>