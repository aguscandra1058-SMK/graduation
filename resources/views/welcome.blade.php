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
        #countdownAnim {
            font-size: 60px;
            animation: zoom 1s ease-in-out infinite;
        }
        button:disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }
        

        @keyframes zoom {
            0% { transform: scale(1); opacity: 0.7; }
            50% { transform: scale(1.3); opacity: 1; }
            100% { transform: scale(1); opacity: 0.7; }
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

                <h2 class="fw-bold">PENGUMUMAN KELULUSAN</h2>
                <h5>SMK Bina Cipta Palembang</h5>
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

                <form id="formCek" action="{{ url('hasil') }}" method="GET">
                    <div id="loadingBox" class="text-center mt-4" style="display:none;">
                        <h5 class="mb-3">Sedang memproses...</h5>
                        <h1 id="countdownAnim" class="fw-bold text-primary">5</h1>
                    </div>

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
                <div id="errorBox" class="alert alert-danger mt-3 text-center" style="display:none;">
                    NISN tidak ditemukan
                </div>

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
                                <h2 class="text-danger fw-bold">MOHON MAAF</h2>
                                <h4 class="fw-semibold">ANDA DINYATAKAN TIDAK LULUS</h4>
                            </div>
                        @endif

                        <hr>

                        {{-- DATA SISWA --}}
                        <div class="text-start mt-3">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><strong>Nama</strong></td>
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
                                    <td>: {{ optional($students->classroom)->name }} - {{ optional($students->major)->name }}</td>
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
                @endif

            </div>
        </div>
    </div>
</div>

<!-- SCRIPT COUNTDOWN -->
<script>
    const targetDate = new Date("2026-05-04T21:00:00+07:00").getTime();

    const countdownEl = document.getElementById("countdown");
    const statusText = document.getElementById("statusText");
    const submitBtn = document.getElementById("submitBtn");
    const nisnInput = document.querySelector("input[name='nisn']");

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance <= 0) {
            statusText.innerHTML = "SUDAH DIBUKA";
            countdownEl.innerHTML = "";

            // ✅ AKTIFKAN INPUT & BUTTON
            submitBtn.disabled = false;
            nisnInput.disabled = false;

            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
        const minutes = Math.floor((distance / (1000 * 60)) % 60);
        const seconds = Math.floor((distance / 1000) % 60);

        statusText.innerHTML = "BELUM DIBUKA";
        countdownEl.innerHTML = `${days} hari ${hours} jam ${minutes} menit ${seconds} detik`;

        // 🔒 KUNCI INPUT & BUTTON
        submitBtn.disabled = true;
        nisnInput.disabled = true;
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
</script>

<script>
window.onload = function() {

    const form = document.getElementById("formCek");
    const submitBtn = document.getElementById("submitBtn");
    const nisnInput = document.querySelector("input[name='nisn']");
    const loadingBox = document.getElementById("loadingBox");
    const countdownAnim = document.getElementById("countdownAnim");
    const errorBox = document.getElementById("errorBox");

    if (!form || !submitBtn || !nisnInput) {
        console.log("Element penting tidak ditemukan!");
        return;
    }

    form.addEventListener("submit", function(e) {
        e.preventDefault();

        const nisn = nisnInput.value;

        if (!nisn) return;

        if (errorBox) errorBox.style.display = "none";
        if (loadingBox) loadingBox.style.display = "none";

        fetch("{{ url('cek-nisn') }}?nisn=" + nisn)
        .then(res => res.json()) // 🔥 langsung JSON (karena sudah benar)
        .then(data => {

            console.log("DATA:", data);

            // ❌ NISN SALAH
            if (!data.found) {
                if (errorBox) errorBox.style.display = "block";
                return;
            }

            // ✅ NISN BENAR → ANIMASI
            let count = 5;

            if (loadingBox) loadingBox.style.display = "block";

            submitBtn.disabled = true;
            submitBtn.innerText = "Memproses...";

            let interval = setInterval(function() {
                if (countdownAnim) countdownAnim.innerText = count;

                count--;

                if (count < 0) {
                    clearInterval(interval);

                    // lanjut ke hasil
                    form.submit();
                }
            }, 1000);

        })
        .catch(err => {
            console.log(err);
            alert("Koneksi gagal");
        });
    });

};
</script>

</body>
</html>