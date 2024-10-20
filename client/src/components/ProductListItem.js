import React from 'react';

const ProductListItem = (props) => {

    const product = props.product;
    const price = (Math.round(product.price * 100) / 100).toFixed(2);

    const onCheck = (e) => {
        if (e.target.checked === true) {
            props.check(e.target.value);
        } else {
            props.uncheck(e.target.value);
        }
    }

    return (
        <div>
            {product && <div>
                <input className='' value={product.id} onChange={onCheck} type="checkbox"/>
                <div className='product-info'>
                    <p>{ product.sku }</p>
                    <p>{ product.name }</p>
                    <p>{ price } $</p>
                    { product.size && <p>Size: { product.size } MB</p> }
                    { product.weight && <p>Weight: { product.weight }KG</p> }
                    { product.height && <p>Dimension: { product.height }x{product.width}x{product.length}</p> }
                </div>
            </div>}
        </div>
    );
};

export default ProductListItem;