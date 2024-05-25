<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }

        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
            background-color: white;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #333;
            color: white;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: white;
            padding: 15px;
            border-radius: 5px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        a {
            color: #333;
            text-decoration: none;
            padding: 5px;
            background-color: #f4f4f4;
            border-radius: 3px;
            margin-right: 5px;
        }

        .edit-form {
            width: 50%;
            margin: 20px auto;
            background-color: white;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
    <title>Program PBO - Barang - Djalu Bintang Putra</title>
</head>

<body>

    <header>
        <h1>Manajemen Barang Alfamart</h1>
    </header>

    <?php

    class Barang
    {
        public $kodeProduk;
        public $namaProduk;
        public $kategoriProduk;
        public $harga;
        public $stok;
        public $keterangan;

        public function __construct($kodeProduk, $namaProduk, $kategoriProduk, $harga, $stok, $keterangan)
        {
            $this->kodeProduk = $kodeProduk;
            $this->namaProduk = $namaProduk;
            $this->kategoriProduk = $kategoriProduk;
            $this->harga = $harga;
            $this->stok = $stok;
            $this->keterangan = $keterangan;
        }
    }

    class KelolaBarang
    {
        private $barangList = [];

        public function __construct()
        {
            $this->loadBarangList();
        }

        private function loadBarangList()
        {
            $filename = 'barang_data.txt';

            if (file_exists($filename)) {
                $content = file_get_contents($filename);
                $this->barangList = unserialize($content);
            }
        }

        private function saveBarangList()
        {
            $filename = 'barang_data.txt';
            $content = serialize($this->barangList);
            file_put_contents($filename, $content);
        }

        public function tambahBarang(Barang $barang)
        {
            $this->barangList[] = $barang;

            $this->saveBarangList();
        }

        public function tampilkanBarang()
        {
            echo "<table>";
            echo "<tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>";

            foreach ($this->barangList as $index => $barang) {
                echo "<tr>
                    <td>{$barang->kodeProduk}</td>
                    <td>{$barang->namaProduk}</td>
                    <td>{$barang->kategoriProduk}</td>
                    <td>{$barang->harga}</td>
                    <td>{$barang->stok}</td>
                    <td>{$barang->keterangan}</td>
                    <td>
                        <a href='?action=edit&index=$index'>Edit</a> |
                        <a href='?action=delete&index=$index'>Hapus</a>
                    </td>
                  </tr>";
            }

            echo "</table>";
        }

        public function tambahBarangForm()
        {
            echo "<form method='post'>";
            echo "<h2>Tambah Barang</h2>";
            echo "Kode Barang: <input type='text' name='kodeProduk' required><br>";
            echo "Nama Barang: <input type='text' name='namaProduk' required><br>";
            echo "Kategori: <input type='text' name='kategoriProduk' required><br>";
            echo "Harga: <input type='number' name='harga' required><br>";
            echo "Stok: <input type='number' name='stok' required><br>";
            echo "Keterangan: <input type='text' name='keterangan'><br>";
            echo "<input type='submit' name='submit' value='Tambah'>";
            echo "</form>";
        }

        public function tambahBarangAction()
        {
            if (isset($_POST['submit'])) {
                $kodeProduk = $_POST['kodeProduk'];
                $namaProduk = $_POST['namaProduk'];
                $kategoriProduk = $_POST['kategoriProduk'];
                $harga = $_POST['harga'];
                $stok = $_POST['stok'];
                $keterangan = $_POST['keterangan'];

                $barang = new Barang($kodeProduk, $namaProduk, $kategoriProduk, $harga, $stok, $keterangan);
                $this->tambahBarang($barang);
            }
        }

        public function editBarangForm($index)
        {
            $barang = $this->barangList[$index];
            echo "<div class='edit-form'>";
            echo "<form method='post'>";
            echo "<h2>Edit Barang</h2>";
            echo "Kode Barang: <input type='text' name='kodeProduk' value='{$barang->kodeProduk}' required><br>";
            echo "Nama Barang: <input type='text' name='namaProduk' value='{$barang->namaProduk}' required><br>";
            echo "Kategori: <input type='text' name='kategoriProduk' value='{$barang->kategoriProduk}' required><br>";
            echo "Harga: <input type='number' name='harga' value='{$barang->harga}' required><br>";
            echo "Stok: <input type='number' name='stok' value='{$barang->stok}' required><br>";
            echo "Keterangan: <input type='text' name='keterangan' value='{$barang->keterangan}'><br>";
            echo "<input type='hidden' name='index' value='$index'>";
            echo "<input type='submit' name='update' value='Update'>";
            echo "</form>";
            echo "</div>";
        }

        public function editBarangAction($index)
        {
            if (isset($_POST['update'])) {
                $kodeProduk = $_POST['kodeProduk'];
                $namaProduk = $_POST['namaProduk'];
                $kategoriProduk = $_POST['kategoriProduk'];
                $harga = $_POST['harga'];
                $stok = $_POST['stok'];
                $keterangan = $_POST['keterangan'];

                $this->barangList[$index] = new Barang($kodeProduk, $namaProduk, $kategoriProduk, $harga, $stok, $keterangan);

                $this->saveBarangList();
            }
        }

        public function deleteBarangAction($index)
        {
            unset($this->barangList[$index]);
            $this->barangList = array_values($this->barangList);

            $this->saveBarangList();
        }
    }

    $kelolaBarang = new KelolaBarang();

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $index = isset($_GET['index']) ? $_GET['index'] : null;

        switch ($action) {
            case 'edit':
                $kelolaBarang->editBarangForm($index);
                break;
            case 'delete':
                $kelolaBarang->deleteBarangAction($index);
                break;
        }
    }

    if (isset($_POST['update'])) {
        $index = $_POST['index'];
        $kelolaBarang->editBarangAction($index);
    }

    $kelolaBarang->tambahBarangForm();
    $kelolaBarang->tambahBarangAction();

    $kelolaBarang->tampilkanBarang();

    ?>

</body>

</html>