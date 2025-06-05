<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>utmzone</title>
    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html, body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: #363636;
            height: 100%;
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #ebebeb; /* Border abu-abu halus */
        }
        .card .subtitle {
            color: #a9a9a9;
        }
        .card .title {
            color: #363636;
        }
        a {
            color: #007bff;
        }
        .is-3 {
            color: #000000;
        }
        p {
            color: #303030;
        }
        .box {
            background-color: #f9f9f9;
            color: #303030;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow for a subtle effect */
        }
        select.is-light {
            background-color: #ffffff; /* Background putih */
            color: #363636; /* Teks warna gelap */
            border: 1px solid #b2b2b2; /* Border abu-abu halus */
            border-radius: 5px; /* Membuat sudut sedikit membulat */
            padding: 0.5em;
            font-size: 1em;
        }

        /* Hover effect untuk dropdown */
        select.is-light:hover {
            border-color: #007bff; /* Highlight biru pada hover */
        }

        /* Fokus pada dropdown */
        select.is-light:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25); /* Shadow biru halus */
        }

        /* Style untuk opsi di dropdown */
        select.is-light option {
            background-color: #ffffff; /* Background opsi tetap putih */
            color: #363636; /* Warna teks gelap */
        }
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
        .carousel-images {
            display: flex;
            transition: transform 0.5s ease-in-out; /* Smooth transition */
        }
        .carousel-image {
            min-width: 100%; /* Each image takes full width */
            height: auto; /* Maintain aspect ratio */
        }
        .carousel-images img {
            width: 100%;
            height: auto;
        }
        .carousel-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            font-size: 2rem;
            border: none;
            padding: 0.5em;
            cursor: pointer;
            z-index: 10;
        }
        .carousel-button-left {
            left: 10px;
        }
        .carousel-button-right {
            right: 10px;
        }
        .carousel-button:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
        .truncate-text {
            display: -webkit-box; /* Menggunakan model flexbox untuk teks */
            -webkit-line-clamp: 3; /* Batasi teks hingga 3 baris */
            -webkit-box-orient: vertical; /* Mengatur orientasi teks menjadi vertikal */
            overflow: hidden; /* Menyembunyikan teks yang tidak muat */
            text-overflow: ellipsis; /* Menambahkan '...' jika teks lebih panjang */
        }

    </style>
</head>
<body>
    @include('front.navbar')
        <!-- Carousel Section -->
    <div class="container is-widescreen mt-5">
        <section>
            <div class="carousel is-flex is-justify-content-center is-align-items-center">
                <p class="has-text-centered is-size-3 has-text-weight-bold">Info</p>
            </div>
        </section>
        @foreach($info as $item)
                <a href="{{ route('detail.show', ['tipe' => $item->tipe, 'id' => $item->id]) }}">
                    <div class="card mt-5">
                        <div class="card-content">
                            <article class="media">
                                <figure class="media-left">
                                    <p class="image is-4by3" style="width: 200px;">
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Image">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <div class="content">
                                        <span class="tag is-success has-text-white mb-2">
                                            {{ $item->tipe }}
                                        </span>
                                        <p class="title is-5">
                                            {{ $item->judul }}
                                        </p>
                                        <p class="subtitle is-6">
                                            {{ $item->tanggal }}
                                        </p>
                                        <p class="truncate-text">
                                            {!! Str::limit($item->description, 150, '...') !!}
                                        </p>                                                                                                      
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </a>
        @endforeach
    </div>
    @include('front.footer')
</body>
</html>
