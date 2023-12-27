<div class="modal" id="c_modal" style="display:block;background-color:rgba(0,0,0,0.6);" hidden>
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Информация о контракте</h5>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="ShowContractModal(false);" aria-label="Close"><i class="fa fa-close" aria-hidden="true"></i></button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5>Статус контракта</h5>
                        <p id="admin_status_approved">Статус одобрения Отправителем: </p>
                        
                        <p id="client_status_approved" <? if($user['roleId'] != "0") echo "hidden"; ?> >Статус одобрения Получаетелем: </p>
                        <button class="btn btn-success" id="toSign" onclick="ShowSignModal(true);">Подписать</button>
                        <input type="file" id="cv_file" onchange="updateCvitanse(this);" hidden>
                        <p style="color:green;" id="docF">Документ, подтверждающий исполнение условий контракта успешно загружен.</p>
                        <button class="btn btn-primary" id="cvitans" onclick="document.getElementById('cv_file').click();" style="display:none;">Загрузите документ, подтверждающий исполнение.</button>
                    <hr>
                </div>
                <div class="col-6">
                    <p id="contract_name_t">Название контракта: </p>
                    <p id="contract_desc_t" style="    overflow: hidden;
    text-wrap: nowrap;
    text-overflow: ellipsis;">Описание контракта: </p>
                    <p id="contract_date_t">Дата создания контракта: </p>
                    <hr>
                    <div id="contract_code2" style="height:800px;">
                    <iframe id="fileView" src="https://docs.google.com/gview?url=http://uniblock24.beget.tech/uploads/6576aabc605ce.docx&embedded=true" style="width:100%;height:100%;"></iframe>
                    <a href="" id="contract_download" class="btn btn-dark" download>Скачать документ</a>
                    </div>
                </div>
                <div class="col-6">
                    <h2>Код контракта</h2>
                    <p id="contract_code3">Код контракта сгенерируется после подписания контракта</p>
                    <!--<p> Компилятор Solidity v.0.8.23</p>-->
                    <style>
                    .hljs-number{
                        color:#df00ff;
                    }
                    .hljs-built_in{
                        color: #fff900;
                    }
                    .hljs-section, .hljs-title {
                        color: #00b9ff;
                    }
                    </style>
                    <pre id="contract_code">
                        <p> Компилятор Solidity v.0.5.1</p>
                    <code class="language-csharp" style="background-color:#0a0d22;color:white;">
pragma solidity >=0.5.0; 
 
contract UniblockTestContract { 
    address public administrator; 
    address public lawyer; 
    address public client; 
     
    string public dataToSign; 
    bool public adminSigned; 
    bool public lawyerSigned; 
    bool public clientSigned; 
     
    constructor(address _lawyer, address _client) public { 
        administrator = msg.sender; 
        lawyer = _lawyer; 
        client = _client; 
    } 
 
    function addDataToSign(string memory _data) public { 
        require(msg.sender == administrator, "Only administrator can perform this action"); 
        require(bytes(_data).length > 0, "Data cannot be empty"); 
         
        dataToSign = _data; 
        adminSigned = false; 
        lawyerSigned = false; 
        clientSigned = false; 
    } 
     
    function adminSign() public { 
        require(msg.sender == administrator, "Only administrator can perform this action"); 
        require(bytes(dataToSign).length > 0, "No data to sign"); 
         
        adminSigned = true; 
    } 
     
    function lawyerSign() public { 
        if (adminSigned) { 
            lawyerSigned = true; 
        } 
 
        else { 
            revert("Administrator has not yet signed for this smart-contract"); 
        } 
    } 
     
    function clientSign() public { 
        if (adminSigned && lawyerSigned) { 
            clientSigned = true; 
        } 
 
        else { 
            revert("Admin and Lawyer has not yet signed for this smart-contract"); 
        } 
    } 
     
    function isDataSigned() public view returns (bool) { 
        return adminSigned && lawyerSigned && clientSigned; 
    } 
}
                    </code></pre>
                    
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="ShowContractModal(false);" class="btn btn-dark">Закрыть</button>
      </div>
    </div>
  </div>
