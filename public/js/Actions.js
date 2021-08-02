import {useEffect, useState} from "react";

export const Actions = () => {
    let [products, setProducts] = useState([]);

    useEffect(() => {
        fetch("http://handmade/admin/all-products")
            .then(response => response.json())
            .then((data) => {
                if (data.success) {
                    setProducts(data.products);
                }
            })
            .catch((err) => {
                console.log(err);
            });
    }, []);

    const deleteProduct = (productId) => {
        let productDeleted = products.filter(product => product.id !== productId);
        fetch("http://handmade/delete-product", {
            method: "post",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({id : productId}),
        })
            .then((response)=>{
                return response.json();
            })
            .then((data)=>{
                if (data.success){
                    setProducts(productDeleted);
                } else {
                    alert(data.msg);
                }
            })
            .catch((err)=>{
                console.log(err);
            });
        return {
            products,
            deleteProduct,
        };
    }

    return (
        {products}
    )
}