
export default async  function startPage(str){
 
    let startPage=`
    <div style="width: 100%;height: 100%;text-align: center;">
        <div>
            <select id="select">
                <option>目前已創建的帳號</option>`;
            

    
    startPage += str;
    startPage+=`</select>
        </div>
        <div id='selectscene'></div>
        <div>
            <button id="insert">新增帳號</button>
            <div id='insertscene'></div>
        </div>
    </div>
    `
    console.log(startPage);
    return startPage;
}