<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Portal Kelulusan | SMK Bina Cipta Palembang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="icon" href="{{ asset('assets/dist/img/logo.png') }}" type="image/png">

    <style>
        body {
            background: #f4f6f9;
        }
        .card-custom {
            border-radius: 15px;
            overflow: hidden;
        }
        .left-panel {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: white;
        }
    </style>
</head>
<body>
    {{--  --}}

<div class="container mt-5">
    <div class="card card-custom shadow">
        <div class="row g-0">

            <!-- LEFT -->
            <div class="col-lg-6 left-panel text-center p-5 d-flex flex-column justify-content-center">
                
                <div class="d-flex flex-column align-items-center">
                    <img src="{{ asset('assets/dist/img/logo.png') }}" alt="Logo SMK Bina Cipta" class="mb-4" style="width: 120px;">
                </div>

                <h1 class="fw-bold">PENGUMUMAN</h1>
                <h1 class="fw-bold">KELULUSAN</h1>
                <p>SMK Bina Cipta Palembang</p>
                <p>Tahun Ajaran 2025/2026</p>

                <h4 id="statusText" class="border p-3 mt-4 bg-primary text-white"></h4>
                <p id="countdown" class="mt-3 fw-bold"></p>
            </div>

            <!-- RIGHT -->
            <div class="col-lg-6 p-5">

                <h4 class="text-center mb-4">Cek Kelulusan</h4>

                {{-- ALERT ERROR --}}
                @if(session('error'))
                    <div class="alert alert-warning text-center">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ url('hasil') }}" method="GET">
                    <div class="mb-3">
                        <input type="text" 
                               name="nisn"
                               maxlength="10"
                               inputmode="numeric"
                               value="{{ request('nisn') }}"
                               oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                               class="form-control"
                               placeholder="Masukkan NISN"
                               required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" id="submitBtn" class="btn btn-primary">
                            Cek Sekarang
                        </button>
                    </div>
                </form>

                <p class="text-muted mt-3 text-center">
                    Masukkan NISN untuk melihat hasil kelulusan.
                </p>

                {{-- DATA TIDAK DITEMUKAN --}}
                @if(request('nisn') && !isset($students))
                    <div class="alert alert-danger mt-3 text-center">
                        NISN tidak ditemukan
                    </div>
                @endif

                {{-- HASIL --}}
                @if(isset($students))
                    <div class="mt-4 p-4 rounded shadow-sm text-center border">

                        {{-- HEADER --}}
                        @if($students->status == 1)
                            <div class="mb-3">
                                <h2 class="text-success fw-bold">🎉 SELAMAT!</h2>
                                <h4 class="fw-semibold">ANDA DINYATAKAN LULUS</h4>
                            </div>
                        @else
                            <div class="mb-3">
                                <h2 class="text-danger fw-bold">PENGUMUMAN</h2>
                                <h4 class="fw-semibold">ANDA DINYATAKAN TIDAK LULUS</h4>
                            </div>
                        @endif

                        <hr>

                        {{-- DATA SISWA --}}
                        <div class="text-start mt-3">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Nama</strong></td>
                                    <th>: {{ $students->name }}</th>
                                </tr>
                                <tr>
                                    <td><strong>NIS</strong></td>
                                    <td>: {{ $students->nis }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NISN</strong></td>
                                    <td>: {{ $students->nisn }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kelas</strong></td>
                                    <td>: {{ $students->classroom->name }} - {{ $students->major->name }}</td>
                                </tr>
                            </table>
                        </div>

                        {{-- STATUS --}}
                        @if($students->status == 1)
                            <div class="alert alert-success mt-3">
                                Berdasarkan hasil penilaian akademik, siswa dinyatakan <strong>LULUS</strong>.
                            </div>
                        @else
                            <div class="alert alert-danger mt-3">
                                Berdasarkan hasil penilaian akademik, siswa dinyatakan <strong>TIDAK LULUS</strong>.
                            </div>
                        @endif

                    </div>
                    {{-- <div class="mt-4 p-4 border rounded text-center">

                        <h5 class="fw-bold">{{ $students->name }}</h5>
                        <p>NISN: {{ $students->nisn }}</p>

                        @if($students->status == 1)
                            <h3 class="text-success mt-3">🎉 SELAMAT ANDA LULUS</h3>
                        @else
                            <h3 class="text-danger mt-3">MAAF ANDA TIDAK LULUS</h3>
                        @endif

                    </div> --}}
                @endif

            </div>
        </div>
    </div>
</div>

<!-- SCRIPT COUNTDOWN -->
<script>
    const targetDate = new Date("2026-04-29T16:55:00+07:00").getTime();

    const countdownEl = document.getElementById("countdown");
    const statusText = document.getElementById("statusText");
    const submitBtn = document.getElementById("submitBtn");

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance <= 0) {
            statusText.innerHTML = "SUDAH DIBUKA";
            countdownEl.innerHTML = "";
            submitBtn.disabled = false;
            return;
        }

        const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
        const minutes = Math.floor((distance / (1000 * 60)) % 60);
        const seconds = Math.floor((distance / 1000) % 60);

        statusText.innerHTML = "BELUM DIBUKA";
        countdownEl.innerHTML = `${hours} jam ${minutes} menit ${seconds} detik`;
        submitBtn.disabled = true;
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
</script>

</body>
</html>