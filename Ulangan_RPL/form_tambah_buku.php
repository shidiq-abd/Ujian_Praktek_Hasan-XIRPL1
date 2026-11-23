<?php require_once 'navbar.php'?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Tambah Buku</title>

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-6 col-xl-5">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4">
                    <h2 class="h4 mb-0">Form Tambah Buku</h2>
                </div>

                <div class="card-body p-4">
                    <form action="proses_tambah_buku.php" method="POST">

                        <!-- Data Profil Buku -->
                        <h3 class="h5 mb-4">Data Profil Buku</h3>

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input
                                type="text"
                                name="judul"
                                id="judul"
                                class="form-control"
                                placeholder="Contoh: Setelah Hujan Datanglah Terang"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input
                                type="text"
                                name="penerbit"
                                id="penerbit"
                                class="form-control"
                                placeholder="Contoh: Ahmad Ibrahim S.Pd"
                                required
                            >
                        </div>

                            <div class="mb-3">
                                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                <input
                                    type="text"
                                    name="tahun_terbit"
                                    id="tahun_terbit"
                                    class="form-control"
                                    placeholder="Contoh: 02-01-2010"
                                >
                            </div>

                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input
                                    type="number"
                                    name="stok"
                                    id="stok"
                                    class="form-control"
                                    placeholder="Masukkan stok buku"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input
                                    type="text"
                                    name="deskripsi"
                                    id="deskripsi"
                                    class="form-control"
                                    placeholder="Masukkan deskripsi buku"
                                    required
                                >
                            </div>
                        <div class="d-flex gap-2">
                            <button type="submit" name="kirim" class="btn btn-primary">
                                Simpan Data
                            </button>
                            <a href="daftar_buku.php" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
