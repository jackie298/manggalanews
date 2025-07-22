@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Statistik Pembaca</h4>
                    <h5>Total Keseluruhan Views</h5>
                    <p class="display-6">{{ number_format($totalViews) }}</p>
                    <canvas id="viewsChart" width="400" height="200" style="border: 1px solid red;"></canvas>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js "></script>

                    <script>
                        const postViews = @json($postViews);

                        const labels = postViews.map(post => post.title); // pastikan sesuai field di DB
                        const data = postViews.map(post => post.views);

                        const ctx = document.getElementById('viewsChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Jumlah Views',
                                    data: data,
                                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1
                                        }
                                    }
                                }
                            }
                        });
                    </script>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List Berita</h4>
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Berita</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postViews as $post)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ number_format($post->views) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Top Penulis Berdasarkan Total Views</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penulis</th>
                                    <th>Total Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($author as $author)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $author->user?->name ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ number_format($author->total_views) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js "></script>


@endsection

