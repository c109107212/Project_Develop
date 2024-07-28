import startPage from "./stratPage.js";
window.onload = function() {
    axios.get("http://localhost/0715網頁練習/server/select.php")
    .then(async (res) => {
        let response = res['data'];
        let str = ``;
        const rows = response['result'];
        rows.forEach(element => {
            str += `<option>${element['user_account']}</option>`;
        });
        const htmlContent = await startPage(str);
        document.getElementById('content').innerHTML = htmlContent;
        document.getElementById("insert").onclick = function() {
            let data = {
                "account": document.getElementById("account").value,
                "name": document.getElementById("name").value,
                "password": document.getElementById("password").value,
                "birthday": document.getElementById("birthday").value
            };
            axios.post("http://localhost/0715網頁練習/server/insert.php",Qs.stringify(data))
                .then(res => {
                    let response=res['data']
                    console.log(response)
                    let str=response['message']
                    document.getElementById('insertscene').innerHTML=str;
                })
                .catch(err => {
                    document.getElementById('insertscene').innerHTML=err;
                })
                
        }
    })
    .catch(err => {
        console.error(err); 
    });
}
