import React, { useState ,useCallback} from "react";
import axios from "axios";


const useAxios = (config = {}) => {
    

    const [data, setData] = useState([]);

    const getData = useCallback((params) => {
   
        return axios.get('/getData', { params: params }) // 發送 GET 請求到 '/getData'
            .then((response) => {
                console.log('Server response:', response); // 調試輸出完整回應
                let data = response.data;
                setData(data?.data);
                
                return { ...data };
            })
            .catch((error) => {
                console.error('Error posting data:', error);
                throw error;  
              
            });
    }, []); // 確保 useCallback 的依賴陣列不會變化


    const postData = (data) => {
        
        axios.post('/postData',
            data
        )
            .then((response) => {
                let responseData = response.data
                let status = responseData?.status
                
            })
            .catch(() => {
                console.log(
                    {
                        axiosMode: "post",
                        status: "error"
                    }
                )
            })

    }
    const patchData = (data) => {
        
        axios.patch('/patchData',
                data
            
        )
            .then((response) => {
                let responseData = response.data
                let status = responseData?.status
                
                
            })
            .catch(() => {
                console.log(
                    {
                        axiosMode: "patch",
                        status: "error"
                    }
                )
            })
    }
    const deleteData = (data) => {
        
        axios.delete('/deleteData',
            {
                data
            }
        )
            .then((response) => {
                let responseData = response.data
                let status = responseData?.status
                if (status === "fail") {
                      console.log(
                        {
                            axiosMode: "delete",
                            status: "error"
                        }
                    )
                }
                else {
                      console.log(
                        {
                            axiosMode: "delete",
                            status: "success"
                        }
                    )
                }
            })
            .catch(() => {
                  console.log(
                    {
                        axiosMode: "delete",
                        status: "error"
                    }
                )
            })
    }
    
    return {
        axiosData: data,
        getData,
        postData,
        patchData,
        deleteData
    }
}
export { useAxios }
