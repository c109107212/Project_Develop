import insert_2 from "./insert_2.js";
export default function insert(){
 
    const insertscene = `
    <div>
        使用者帳號: <input type="text" id="account"><br>
        <div id="account_word" style="color: red;font-size: 12px;"></div>
        使用者名稱: <input type="text" id="name"><br>
        使用者密碼: <input type="text" id="password"><br>
        生日: <input type="date" id="birthday">
        
    </div>
    <div>
        <button id="checkinsert">確認新增</button>
    </div>
    `
    
    document.getElementById("insertscene").innerHTML = insertscene;
    document.getElementById('account').addEventListener('input', function() {
            const accountValue = document.getElementById('account').value;
            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{5,}$/;
            if (!regex.test(accountValue)) {
                document.getElementById('account').style.border = '2px solid red';
                document.getElementById('account_word').innerHTML= '帳號必須包含大小寫字母和數字，且至少有5個字符';
            } else {
                document.getElementById('account').style.border = '1px solid #ccc';
                document.getElementById('account_word').innerHTML= ""
            }
        });
    document.getElementById("checkinsert").onclick = function() {
        insert_2();
    }
}