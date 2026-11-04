<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Infinity - Artikel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
    <style>
        html, body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: #363636;
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #ebebeb;
            transition: box-shadow 0.2s;
        }
        .card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.12); }
        .carousel {
            position: relative;
            width: 100%;
            overflow: hidden;
            max-height: 300px;
            border-radius: 10px;
            padding-top: 10%;
            padding-bottom: 10%;
            background-color: rgba(160, 160, 160, 0.5);
        }
        .truncate-text {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    @include('front.navbar')
    <div class="container is-widescreen mt-5">
        <section>
            <div class="carousel is-flex is-justify-content-center is-align-items-center">
                <p class="has-text-centered is-size-3 has-text-weight-bold">Artikel</p>
            </div>
        </section>
        @forelse($artikel as $item)
            <a href="{{ route('detail.show', ['tipe' => $item->tipe, 'id' => $item->id]) }}">
                <div class="card mt-5">
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-warning has-text-dark mb-2">{{ $item->tipe }}</span>
                            <p class="title is-5">{{ $item->judul }}</p>
                            <p class="subtitle is-6">
                                <i class="fas fa-user me-1"></i> {{ $item->penulis }}
                                &nbsp;|&nbsp;
                                <i class="fas fa-calendar-alt me-1"></i> {{ $item->tanggal }}
                            </p>
                            <p class="truncate-text">
                                {{ Str::limit(strip_tags($item->konten), 200, '...') }}
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="mt-5 has-text-centered">
                <p class="is-size-5 has-text-grey">Belum ada data artikel.</p>
            </div>
        @endforelse
    </div>
    @include('front.footer')
</body>
</html>

