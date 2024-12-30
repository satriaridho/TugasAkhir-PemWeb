<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Meja</h1>
</div>

<div class="card">
<div class="card-body">
    <form action="../kontrol/kontrolMeja.php?aksi=tambah" method="post">
    <table class="table">
        <input required type="text" name="no_meja" class="form-control mb-2" placeholder="Masukan No Meja">
        <select name="status" class="form-control mb-2">
            <option value="ready">Ready</option>
            <option value="cleaning">Cleaning</option>
            <option value="user">Used</option>
        </select>
    </table>
    <button class="btn btn-primary w-100">Tambah</button>
    </form>
</div>
</div>