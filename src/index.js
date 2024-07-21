import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import reportWebVitals from './reportWebVitals';
import MainRoute from './ProjectDemo/MainRoute'
import { MyProvider } from './Context/MyContext';  
import axios from 'axios';
axios.defaults.baseURL = "";
axios.defaults.baseURL = 'http://localhost'
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <MyProvider>
      <MainRoute />
    </MyProvider>
  </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
