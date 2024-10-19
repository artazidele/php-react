import { React, useState } from "react";
import axios from 'axios';
import { Link } from "react-router-dom";

export function ProductAdd() {

    const [disabledBtn, setDisabledBtn] = useState(false);
    // const [requiredDataError, setRequiredDataError] = useState(true);
    const [uniqueSkuError, setUniqueSkuError] = useState(false);
    
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

        axios.post("http://localhost/php-react/server/addproduct.php", data)
        .then(response=>{
            if (response.data === "Success") {
                window.location = "http://localhost:3000/";
            } else {
                console.log(response.data);
                // set errors
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
                return;
            case 'furniture':
                setType("Furniture");
                setDiskDiv(false);
                setBookDiv(false);
                setFurnitureDiv(true);
                setSize("");
                setWeight("");
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
            <form onSubmit={submitForm}>
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
                    {/* {requiredDataError && <p className="error-p">Please, submit required data</p>} */}
                    <div className="all_type_inputs">
                        <div className="div_input">
                            <label>SKU</label>
                            <input type="text" value={sku} onChange={(e) => setSku(e.target.value)}/>
                        </div>
                        {uniqueSkuError && <p className="error-p">This SKU already exists</p>}
                        <div className="div_input">
                            <label>Name</label>
                            <input type="text" value={name} onChange={(e) => setName(e.target.value)}/>
                        </div>
                        <div className="div_input">
                            <label>Price ($)</label>
                            <input type="text" value={price} onChange={(e) => setPrice(e.target.value)}/>
                        </div>
                        <div className="div_input">
                            <label>Type Switcher</label>
                            <select name="type" onChange={changeLayout} id='productType'>
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
                                <input type="text" value={size} onChange={(e) => setSize(e.target.value)}/>
                            </div>
                        </div> }
                        { furnitureDiv && <div>
                            <p>Please, provide dimentions</p>
                            <div className="div_input">
                                <label>Height (CM)</label>
                                <input type="text" value={height} onChange={(e) => setHeight(e.target.value)}/>
                            </div>
                            <div className="div_input">
                                <label>Width (CM)</label>
                                <input type="text" value={width} onChange={(e) => setWidth(e.target.value)}/>
                            </div>
                            <div className="div_input">
                                <label>Length (CM)</label>
                                <input type="text" value={length} onChange={(e) => setLength(e.target.value)}/>
                            </div>
                        </div> }
                        { bookDiv && <div>
                            <p>Please, provide weight</p>
                            <div className="div_input">
                                <label>Weight (KG)</label>
                                <input type="text" value={weight} onChange={(e) => setWeight(e.target.value)}/>
                            </div>
                        </div> }
                    </div>
                </div>
            </form>
        </div>
    );
};