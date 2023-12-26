function SetPrivateKey(value){
    localStorage.setItem("privateKey", value);
}
function SetWallet(value){
    localStorage.setItem("wallet", value);
}
function GetPrivateKey(){
    return localStorage.getItem("privateKey");
}
function GetWallet(){
    return localStorage.getItem("wallet");
}
function RemoveAllData(){
    localStorage.clear();
}