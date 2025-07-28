@php
    $ads = \App\Models\Iklan::where('position', $position)->where('is_active', true)->get();
@endphp

<div class="ad-container" id="{{ $position }}">
    @foreach ($ads as $iklan)
        <div class="iklan-wrapper" id="iklan-{{ $iklan->id }}" style="position: relative; display: inline-block;">
            {{-- Tombol X di pojok kanan atas --}}
            @if($iklan->is_active)
                <button type="button" 
                        class="btn-close-ad" 
                        onclick="deactivateIklan({{ $iklan->id }})"
                        title="Nonaktifkan Iklan">
                    ×
                </button>
            @endif
            
            @if ($position === 'header')
                <div class="ad ad-header">
                    @if ($iklan->image)
                        <a href="{{ $iklan->content }}" class="d-block mb-2" target="_blank" rel="noopener">
                            <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" style="width: 200px;">
                        </a>
                    @endif
                </div>
            @elseif ($position === 'sidebar1')
                <div class="ad ad-sidebar">
                    @if ($iklan->image)
                        <a href="{{ $iklan->content }}" class="d-block mb-2" target="_blank" rel="noopener">
                            <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" style="width: 200px;">
                        </a>
                    @endif
                </div>
            @elseif ($position === 'sidebar2')
                <div class="ad ad-sidebar">
                    @if ($iklan->image)
                        <a href="{{ $iklan->content }}" class="d-block mb-2" target="_blank" rel="noopener">
                            <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" style="width: 200px;">
                        </a>
                    @endif
                </div>
            @elseif ($position === 'home')
                <div class="ad ad-sidebar">
                    @if ($iklan->image)
                        <a href="{{ $iklan->content }}" class="d-block mb-2" target="_blank" rel="noopener">
                            <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" style="width: 200px;">
                        </a>
                    @endif
                </div>
            @elseif ($position === 'newsads')
                <div class="ad ad-sidebar">
                    @if ($iklan->image)
                        <a href="{{ $iklan->content }}" class="d-block mb-2" target="_blank" rel="noopener">
                            <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" style="width: 200px;">
                        </a>
                    @endif
                </div>
            @elseif ($position === 'footer')
                <div class="ad ad-footer">
                    @if ($iklan->image)
                        <a href="{{ $iklan->content }}" class="d-block mb-2" target="_blank" rel="noopener">
                            <img src="{{ asset('storage/' . $iklan->image) }}" alt="Gambar Iklan" style="width: 200px;">
                        </a>
                    @endif
                </div>
            @endif
        </div>
    @endforeach
</div>

<style>
.btn-close-ad {
    position: absolute !important;
    top: 5px !important;
    right: 5px !important;
    background: rgba(255, 0, 0, 0.8) !important;
    color: white !important;
    width: 25px !important;
    height: 25px !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    cursor: pointer !important;
    border: none !important;
    font-weight: bold !important;
    font-size: 18px !important;
    padding: 0 !important;
    z-index: 1000 !important;
}

.btn-close-ad:hover {
    background: rgba(254, 254, 254, 1) !important;
}

.iklan-wrapper {
    position: relative !important;
    margin-bottom: 10px !important;
}
</style>

<script>
// Fungsi deactivateIklan harus didefinisikan di luar event listener
function deactivateIklan(iklanId) {
    fetch(`/iklan/${iklanId}/deactivate`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Sembunyikan iklan langsung
            const iklanElement = document.getElementById(`iklan-${iklanId}`);
            if (iklanElement) {
                iklanElement.style.display = 'none';
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Perbaiki bagian JavaScript yang error
document.addEventListener("DOMContentLoaded", function () {
    // Perbaiki variabel yang duplikat
    const headerAd = document.getElementById("header");
    const sidebar1Ad = document.getElementById("sidebar1");
    const sidebar2Ad = document.getElementById("sidebar2");
    const homeAd = document.getElementById("home");
    const newsadsAd = document.getElementById("newsads");
    const footerAd = document.getElementById("footer");

    // Hapus bagian popup yang menyebabkan error jika tidak diperlukan
    // Karena ini mungkin tidak relevan dengan fungsi tombol X
});
</script>