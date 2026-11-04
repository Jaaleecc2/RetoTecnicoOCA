//Codigo inicial
function ListaClientes({ filtro }) {
    const [clientes, setClientes] = useState([]);

    useEffect(() => {
        axios.get(`/api/clientes?filtro=${filtro}`).then((res) => {
            setClientes(res.data);
        });
    }, []);

    return (
        <ul>
            {clientes.map((c) => (
                <li key={c.id}>{c.nombre}</li>
            ))}
        </ul>
    );
}
//Solucion propuesta 

import { useState, useEffect } from "react";
import axios from "axios";

function ListaClientes({ filtro }) {
    const [clientes, setClientes] = useState([]);

    useEffect(() => {
        axios
            .get(`/api/clientes?filtro=${encodeURIComponent(filtro)}`)
            .then((res) => {
                setClientes(res.data);
            });
    }, [filtro]);

    return (
        <ul>
            {clientes.map((c) => (
                <li key={c.id}>{c.nombre}</li>
            ))}
        </ul>
    );
}

export default ListaClientes;
