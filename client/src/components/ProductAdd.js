import { React, useState } from "react";
import axios from 'axios';
import { Link } from "react-router-dom";

export function ProductAdd() {

    const [disabledBtn, setDisabledBtn] = useState(false);

    const [uniqueSkuError, setUniqueSkuError] = useState(false);
    const [skuSizeError, setSkuSizeError] = useState(false);

    const [priceTypeError, setPriceTypeError] = useState(false);
    const [weightTypeError, setWeightTypeError] = useState(false);
    const [sizeTypeError, setSizeTypeError] = useState(false);
    const [heightTypeError, setHeightTypeError] = useState(false);
    const [widthTypeError, setWidthTypeError] = useState(false);
    const [lengthTypeError, setLengthTypeError] = useState(false);

    const [emptySku, setEmptySku] = useState(false);
    const [emptyName, setEmptyName] = useState(false);
    const [emptyPrice, setEmptyPrice] = useState(false);
    const [emptySize, setEmptySize] = useState(false);
    const [emptyHeight, setEmptyHeight] = useState(false);
    const [emptyWidth, setEmptyWidth] = useState(false);
    const [emptyLength, setEmptyLength] = useState(false);
    const [emptyWeight, setEmptyWeight] = useState(false);

    const [weightDecimal, setWeightDecimal] = useState(false);
    const [priceDecimal, setPriceDecimal] = useState(false);
    
    const [diskDiv, setDiskDiv] = useState(true);
    const [furnitureDiv, setFurnitureDiv] = useState(false);
    const [bookDiv, setBookDiv] = useState(false);

    const [sku, setSku] = useState("");
    const [name, setName] = useState("");
    const [price, setPrice] = useState("");
    const [size, setSize] = useState("");
    const [height, setHeight] = useState("");
    const [width, setWidth] = useState("");
    const [length, setLength] = useState("");
    const [weight, setWeight] = useState("");
    const [type, setType] = useState("Disk");

    const submitForm = (e) => {
        e.preventDefault();
        setDisabledBtn(true);
        // clear errors
        // sku errors
        setUniqueSkuError(false);
        setSkuSizeError(false);
        // type errors
        setPriceTypeError(false);
        setWeightTypeError(false);
        setSizeTypeError(false);
        setHeightTypeError(false);
        setWidthTypeError(false);
        setLengthTypeError(false);
        // empty field errors
        setEmptySku(false);
        setEmptyName(false);
        setEmptyHeight(false);
        setEmptyLength(false);
        setEmptyPrice(false);
        setEmptySize(false);
        setEmptyWeight(false);
        setEmptyWidth(false);
        // empty decimal errors
        setPriceDecimal(false);
        setWeightDecimal(false);

        let data = new FormData();
        data.append('sku', sku);
        data.append('name', name);
        data.append('price', price);
        data.append('size', size);
        data.append('weight', weight);
        data.append('height', height);
        data.append('length', length);
        data.append('width', width);
        data.append('type', type);

        // axios.post("http://localhost/php-react/server/addproduct.php", data)
        axios.post("./server/addproduct.php", data)
        .then(response=>{
            if (response.data === "Success") {
                // window.location = "http://localhost:3000/";
                window.location = "https://php-react.online/";
            } else {
                // set errors
                if (response.data === "priceTypeError") {
                    setPriceTypeError(true);
                }
                if (response.data === "weightTypeError") {
                    setWeightTypeError(true);
                }
                if (response.data === "sizeTypeError") {
                    setSizeTypeError(true);
                }
                if (response.data === "heightTypeError") {
                    setHeightTypeError(true);
                }
                if (response.data === "lengthTypeError") {
                    setLengthTypeError(true);
                }
                if (response.data === "widthTypeError") {
                    setWidthTypeError(true);
                }
                if (response.data === "emptySku") {
                    setEmptySku(true);
                }
                if (response.data === "emptyName") {
                    setEmptyName(true);
                }
                if (response.data === "emptyPrice") {
                    setEmptyPrice(true);
                }
                if (response.data === "emptySize") {
                    setEmptySize(true);
                }
                if (response.data == "emptyHeight") {
                    setEmptyHeight(true);
                }
                if (response.data === "emptyWidth") {
                    setEmptyWidth(true);
                }
                if (response.data === "emptyLength") {
                    setEmptyLength(true);
                }
                if (response.data === "emptyWeight") {
                    setEmptyWeight(true);
                }
                if (response.data === "uniqueSkuError") {
                    setUniqueSkuError(true);
                }
                if (response.data === "skuSizeError") {
                    setSkuSizeError(true);
                }
                if (response.data === "priceDecimal") {
                    setPriceDecimal(true);
                }
                if (response.data === "weightDecimal") {
                    setWeightDecimal(true);
                }
                setDisabledBtn(false);
            }
        });
    }

    const changeLayout = (e) => {
        e.preventDefault();
        switch(e.target.value) {
            case 'disk':
                setType("Disk");
                setBookDiv(false);
                setFurnitureDiv(false);
                setDiskDiv(true);
                setHeight("");
                setWidth("");
                setLength("");
                setWeight("");
                setEmptyHeight(false);
                setEmptyLength(false);
                setEmptyWeight(false);
                setEmptyWidth(false);
                setWeightDecimal(false);
                return;
            case 'furniture':
                setType("Furniture");
                setDiskDiv(false);
                setBookDiv(false);
                setFurnitureDiv(true);
                setSize("");
                setWeight("");
                setEmptySize(false);
                setEmptyWeight(false);
                setWeightDecimal(false);
                return;
            case 'book':
                setType("Book");
                setDiskDiv(false);
                setFurnitureDiv(false);
                setBookDiv(true);
                setSize("");
                setWidth("");
                setLength("");
                setWeight("");
                setEmptyHeight(false);
                setEmptyLength(false);
                setEmptySize(false);
                setEmptyWidth(false);
                return;
            default:
                setType("Disk");
                setFurnitureDiv(false);
                setBookDiv(false);
                setDiskDiv(true);
                return;
        }
    }

    return (
        <div>
            <form id="#product_form" onSubmit={submitForm}>
                <div className="header-div">
                    <div className="header">
                        <h3>Product Add</h3>
                        <div className="form-btns">
                            {!disabledBtn && <button className="btn" type='submit'>Save</button>}
                            {disabledBtn && <button className="btn btn-disabled" disabled>Save</button>}
                            {!disabledBtn && <Link to={'/'}><button className="btn">Cancel</button></Link>}
                            {disabledBtn && <button className="btn btn-disabled" disabled>Cancel</button>}
                        </div>
                    </div>
                </div>
                <div className="page-div">
                    <div className="all_type_inputs">
                        <div className="div_input">
                            <label>SKU</label>
                            <input id="#sku" type="text" value={sku} onChange={(e) => setSku(e.target.value)}/>
                        </div>
                        {uniqueSkuError && <p className="error-p">This SKU already exists</p>}
                        {emptySku && <p className="error-p">SKU is required</p>}
                        {skuSizeError && <p className="error-p">Max SKU size is 12 characters</p>}
                        <div className="div_input">
                            <label>Name</label>
                            <input id="#name" type="text" value={name} onChange={(e) => setName(e.target.value)}/>
                        </div>
                        {emptyName && <p className="error-p">Name is required</p>}
                        <div className="div_input">
                            <label>Price ($)</label>
                            <input id="#price" type="text" value={price} onChange={(e) => setPrice(e.target.value)}/>
                        </div>
                        {emptyPrice && <p className="error-p">Price is required</p>}
                        {priceTypeError && <p className="error-p">Price should be a number</p>}
                        {priceDecimal && <p className="error-p">Price should be a number with 0, 1 or 2 decimal digits.</p>}
                        <div className="div_input">
                            <label>Type Switcher</label>
                            <select id="#productType" name="type" onChange={changeLayout}>
                                <option value="disk">DVD</option>
                                <option value="book">Book</option>
                                <option value="furniture">Furniture</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        { diskDiv && <div>
                            <p>Please, provide size</p>
                            <div className="div_input">
                                <label>Size (MB)</label>
                                <input id="#size" type="text" value={size} onChange={(e) => setSize(e.target.value)}/>
                            </div>
                            {sizeTypeError && <p className="error-p">Size should be an integer</p>}
                            {emptySize && <p className="error-p">Size is required</p>}
                        </div> }
                        { furnitureDiv && <div>
                            <p>Please, provide dimentions</p>
                            <div className="div_input">
                                <label>Height (CM)</label>
                                <input id="#height" type="text" value={height} onChange={(e) => setHeight(e.target.value)}/>
                            </div>
                            {heightTypeError && <p className="error-p">Height should be an integer</p>}
                            {emptyHeight && <p className="error-p">Height is required</p>}
                            <div className="div_input">
                                <label>Width (CM)</label>
                                <input id="#width" type="text" value={width} onChange={(e) => setWidth(e.target.value)}/>
                            </div>
                            {widthTypeError && <p className="error-p">Width should be an integer</p>}
                            {emptyWidth && <p className="error-p">Width is required</p>}
                            <div className="div_input">
                                <label>Length (CM)</label>
                                <input id="#length" type="text" value={length} onChange={(e) => setLength(e.target.value)}/>
                            </div>
                            {lengthTypeError && <p className="error-p">Length should be an integer</p>}
                            {emptyLength && <p className="error-p">Length is required</p>}
                        </div> }
                        { bookDiv && <div>
                            <p>Please, provide weight</p>
                            <div className="div_input">
                                <label>Weight (KG)</label>
                                <input id="#weight" type="text" value={weight} onChange={(e) => setWeight(e.target.value)}/>
                            </div>
                            {weightTypeError && <p className="error-p">Weight should be a number</p>}
                            {weightDecimal && <p className="error-p">Weight should be a number with 0, 1, 2 or 3 decimal digits.</p>}
                            {emptyWeight && <p className="error-p">Weight is required</p>}
                        </div> }
                    </div>
                </div>
            </form>
        </div>
    );
};