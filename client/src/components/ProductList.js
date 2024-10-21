import { React, useState, useEffect } from "react";
import axios from 'axios';
import { Link } from "react-router-dom";
import ProductListItem from './ProductListItem';

export function ProductList() {
    const [products, setProducts] = useState(null);
    const [checkedProducts, setCheckedProducts] = useState([]);

    const [disabledBtn, setDisabledBtn] = useState(false);

    useEffect(() => {
        getProducts();
    }, []);

    const getProducts = () => {
        setProducts(null);

        // axios.get("http://localhost/php-react/server/getproducts.php")
        axios.get("./server/getproducts.php")
        .then((res) => {
            setProducts(res.data);
        });
    }

    const addCheckedProduct = (id) => {
        const previousProducts = checkedProducts;
        previousProducts.push(id);
        setCheckedProducts(previousProducts);
    }

    const removeCheckedProduct = (id) => {
        const previousProducts = checkedProducts.filter(it => it !== id);
        setCheckedProducts(previousProducts);
    }

    const deleteCheckedProducts = (e) => {
        e.preventDefault();
        setDisabledBtn(true);

        checkedProducts.map(id => {
            let data = new FormData();
            data.append('id', id);
            // axios.post("http://localhost/php-react/server/deleteproduct.php", data)
            axios.post("./server/deleteproduct.php", data)
            .then(res => {
                if(res.data === "Success") {
                    removeCheckedProduct(id);
                    getProducts();
                }
            });
        });
        setDisabledBtn(false);
    }
            

    return (
        <div>
            <form onSubmit={deleteCheckedProducts}>
                <div className="header-div">
                    <div className="header">
                        <h3>Product List</h3>
                        <div className="form-btns">
                            {!disabledBtn && <Link to={'/add-product'}><button className="btn">ADD</button></Link>}
                            {disabledBtn && <button className="btn btn-disabled" disabled>ADD</button>}
                            {!disabledBtn && <button className="btn" type='submit'>MASS DELETE</button>}
                            {disabledBtn && <button className="btn btn-disabled" disabled>MASS DELETE</button>}
                        </div>
                    </div>
                </div>
                <div className="page-div">
                    {products && <div className="products-grid">{products.map((product) => (
                        <div className="product-item" key={ product.id }>
                            <ProductListItem product={product} check={addCheckedProduct} uncheck={removeCheckedProduct} />
                        </div>
                    ))}</div>}
                </div>
            </form>
        </div>
    );
};