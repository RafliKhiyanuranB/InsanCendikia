<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>utmzone</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
  <style>
    html, body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9f9f9; /* Background terang */
    }
    .carousel {
      position: relative;
      width: 100%;
      overflow: hidden;
      max-height: 500px;
      border-radius: 10px;
    }
    .carousel-images {
      display: flex;
      transition: transform 0.5s ease-in-out;
    }
    .carousel-image {
      width: 100%;
      flex-shrink: 0;
    }
    .carousel-button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      border: none;
      padding: 1rem;
      cursor: pointer;
      z-index: 10;
    }
    .carousel-button-left {
      left: 0;
    }
    .carousel-button-right {
      right: 0;
    }

    .card {
      background-color: #ffffff; /* White background for cards */
      border-radius: 8px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow for a subtle effect */
    }
    .card-content {
      color: #333333; /* Darker text color for readability */
    }
    .title.is-5, .subtitle.is-6, .is-size-7 {
      color: #000000; /* Ensure text in titles and subtitles is dark */
    }
    .subtitle.is-6 {
      color: #000000; /* Green color for rating stars and numbers */
    }
    .is-size-7 {
      color: #000000; /* Slightly muted color for category */
    }

    .select.is-light select {
      background-color: #ffffff !important;
      color: #333333 !important; /* Ensure the text color is dark */
      font-size: 1rem !important; /* Set a clear font size */
      border: 1px solid #dddddd !important;
      width: 100%;
    }
    .select.is-light select:hover,
    .select.is-light select:focus {
      border-color: #000000 !important; /* Green border on hover/focus */
      outline: none;
      box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.25); /* Soft green outline */
    }

    .navbar .select.is-light {
      width: 300px; /* Adjust the width */
    }

    .ellipsis {
        white-space: nowrap; /* Mencegah teks terputus dan pindah ke baris berikutnya */
        overflow: hidden; /* Menyembunyikan teks yang melampaui batas */
        text-overflow: ellipsis; /* Menambahkan '...' di akhir teks yang terpotong */
        display: block; /* Pastikan elemen berperilaku sebagai blok */
        width: 100%; /* Menentukan lebar elemen */
    }
  </style>
</head>
<body>
  @include('front.navbar')
  <div class="container is-widescreen mt-3">

    <!-- Carousel Section -->
    <section>
        <div class="carousel">
            <div class="carousel-images">
            <figure class="image is-16by9 carousel-image">
                <img src="{{ asset('image.png') }}" alt="Image description">
            </figure>
            <figure class="image is-16by9 carousel-image">
                <img src="your_image2.jpg" alt="Image description">
            </figure>
            <figure class="image is-16by9 carousel-image">
                <img src="your_image3.jpg" alt="Image description">
            </figure>
            </div>
            <button class="carousel-button carousel-button-left" id="prevButton">
            ‹
            </button>
            <button class="carousel-button carousel-button-right" id="nextButton">
            ›
            </button>
        </div>
    </section>
    
    <section class="section">
      <div class="columns is-multiline">
        <!-- Pariwisata Section -->
        @forelse($event as $item)
          <div class="column is-one-third">
            <a href="{{ route('detail.show', ['tipe' => $item->tipe, 'id' => $item->id]) }}">
              <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <img src="{{ asset('storage/' . $item->foto) }}">
                  </figure>
                  <span class="icon has-text-primary is-pulled-right mt-2 mr-2">
                    <i class="fas fa-heart"></i>
                  </span>
                </div>
                <div class="card-content">
                  <span class="tag is-success is-normal mb-2 has-text-white">{{ $item->tipe }}</span>
                  <p class="title is-5 has-text-dark">{{ $item->nm_event }}</p>
                  <p class="subtitle is-6 has-text-dark">{{ $item->tanggal }}</p>
                  <p class="is-size-7 has-text-grey">{{ $item->lokasi }}</p>
                </div>
              </div>
            </a>
          </div>
        @empty
          <p class="column is-full has-text-centered">Tidak ada data Event</p>
        @endforelse
    
        <!-- Kuliner Section -->
        @forelse($kuliner as $item)
          <div class="column is-one-third">
            <a href="{{ route('detail.show', ['tipe' => $item->tipe, 'id' => $item->id]) }}">
              <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <img src="{{ asset('storage/' . $item->foto) }}">
                  </figure>
                  <span class="icon has-text-primary is-pulled-right mt-2 mr-2">
                    <i class="fas fa-heart"></i>
                  </span>
                </div>
                <div class="card-content">
                  <span class="tag is-success is-normal mb-2 has-text-white">{{ $item->tipe }}</span>
                  <p class="title is-5 has-text-dark">{{ $item->nm_kuliner }}</p>
                  <p class="subtitle is-6 has-text-dark">{!! Str::limit($item->description, 150, '...') !!}</p>
                </div>
              </div>
            </a>
          </div>
        @empty
          <p class="column is-full has-text-centered">Tidak ada data Kuliner</p>
        @endforelse
    
        <!-- Berita Terkini Section -->
        @forelse($info as $item)
          <div class="column is-one-third">
            <a href="{{ route('detail.show', ['tipe' => $item->tipe, 'id' => $item->id]) }}">
              <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <img src="{{ asset('storage/' . $item->foto) }}">
                  </figure>
                  <span class="icon has-text-primary is-pulled-right mt-2 mr-2">
                    <i class="fas fa-heart"></i>
                  </span>
                </div>
                <div class="card-content">
                  <span class="tag is-success is-normal mb-2 has-text-white">{{ $item->tipe }}</span>
                  <p class="title is-5 has-text-dark ellipsis">{{ $item->judul }}</p>
                  <p class="subtitle is-6">{{ $item->tanggal }}</p>
                </div>
              </div>
            </a>
          </div>
        @empty
          <p class="column is-full has-text-centered">Tidak ada data Info Kos</p>
        @endforelse
    
        <!-- Event Section -->
        @forelse($kos as $item)
          <div class="column is-one-third">
            <a href="{{ route('detail.show', ['tipe' => $item->tipe, 'id' => $item->id]) }}">
              <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <img src="{{ asset('storage/' . $item->foto_kos) }}">
                  </figure>
                  <span class="icon has-text-primary is-pulled-right mt-2 mr-2">
                    <i class="fas fa-heart"></i>
                  </span>
                </div>
                <div class="card-content">
                  <span class="tag is-success is-normal mb-2 has-text-white">{{ $item->tipe }}</span>
                  <p class="title is-5 has-text-dark ellipsis">{{ $item->nm_kos }}</p>
                  <p class="has-text-dark">{!! Str::limit($item->deskripsi_kos, 150, '...') !!}</p>
                </div>
              </div>
            </a>
          </div>
        @empty
          <p class="column is-full has-text-centered">Tidak ada data Info Kos</p>
        @endforelse
      </div>
    </section>       
      
      @include('front.footer')
  </div>

  <!-- JavaScript for Carousel -->
  <script>
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const carouselImages = document.querySelector('.carousel-images');
    let currentIndex = 0;
    const totalImages = document.querySelectorAll('.carousel-image').length;

    function updateCarousel() {
      const offset = -currentIndex * 100; // Move the carousel based on the index
      carouselImages.style.transform = `translateX(${offset}%)`;
    }

    prevButton.addEventListener('click', () => {
      currentIndex = (currentIndex === 0) ? totalImages - 1 : currentIndex - 1;
      updateCarousel();
    });

    nextButton.addEventListener('click', () => {
      currentIndex = (currentIndex === totalImages - 1) ? 0 : currentIndex + 1;
      updateCarousel();
    });
  </script>

</body>
</html>
