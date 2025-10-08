import React, { useEffect, useState } from 'react';
import ProductCard from '../components/ProductCard'; // Impor komponen ProductCard
import axios from 'axios';

const HomePage = () => {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Fungsi untuk mengambil data produk dari API Laravel
    const fetchProducts = async () => {
      try {
        const response = await axios.get('/api/products'); // Endpoint API produk
        setProducts(response.data.data.slice(0, 8)); // Ambil 8 produk terbaru
      } catch (error) {
        console.error('Error fetching products:', error);
      } finally {
        setLoading(false);
      }
    };

    fetchProducts();
  }, []);

  if (loading) {
    return <div>Memuat produk...</div>;
  }

  return (
    <div className="container mx-auto px-4 py-8">
      {/* Bagian Hero Section */}
      <div className="text-center my-12">
        <h1 className="text-5xl font-bold">ReStyle</h1>
        <p className="text-xl text-gray-700 mt-4">
          Temukan gayamu, selamatkan bumi.
        </p>
        <button className="mt-6 px-6 py-3 bg-indigo-600 text-white font-semibold rounded-full">
          Mulai Belanja
        </button>
      </div>

      {/* Bagian Featured Products */}
      <h2 className="text-3xl font-semibold text-center mb-8">Produk Terbaru</h2>
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        {products.map((product) => (
          <ProductCard key={product.id} product={product} />
        ))}
      </div>
    </div>
  );
};

export default HomePage;