
import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import axios from "axios";

// Thunk asíncrono para obtener los pagos de un cliente
export const fetchPagos = createAsyncThunk(
    "pagos/fetchPagos",
    async (clienteId, { rejectWithValue }) => {
        try {
            const response = await axios.get("/pagos", {
                params: { cliente_id: clienteId }
            });

            return response.data;
        } catch (error) {
            return rejectWithValue(
                error.response?.data?.message ||
                "Error al obtener los pagos"
            );
        }
    }
);

// Estado inicial
const initialState = {
    pagos: [],
    loading: false,
    error: null
};

// Slice para administrar los pagos
const pagosSlice = createSlice({
    name: "pagos",
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder
            // Estado de carga
            .addCase(fetchPagos.pending, (state) => {
                state.loading = true;
                state.error = null;
            })

            // Petición exitosa
            .addCase(fetchPagos.fulfilled, (state, action) => {
                state.loading = false;
                state.pagos = action.payload;
            })

            // Error en la petición
            .addCase(fetchPagos.rejected, (state, action) => {
                state.loading = false;
                state.error =
                    action.payload || action.error.message;
            });
    }
});

export default pagosSlice.reducer;
