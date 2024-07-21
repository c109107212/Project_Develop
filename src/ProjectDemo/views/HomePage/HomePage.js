import React, { useContext, useEffect, useCallback, useState } from 'react';
import './HomePage.css';
import { MyContext } from '../../../Context/MyContext';
import { Modal, Form, Input, Button, Select } from 'antd';
import { useAxios } from '../../components/useAxios';

const { Option } = Select;

const HomePage = () => {
  const { getData, postData, axiosData } = useAxios();
  const [options, setOptions] = useState([]);
  const [Selectvalue, setSelectvalue] = useState('');
  const [Selectscene, setSelectscene] = useState('');
  const [isModalVisible, setIsModalVisible] = useState(false);
  
  const [Resetselect, setResetselect] = useState("目前已創建的帳號");

  const [form] = Form.useForm();

  const fetchData = useCallback(() => {
    const params = Selectvalue ? { user_account: Selectvalue } : {};
    getData(params);
  }, [getData, Selectvalue]);

  useEffect(() => {
    fetchData();
  }, [fetchData]);

  useEffect(() => {
    if (axiosData.length > 0) {
      const optionsElements = axiosData.map(account => (
        <Option key={account.id} value={account.user_account}>{account.user_name}</Option>
      ));
      setOptions(optionsElements);
    }
  }, [axiosData]);

  useEffect(() => {
    if (axiosData.length === 1) {
      const selectSceneContent = (
        <table className="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>User Account</th>
              <th>User Password</th>
              <th>Birthday</th>
            </tr>
          </thead>
          <tbody>
            {axiosData.map(account => (
              <tr key={account.id}>
                <td>{account.id}</td>
                <td>{account.user_name}</td>
                <td>{account.user_account}</td>
                <td>{account.user_password}</td>
                <td>{account.birth}</td>
              </tr>
            ))}
          </tbody>
        </table>
      );
      setSelectscene(selectSceneContent);
    } else {
      setSelectscene(null);
    }
  }, [axiosData]);

  const insert = () => {
    setIsModalVisible(true);
  };

  const checkinput = () => {
    form.validateFields()
      .then(values => {
        postData(values) // 提交新用戶數據
          .then(()=>{
            setIsModalVisible(false); // 隱藏模態框
            form.resetFields(); // 重置表單
            // alert("新增成功")
            alert(values)
          }
          )
          .catch(()=>{
            alert("新增失敗");
          })
        
      })

      .catch(info => {
        alert("新增失敗");
        console.log('Validate Failed:', info);
      });
  };

  const Inputcancel = () => {
    setIsModalVisible(false);
  };

  const Selectchose = (event) => {
    setSelectvalue(event);
    if (Selectvalue==="") {
      setResetselect("搜尋其他");
    } else {
      setResetselect("目前已創建的帳號");
    }
  };

  const user_account = axiosData.length > 0 ? axiosData[0].user_account : 'No data';

  return (
    <>
      <div>Data from server: {user_account}</div> {/* 顯示從伺服器獲取的數據 */}
      <div style={{ width: '100%', height: '100%', textAlign: 'center' }}>
        <div>
          <Select id="select" style={{ width: 200 }} onChange={Selectchose}>
            <Option value="">{Resetselect}</Option>
            {options}
          </Select>
        </div>
        <div>
          {Selectscene}
        </div>
        <div>
          <Button type="primary" onClick={insert}>新增帳號</Button>
        </div>
        <div id="insertanser"></div>
      </div>

      <Modal title="新增帳號" visible={isModalVisible} onOk={checkinput} onCancel={Inputcancel}>
        <Form form={form} layout="vertical" name="userForm">
          <Form.Item name="user_account" label="使用者帳號" rules={[{ required: true, message: '請輸入使用者帳號!' }]}>
            <Input />
          </Form.Item>
          <Form.Item name="user_name" label="使用者名稱" rules={[{ required: true, message: '請輸入使用者名稱!' }]}>
            <Input />
          </Form.Item>
          <Form.Item name="user_password" label="使用者密碼" rules={[{ required: true, message: '請輸入使用者密碼!' }]}>
            <Input />
          </Form.Item>
          <Form.Item name="birth" label="生日" rules={[{ required: true, message: '請輸入生日!' }]}>
            <Input type="date" />
          </Form.Item>
        </Form>
      </Modal>
    </>
  );
};

export default HomePage;
