import React from "react";
import ProductList from "./ProductList";
import {Actions} from "./Actions";
import {Provider} from "./Context";

function App() {
    const data = Actions();
    return (
        <Provider value={data}>
            <div className="App">
                <ProductList/>
            </div>
        </Provider>
    );
}

export default App;
