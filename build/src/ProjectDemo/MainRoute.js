import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import HomePage from './views/HomePage/HomePage';
import NotFound from './views/404';
import MainLayout from './views/MainLayout';

const MainRoute = () => {
    return (
        <>
            <Router>
                <Routes>
                    <Route path="/" element={<MainLayout />}>
                        <Route index element={<HomePage />} />
                        <Route path="HomePage" element={<HomePage />} />
                    </Route>
                    <Route path="*" element={<NotFound />} />
                </Routes>
            </Router>
        </>
    );
};

export default MainRoute;
