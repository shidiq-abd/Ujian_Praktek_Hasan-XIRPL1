
<?php require_once 'navbar.php' ?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Tambah Pengguna</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7 col-xl-6">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4">
                    <h1 class="h4 mb-1">Form Tambah Pengguna</h1>
                    <p class="text-secondary mb-0">Buat akun admin atau anggota melalui satu form.</p>
                </div>

                <div class="card-body p-4">
                    <form action="proses_tambah_user.php" method="POST">
                        <input type="hidden" name="aksi" value="insert">

                        <div class="border rounded-3 bg-light p-3 p-md-4 mb-4">
                            <h2 class="h5 mb-1">Data Akun</h2>
                            <p class="text-secondary small mb-4">email dan password wajib untuk semua role.</p>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email"
                                    class="form-control" placeholder="Masukkan email"
                                    autocomplete="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="pass" class="form-label">Password</label>
                                <input type="password" name="pass" id="pass"
                                    class="form-control" placeholder="Masukkan password"
                                    autocomplete="new-password" required>
                            </div>

                             <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control input-anggota"
                                    placeholder="Masukkan nama">
                            </div>

                            <div>
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="admin" selected>Admin</option>
                                    <option value="anggota">Anggota</option>
                                </select>
                            </div>
                        </div>

                        <div id="keteranganAdmin" class="alert alert-dark mb-4">
                            Role <strong>Admin</strong> hanya membutuhkan email dan password.
                        </div>

                        <div id="formAnggota" class="border rounded-3 p-3 p-md-4 mb-4 d-none">
                            <h2 class="h5 mb-1">Data Profil Anggota</h2>
                            <p class="text-secondary small mb-4">Bagian ini tampil karena role Anggota dipilih.</p>

                            <div class="mb-3">
                                <label for="kelas" class="form-label">kelas</label>
                                <input type="text" name="kelas" id="kelas"
                                    class="form-control input-anggota"
                                    placeholder="Masukkan kelas">
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" name="kirim" class="btn btn-primary">
                                Simpan Data
                            </button>
                            <a href="daftar_user.php" class="btn btn-secondary">
                                Kembali
                            </a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const pilihanRole = document.getElementById('role');
    const keteranganAdmin = document.getElementById('keteranganAdmin');
    const formAnggota = document.getElementById('formAnggota');
    const inputAnggota = document.querySelectorAll('.input-anggota');

    function kosongkanInput(daftarInput) {
        daftarInput.forEach(function (input) {
            if (input.type === 'radio') {
                input.checked = false;
            } else {
                input.value = '';
            }

            input.required = false;
        });
    }

    function wajibkanInput(daftarInput) {
        daftarInput.forEach(function (input) {
            input.required = true;
        });
    }

    function tampilkanFormSesuaiRole() {
        const role = pilihanRole.value;

        keteranganAdmin.classList.toggle('d-none', role !== 'admin');
        formAnggota.classList.toggle('d-none', role !== 'anggota');

        if (role === 'anggota') {
            wajibkanInput(inputAnggota);
        } else {
            kosongkanInput(inputAnggota);
        }
    }

    pilihanRole.addEventListener('change', tampilkanFormSesuaiRole);
    tampilkanFormSesuaiRole();
</script>

</body>
</html>
