import React, { createContext, useState } from 'react';

export const MyContext = createContext();
export const MyProvider = ({ children }) => {
    const [user, setUser] = useState("zhou yousheng");
    const [language, setLanguage] = useState('zh-tw');
    return (
        <MyContext.Provider
            value={{
                user, setUser,
                language, setLanguage
            }}>
            {children}
        </MyContext.Provider>
    );
};
