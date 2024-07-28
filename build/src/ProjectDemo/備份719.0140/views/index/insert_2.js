
export default function insert_2(){
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