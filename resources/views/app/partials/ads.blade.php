
@php
    $ads = \App\Models\Iklan::where('position', $position)->where('is_active', true)->get();
@endphp
<div class="ad-container" id="{{ $position }}">
    @foreach ($ads as $iklan)
    @if ($position === 'header')
        <div class="ad ad-header">
            <!-- Konten iklan header -->
             @if ($iklan->image)
                    <a href="{{ $iklan->content }}" class="d-block mb-2" target="_blank" rel="noopener">
                        <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" style="width: 200px;">
                    </a>
            @endif
        </div>
    @elseif ($position === 'sidebar1')
        <div class="ad ad-sidebar">
            <!-- Konten iklan sidebar -->
            @if ($iklan->image)
                    <a href="{{ $iklan->content }}" class="d-block mb-2" target="_blank" rel="noopener">
                        <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" style="width: 200px;">
                    </a>
            @endif
        </div>
    @elseif ($position === 'sidebar2')
        <div class="ad ad-sidebar">
            <!-- Konten iklan sidebar -->
            @if ($iklan->image)
                    <a href="{{ $iklan->content }}" class="d-block mb-2" target="_blank" rel="noopener">
                        <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" style="width: 200px;">
                    </a>
            @endif
        </div>
    @elseif ($position === 'footer')
        <div class="ad ad-footer">
            <!-- Konten iklan footer -->
            @if ($iklan->image)
                    <a href="{{ $iklan->content }}" class="d-block mb-2" target="_blank" rel="noopener">
                        <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" style="width: 200px;">
                    </a>
            @endif
        </div>
    @endif
    @endforeach
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Mendapatkan elemen-elemen iklan
    const headerAd = document.getElementById("header");
    const sidebarAd = document.getElementById("sidebar1");
    const sidebarAd = document.getElementById("sidebar2");
    const footerAd = document.getElementById("footer");

    // Fungsi untuk menampilkan pop-up
    function showPopup(position) {
        const popup = document.createElement("div");
        popup.classList.add("ad-popup", `ad-popup-${position}`);
        popup.innerHTML = `
            <div class="ad-popup-content">
                <h3>Iklan ${position.charAt(0).toUpperCase() + position.slice(1)}</h3>
                <button onclick="hidePopup()">Tutup</button>
            </div>
        `;
        document.body.appendChild(popup);
    }

    // Fungsi untuk menyembunyikan pop-up
    function hidePopup() {
        const popup = document.querySelector(".ad-popup");
        if (popup) {
            popup.remove();
        }
    }

    // Event listener untuk menampilkan pop-up saat iklan diklik
    headerAd.addEventListener("click", function () {
        showPopup("left-dashboard");
    });

    sidebarAd.addEventListener("click", function () {
        showPopup("top-right");
    });

    footerAd.addEventListener("click", function () {
        showPopup("bottom-center");
    });
});
</script>


@php
    $ads = \App\Models\Iklan::where('position', $position)->where('is_active', true)->get();
@endphp

{{-- @if ($ads->count() > 0)
    <div class="ad-section ad-{{ $position }}">
        @foreach ($ads as $iklan)
            <div class="ad-item mb-3">
                @if ($iklan->image)
                    <a href="{{ $iklan->content }}" class="d-block mb-2" target="_blank" rel="noopener">
                        <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" style="width: 200px;">
                    </a>
                @endif

                @if (!$iklan->image)
                    <div class="ad-content">
                        {!! $iklan->content !!}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endif --}}

