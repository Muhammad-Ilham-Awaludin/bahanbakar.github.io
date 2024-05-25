<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Bahan Bakar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            box-shadow:0 0 10px rgba(0,0,0,0.1);
            width: 500px;
            border-radius: 6px;
            margin-top: 10px;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
    <div style="text-align:center;">
    <h1>Bahan Bakar</h1>
    </div>
    <form method="POST">
        <table align="center">
        <tr>
        <td><label for="formGroupExampleInput" class="form-label">Masukkan Jumlah Liter :</label></td>
        <td><input class="form-control" type="number" id="jumlah" name="jumlah" required></td>
        </tr>
        <tr>
        <td><label for="jenis">Pilih Tipe Bahan Bakar :</label></td>
        <td><select class="form-select" id="jenis" name="jenis">
            <option value="Shell Super">Shell Super</option>
            <option value="Shell V-Power">Shell V-Power</option>
            <option value="Shell V-Power Diesel">Shell V-Power Diesel</option>
            <option value="Shell V-Power Nitro">Shell V-Power Nitro</option>
        </select></td>
        </tr>
        <tr>
        <td><button class="btn btn-primary" type="submit">Beli</button></td>
        </tr>
        </table>
    </form>
    </div>
</body>
</html>

<?php
class Shell {
    private $harga;
    public $jumlah;
    public $jenis;
    public $ppn;

    public function __construct($jenis, $jumlah) {
        $this->jenis = $jenis;
        $this->jumlah = $jumlah;
        $this->ppn = 0.1;
        $this->setHarga();
    }

    public function setHarga() {
        switch ($this->jenis) {
            case 'Shell Super':
                $this->harga = 15420;
                break;
            case 'Shell V-Power':
                $this->harga = 16130;
                break;
            case 'Shell V-Power Diesel':
                $this->harga = 18310;
                break;
            case 'Shell V-Power Nitro':
                $this->harga = 16510;
                break;
            default:
                $this->harga = 0;
                break;
        }
    }

    public function getHarga() {
        return $this->harga;
    }

    public function getJumlah() {
        return $this->jumlah;
    }

    public function getJenis() {
        return $this->jenis;
    }

    public function getPpn() {
        return $this->ppn;
    }
}

class Beli extends Shell {
    public function totalBayar() {
        $hargaTotal = $this->getHarga() * $this->getJumlah();
        $totalDenganPpn = $hargaTotal + ($hargaTotal * $this->getPpn());
        return $totalDenganPpn;
    }

    public function tampilkanNota() {
        $total = $this->totalBayar();
        echo "--------------------------------------------------<br>";
        echo "Anda membeli bahan bakar minyak tipe " . $this->getJenis() . "<br>";
        echo "Dengan jumlah : " . $this->getJumlah() . " Liter<br>";
        echo "Total yang harus anda bayar Rp. " . number_format($total, 2, ',', '.') . "<br>";
        echo "--------------------------------------------------<br>";
    }
}

// Jika form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jumlah = $_POST['jumlah'];
    $jenis = $_POST['jenis'];

    // Membuat instance dari class Beli
    $transaksi = new Beli($jenis, $jumlah);

    // Tampilkan nota
    $transaksi->tampilkanNota();
}
?>