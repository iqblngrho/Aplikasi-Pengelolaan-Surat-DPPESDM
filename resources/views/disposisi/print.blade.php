<!DOCTYPE html>
<html lang="en">
<style>
    table,
    th,
    td {
        border: 1px solid black;
        font-size: 12px
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Disposisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    spacing: {
                        'a4-width': '150mm',
                        'a4-height': '210mm',
                    },
                },
            },
            variants: {},
            plugins: [],
        }
    </script>
</head>

<body class="bg-gray-300">
    <div class="font-calibri py-4 px-10 bg-white mx-auto" style="width: 150mm; height: 210mm;">
        <header class="flex">
            <div>
                <img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" class="w-14" alt="Logo">
            </div>
            <div class="text-center justify-center" style="margin-left: 20px">
                <h1 class="" style=" font-size: 13px">PEMERINTAH PROVINSI KALIMANTAN BARAT</h1>
                <h1 class="font-bold text-md" style="font-size: 14px">DINAS PERINDUSTRIAN, PERDAGANGAN, ENERGI</h1>
                <h1 class="font-bold text-md" style="font-size: 14px">DAN SUMBER DAYA MINERAL</h1>
                <h1 class="text-md" style="font-size: 10px">Jalan Letjen Sutoyo No.7 Telepon (0561) 736025 Fax (0561)
                    736389</h1>
                <h2 class="text-md" style="font-size: 9px">Email: disperindag-esdm@kalbarprov.go.id Website:
                    disperindagesdm.kalbarprov.go.id</h2>
                <h1 class="text-md" style="font-size: 10px">Pontianak</h1>
            </div>
        </header>

        <h2 class="text-right -mt-2 text-sm" style="font-size: 9px">Kode Pos 78121</h2>
        <div class="w-full bg-black h-1 mt-1"></div>
        <div class="w-full bg-black" style="margin-top: 1pt; height: 2px"></div>

        <main class="mt-1">
            <h1 class="text-center text-lg font-semibold" style="font-size: 14px">LEMBAR DISPOSISI</h1>
            <table class="text-left border-collapse border border-black w-full mt-3">
                <tr>
                    <td style="width: 25%;">Kode</td>
                    <td style="width: 25%;">:</td>

                    <td style="width: 25%;">Indeks</td>
                    <td style="width: 25%;">:</td>
                </tr>
                <tr>
                    <td style="height: 40px;">Perihal</td>
                    <td colspan="3">:</td>
                </tr>
                <tr>
                    <td>Tgl/Nomor</td>
                    <td colspan="3">:</td>
                </tr>
                <tr>
                    <td>Asal Surat</td>
                    <td colspan="3">:</td>
                </tr>
                <tr>
                    <td>Dari Unit Kerja</td>
                    <td colspan="3">:</td>
                </tr>
                <tr>
                    <td>Dikemukakan Kepada</td>
                    <td colspan="3">:</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-center">CATATAN</th>
                </tr>
                <tr>
                    <td style="height: 100px; vertical-align: top">Sekretaris</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <th colspan="4" class="text-center">DISPOSISI/NOTA</th>
                </tr>
                <tr>
                    <td style="height: 100px; vertical-align: top">Kepala Dinas</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td style="height: 100px; vertical-align: top">Sekretaris/Kepala Bidang</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td style="height: 100px; vertical-align: top">Kepala Sub Bagian/Kepala Seksi</td>
                    <td colspan="3"></td>
                </tr>

            </table>
        </main>
    </div>
</body>


</html>
