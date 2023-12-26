<div class="modal" id="pp_modal" style="display:block;background-color:rgba(0,0,0,0.6);" hidden>
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Данные пользователя</h5>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="ShowPrivateModal(false);" aria-label="Close"><i class="fa fa-close" aria-hidden="true"></i></button>
      </div>
      <div class="modal-body">
        <label for="pp_wallet">Ваш адрес кошелька</label>
        <div class="input-group mb-3">
              <input type="text" class="form-control" value="" id="pp_wallet" aria-describedby="button-addon2" readonly>
              <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="copyToClipboardWallet();">Скопировать</button>
        </div>
        
        <label for="pp_key">Ваш приватный ключ</label>
        <div class="input-group mb-3">
              <input type="text" class="form-control" value="" id="pp_key" aria-describedby="button-addon1" readonly>
              <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="copyToClipboardKey();">Скопировать</button>
        </div>
        
        <div id="qrcode" style="display: block;
  width: fit-content; /* or specify a fixed width */
  margin: 0 auto;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="ShowPrivateModal(false);" class="btn btn-dark">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<script>
var qrcode = new QRCode("qrcode", {
    text: document.getElementById('pp_key').value.toString(),
    width: 256,
    height: 256,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
});
function ShowPrivateModal(show){
    qrcode.clear();
    document.getElementById('pp_modal').hidden = !show;
    document.getElementById('pp_key').value = GetPrivateKey();
    document.getElementById('pp_wallet').value = GetWallet();
    qrcode.makeCode(document.getElementById('pp_key').value.toString());
}
function copyToClipboardKey() {
 var text = GetPrivateKey();
 var elem = document.createElement("textarea");
 document.body.appendChild(elem);
 elem.value = text;
 elem.select();
 document.execCommand("copy");
 document.body.removeChild(elem);
}
function copyToClipboardWallet() {
 var text = GetWallet();
 var elem = document.createElement("textarea");
 document.body.appendChild(elem);
 elem.value = text;
 elem.select();
 document.execCommand("copy");
 document.body.removeChild(elem);
}
</script>