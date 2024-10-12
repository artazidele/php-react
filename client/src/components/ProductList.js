import { React, useState, useEffect } from "react";
import axios from 'axios';
import { Link } from "react-router-dom";
import ProductListItem from './ProductListItem';

export function ProductList() {
    const [products, setProducts] = useState(null);
    const [checkedProducts, setCheckedProducts] = useState([]);

    useEffect(() => {
        getProducts();
    }, []);

    const getProducts = () => {
        setProducts(null);

        axios.get("http://localhost/php-react/server/getproducts.php")
        .then((res) => {
            console.log(res.data);
            setProducts(res.data);
        });
    }

    const deleteCheckedProducts = (e) => {

    }

    return (
        <div>
            <form onSubmit={deleteCheckedProducts}>
                <div className=''>
                    <div className=''>Product List</div>
                    <div className=''>
                        <Link to={'/add-product'}><button>ADD</button></Link>
                        <button type="submit">MASS DELETE</button>
                    </div>
                </div>
                <div className=''>
                    {/* {products && <p>Products</p>} */}
                    <div className=''>
                        {products && <div className="product-container">{products.map((product) => (
                            <div className="" key={ product.id }>
                                <p>{product.name}</p>
                                {/* <ProductListItem /> */}
                                {/* <ProductListItem addDeleteId={addDeleteId} removeDeleteId={removeDeleteId} deleteId={deleteId} product={ product }/> */}
                            </div>
                        ))}</div>}
                    </div>
                </div>
            </form>
        </div>
    );
};