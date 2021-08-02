import React from "react";
import {useContext} from "react";
import {AppContext} from "./Context";

const ProductList = () => {
    const {products, deleteProduct} = useContext(AppContext);

    const deleteConfirm = (id) => {
        if (window.confirm("Вы уверены, что хотите удалить данный продукт?")) Х
        deleteProduct(id);
    }

    return (
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>ID подкатегории</th>
                <th>Имя</th>
                <th>Цена</th>
                <th>Описание</th>
                <th>ID продавца</th>
                <th>Картинка</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            {products.map((product) => {
                return (
                    <tr key={product.id}>
                        <td>{product.id}</td>
                        <td>{product.subcategory_id}</td>
                        <td>{product.name}</td>
                        <td>{product.price}</td>
                        <td>{product.description}</td>
                        <td>{product.seller_id}</td>
                        <td>{product.image_name}</td>
                        <td>
                            <button
                                className="btn red-btn"
                                onClick={() => deleteConfirm(product.id)}>
                                Удалить
                            </button>
                        </td>
                    </tr>
                )
            })}
            </tbody>
        </table>
    );
}

export default ProductList;