import React from 'react';

const ProductCard = ({ product }) => {
  return (
    <div className="bg-white rounded-lg shadow-md overflow-hidden">
      <img
        src={product.foto_url} // Asumsi API mengembalikan URL foto
        alt={product.nama}
        className="w-full h-48 object-cover"
      />
      <div className="p-4">
        <h3 className="text-lg font-semibold">{product.nama}</h3>
        <p className="text-gray-600 mt-1">Rp {product.harga}</p>
        <button className="mt-4 w-full bg-blue-500 text-white py-2 rounded-lg">
          Lihat Detail
        </button>
      </div>
    </div>
  );
};

export default ProductCard;