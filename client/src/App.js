import './App.css';
import React from "react";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import { ProductList } from './components/ProductList';
import { ProductAdd } from './components/ProductAdd';
import { Footer } from './components/Footer';

function App() {
  return (
    <div className='app_div'>
      <div className='components_div'>
        <BrowserRouter>
          <Routes>
            <Route path="/" element={<ProductList />}/>
            <Route path="/add-product" element={<ProductAdd />}/>
            <Route path="*" element={<Navigate to="/"/>} />
          </Routes>
        </BrowserRouter>
      </div>
      <Footer/>
    </div>
  );
};

export default App;