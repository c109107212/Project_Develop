import { Outlet, Link } from 'react-router-dom';
import { Layout } from 'antd';

const { Header, Content, Footer } = Layout;

const MainLayout = () => {
    return (
        <Layout>
            <Header>
                {/* 可以在这里放置导航链接 */}
                <Link to="/">Home</Link>
                <Link to="/e-learning">E-Learning</Link>
            </Header>
            <Content>
                <Outlet /> 
            </Content>
            <Footer>Footer content here</Footer>
        </Layout>
    );
};

export default MainLayout;
