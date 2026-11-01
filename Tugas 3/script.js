/* SOAL 6: Pengolahan Array Produk */
console.log("=== SOAL 6 ===");

const produk = [
  { nama: 'Pensil', harga: 2000, stok: 10 },
  { nama: 'Buku', harga: 8000, stok: 0 },
  { nama: 'Penghapus', harga: 1500, stok: 5 },
];

// a) Menampilkan array berisi nama produk yang stoknya lebih dari 0
const produkTersedia = produk
  .filter(p => p.stok > 0)
  .map(p => p.nama);
console.log("a) Produk stok > 0:", produkTersedia);

// b) Mencari produk yang bernama 'Penghapus'
const cariPenghapus = produk.find(p => p.nama === 'Penghapus');
console.log("b) Hasil pencarian Penghapus:", cariPenghapus);

// c) Mencetak setiap produk dengan format Pensil - Rp2000
console.log("c) Cetak Daftar Produk:");
produk.forEach(p => console.log(`${p.nama} - Rp${p.harga}`));


/* SOAL 7: Asynchronous, Promise, & Async/Await */
console.log("\n=== SOAL 7 ===");

// a) Function tunggu(ms) yang mengembalikan Promise
const tunggu = (ms) => new Promise(resolve => setTimeout(resolve, ms));

// b) Async function jalankanProses()
async function jalankanProses() {
  console.log("Mulai");
  await tunggu(1000);
  console.log("Langkah 1");
  await tunggu(1000);
  console.log("Selesai");
}

// c) Bonus: Function cekStok(jumlah) dengan Promise
const cekStok = (jumlah) => new Promise((resolve, reject) => {
  if (jumlah > 0) {
    resolve(`Stok tersedia: ${jumlah}`);
  } else {
    reject("Stok habis atau tidak valid");
  }
});

async function tesCekStok() {
  try {
    const res1 = await cekStok(5);
    console.log("Hasil Cek Stok (5):", res1);
    
    const res2 = await cekStok(0);
    console.log("Hasil Cek Stok (0):", res2);
  } catch (error) {
    console.log("Error Cek Stok:", error);
  }
}

// Menjalankan fungsi Soal 7
async function eksekusiSoal7() {
  await jalankanProses();
  await tesCekStok();
}
eksekusiSoal7();


/* SOAL 8: Sistem Transaksi Toko Buku */
const daftarBuku = [
  { judul: 'Laskar Pelangi', harga: 85000, stok: 5, kategori: 'Novel' },
  { judul: 'Filosofi Teras', harga: 98000, stok: 0, kategori: 'Self-Help' },
  { judul: 'Atomic Habits', harga: 120000, stok: 3, kategori: 'Self-Help' },
  { judul: 'Bumi Manusia', harga: 105000, stok: 2, kategori: 'Novel' },
];

// Jeda agar output tidak bertumpuk dengan delay Soal 7
setTimeout(() => {
  console.log("\n=== SOAL 8 ===");

  // a) Menyaring dan menampilkan judul buku yang stoknya > 0
  const bukuTersedia = daftarBuku
    .filter(buku => buku.stok > 0)
    .map(buku => buku.judul);
  console.log("a) Judul buku tersedia:", bukuTersedia);

  // b) Menghitung total harga keseluruhan buku (reduce)
  const totalHarga = daftarBuku.reduce((acc, buku) => acc + buku.harga, 0);
  console.log("b) Total harga keseluruhan buku: Rp" + totalHarga);

  // c) Format dan cetak daftar buku
  console.log("c) Daftar Buku Toko:");
  daftarBuku.forEach(buku => {
    console.log(`${buku.judul} - Rp${buku.harga} (Stok: ${buku.stok})`);
  });

  // d & e) Fungsi prosesPembayaran(judulBuku) mengembalikan Promise
  const prosesPembayaran = (judulBuku) => {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        const buku = daftarBuku.find(
          b => b.judul.toLowerCase() === judulBuku.toLowerCase()
        );

        if (buku && buku.stok > 0) {
          resolve(`Pembayaran berhasil untuk buku: ${buku.judul}`);
        } else {
          reject("Gagal: Buku tidak tersedia atau stok habis!");
        }
      }, 1500);
    });
  };

  // f) Async function transaksiToko()
  async function transaksiToko() {
    console.log("\n--- Memulai Transaksi Toko ---");

    // Pengujian kondisi berhasil
    try {
      const resBerhasil = await prosesPembayaran('Atomic Habits');
      console.log("Transaksi 1 (Atomic Habits):", resBerhasil);
    } catch (error) {
      console.log("Transaksi 1 Error:", error);
    }

    // Pengujian kondisi gagal (stok 0)
    try {
      const resGagal = await prosesPembayaran('Filosofi Teras');
      console.log("Transaksi 2 (Filosofi Teras):", resGagal);
    } catch (error) {
      console.log("Transaksi 2 Error:", error);
    }
  }

  transaksiToko();
}, 2500);