import React, { useState ,useCallback} from "react";
import axios from "axios";


const useAxios = (config = {}) => {
    const {
        onFinish = ({ axiosMode, status, values }) => { },
        onBefore = ({ axiosMode, status }) => { }
    } = config;

    const [data, setData] = useState([]);
    const [response, setResponse] = useState(null); // 新增一個狀態來保存 response

    const getData = useCallback((params) => {
        onBefore({ axiosMode: "get" }); // 在請求開始前調用 onBefore 回調
        return axios.get('/getData', { params: params }) // 發送 GET 請求到 '/getData'
            .then((response) => {
                console.log('Server response:', response); // 調試輸出完整回應
                
                let data = response.data;
                setResponse(response); // 保存 response 到狀態
                setData(data?.data);
                if (data) {
                    onFinish({ axiosMode: "get", status: "success" }); // 請求成功後調用 onFinish 回調
                } else {
                    onFinish({ axiosMode: "get", status: "error" }); // 請求失敗後調用 onFinish 回調
                }
                return { ...data };
            })
            .catch((error) => {
                console.error('Request error:', error);
                onFinish({ axiosMode: "get", status: "error" });
            });
    }, [onBefore, onFinish]); // 確保 useCallback 的依賴陣列不會變化


    const postData = (data) => {
        onBefore({
            axiosMode: "post"
        })
        axios.post('/postData',
            data
        )
            .then((response) => {
                let responseData = response.data
                let status = responseData?.status
                if (status === "fail") {
                    onFinish(
                        {
                            axiosMode: "post",
                            status: "error"
                        }
                    )
                }
                else {
                    onFinish(
                        {
                            axiosMode: "post",
                            status: "success"
                        }
                    )
                }
            })
            .catch(() => {
                onFinish(
                    {
                        axiosMode: "post",
                        status: "error"
                    }
                )
            })

    }
    const patchData = (data) => {
        onBefore({
            axiosMode: "patch"
        })
        axios.patch('/patchData',
                data
            
        )
            .then((response) => {
                let responseData = response.data
                let status = responseData?.status
                if (status === "fail") {
                    onFinish(
                        {
                            axiosMode: "patch",
                            status: "error"
                        }
                    )
                }
                else {
                    onFinish(
                        {
                            axiosMode: "patch",
                            status: "success"
                        }
                    )
                }
            })
            .catch(() => {
                onFinish(
                    {
                        axiosMode: "patch",
                        status: "error"
                    }
                )
            })
    }
    const deleteData = (data) => {
        onBefore({
            axiosMode: "delete"
        })
        axios.delete('/deleteData',
            {
                data
            }
        )
            .then((response) => {
                let responseData = response.data
                let status = responseData?.status
                if (status === "fail") {
                    onFinish(
                        {
                            axiosMode: "delete",
                            status: "error"
                        }
                    )
                }
                else {
                    onFinish(
                        {
                            axiosMode: "delete",
                            status: "success"
                        }
                    )
                }
            })
            .catch(() => {
                onFinish(
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
        deleteData,
        response
    }
}
export { useAxios }