</div>
<p hidden id="sen"></p>
<script>

function updateCvitanse(el){
                        var fileInput = el;
                        var file = fileInput.files[0];
                    
                        var formData = new FormData();
                        formData.append('file', file);
                    
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '../../tools/uploadTicket.php?id='+contractId, true);
                    
                        xhr.onload = function() {
                                var response = JSON.parse(this.responseText);
                                alert("Квитанция успешно загружена!");
                            
                        };
                    
                        xhr.send(formData);
}

function ShowContractModal(show){
    document.getElementById('c_modal').hidden = !show;
}

function formatApproveColorAdmin(value){
    if(value == 0){
        return "Статус подписания Отправителем: <span style='color:blue'>Ожидает подписания</span>";
    }
    if(value == 1){
        return "Статус подписания Отправителем: <span style='color:green'>Подписано</span>";
    }
    if(value == 2){
        return "Статус подписания Отправителем: <span style='color:red'>Отклонён</span>";
    }
}
function formatApproveColorClient(value){
    if(value == 0){
        return "Статус подписания Получаетелем: <span style='color:blue'>Ожидает отправителя</span>";
    }
    if(value == 1){
        return "Статус подписания Получаетелем: <span style='color:green'>Подписано</span>";
    }
    if(value == 2){
        return "Статус подписания Получаетелем: <span style='color:red'>Отклонён</span>";
    }
}
var Sender;
function ShowContract(id,name,date,fileName,adminApp,clientApp,cId,fileSrc,hash,sender,ticket){
    document.getElementById('docF').innerHTML = "";

    var role = sender == '<? echo $user['wallet'] ?>' ? 0 : 2;
    console.log(sender+"/"+role);
    contractId = cId;
    document.getElementById('sen').innerHTML = role;
    document.getElementById('contract_name_t').innerHTML = "Название контракта: <b>"+name+"</b>";
    document.getElementById('contract_desc_t').innerHTML = "Хэш контракта: <b>"+hash+"</b>";
    document.getElementById('contract_date_t').innerHTML = "Дата создания контракта: <b>"+date+"</b>";
    document.getElementById('contract_download').href = "../../vendor/"+fileSrc;
    document.getElementById('fileView').src = "https://docs.google.com/gview?url=http://uniblock24.beget.tech/vendor/"+fileSrc+"&embedded=true";
    document.getElementById('admin_status_approved').innerHTML = formatApproveColorAdmin(adminApp);
    document.getElementById('client_status_approved').innerHTML = formatApproveColorClient(clientApp);
    
    if((role == 0 && adminApp == 0) || (role == 2 && clientApp == 0 && adminApp == 1)){
        document.getElementById('toSign').style.display = "block";
    }else{
        document.getElementById('toSign').style.display = "none";
    }
    
    if(adminApp == 1 && clientApp == 1){
        document.getElementById('contract_code').style.display = "block";
        document.getElementById('contract_code2').style.display = "block";
        document.getElementById('contract_code3').style.display = "none";
        if(role == 2){
            if(ticket!='-'){
                document.getElementById('cvitans').style.display = "none";
                document.getElementById('docF').innerHTML = "Документ, подтверждающий исполнение условий контракта успешно загружен.";
            }else{
                document.getElementById('cvitans').style.display = "block";
            }
        }else{
            document.getElementById('cvitans').style.display = "none";
        }
    }else{
        document.getElementById('contract_code').style.display = "none";
        document.getElementById('contract_code2').style.display = "none";
        document.getElementById('contract_code3').style.display = "block";
    }
    if(hash!="0x000000000000000000"){
        document.getElementById('contract_download').style.display = "block";
    }else{
        document.getElementById('contract_download').style.display = "none";
    }
    ShowContractModal(true);
}
</script>