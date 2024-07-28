import React, { useContext, useEffect,useCallback,useState  } from 'react';  
import './HomePage.css'
import { MyContext } from '../../../Context/MyContext';  // 导入 MyContext

import { useAxios } from '../../components/useAxios';

const HomePage = () => {
  const { user, language } = useContext(MyContext); // 從上下文中獲取用戶和語言信息
  // const [response_data, setResponse] = useState(null);
  const { getData, axiosData, response } = useAxios();

  // 使用 useCallback 來包裝 getData 方法，確保依賴不會變化
  const fetchData = useCallback(() => {
    const params = { user_account: '109108212' }; // 設置要傳遞的參數
    getData(params);  // 傳遞參數到 getData
  }, [getData]); // 確保 useCallback 的依賴陣列不會變化

  // 使用 useEffect 在組件掛載時發送 GET 請求
  useEffect(() => {
    fetchData();  // 呼叫 fetchData 方法
  }, [fetchData]); // 確保 useEffect 的依賴陣列不會變化

  console.log('Data from server:', axiosData); // 調試輸出獲取到的數據
  console.log('Full response from server:', response); // 調試輸出獲取到的 response
  // useEffect(() => {
  //   if (response) {
  //     setResponse(JSON.stringify(response));
  //   }
  // }, [response]); // 當 response 更新時更新狀態
  return (
    <>
      <h1>HomePage</h1>
      <h1>使用者 {user}</h1>
      <h1>語言 {language}</h1>
      <div>Data from server: {JSON.stringify(axiosData)}</div> {/* 顯示從伺服器獲取的數據 */}
      <div>Full response: {JSON.stringify(response).data}</div> {/* 顯示完整的 response */}
    </>
  );
};

export default HomePage;
