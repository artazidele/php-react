import { React, useState, useEffect } from "react";
import axios from 'axios';
import { Link } from "react-router-dom";
import ProductListItem from './ProductListItem';

export function ProductList() {
    const [products, setProducts] = useState(null);
    const [deleteProducts, setDeleteProducts] = useState([]);

    useEffect(() => {
        getProducts();
    }, []);

    const getProducts = () => {
        setProducts(null);

        fetch('./get_products.php')
            .then((res) => res.json())
            .then((data) => {
                setProducts(data);
            })
    }

    return (
        <div>
            <form>
                <div className=''>
                    <div className=''>Product List</div>
                    <div className=''>
                        <Link to={'/add-product'}><button>ADD</button></Link>
                        <button type="submit">MASS DELETE</button>
                    </div>
                </div>
                <div className=''>
                    {/* <div className=''>
                        {products && <div className="product-container">{products.map((product) => (
                            <div className="" key={ product.id }>
                                <ProductListItem addDeleteId={addDeleteId} removeDeleteId={removeDeleteId} deleteId={deleteId} product={ product }/>
                            </div>
                        ))}</div>}
                    </div> */}
                </div>
            </form>
        </div>
    );
};