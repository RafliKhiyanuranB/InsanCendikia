<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>InsanCendikia</title>
    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMbXja9FY34E7yPJwxqW5tA03qG8QmK50Wyo5lg" crossorigin="anonymous">
    <!-- Custom Styles for Light Mode -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5; /* Light background */
            color: #000000; /* Dark text for readability */
        }
        .box {
            background-color: #ffffff; /* White background for boxes */
            border: 1px solid #ddd; /* Light border */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .title.is-4 {
            color: #000000; /* Darker title color */
        }
        .tag.is-success.is-light {
            background-color: #d4edda; /* Light green background for rating tags */
            color: #155724; /* Dark green text for rating tags */
        }
        .button.is-link.is-small {
            background-color: #3273dc; /* Primary link color */
            color: #fff;
            border: none;
        }
        .button.is-link.is-small:hover {
            background-color: #2759a7; /* Darker shade on hover */
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

        .is-size-7 {
            color: #000 !important;
        }
    </style>
</head>
<body>
    @include('front.navbar')
    <div class="container is-widescreen pt-5">
        <div class="columns">
            <!-- Detail Section -->
            <div class="column is-5">
                <div class="box">
                    <h2 class="title is-4">Detail {{ ucfirst($tipe) }}</h2>
                    <div class="media">
                        <div class="media-content">
                            <p class="has-text-weight-semibold has-text-black">
                                @if ($tipe === 'pariwisata')
                                    {{ $data->nm_pariwisata }}
                                @elseif ($tipe === 'kuliner')
                                    {{ $data->nm_kuliner }}
                                @elseif ($tipe === 'beritaterkini')
                                    {{ $data->nm_berita }}
                                @elseif ($tipe === 'event')
                                    {{ $data->nm_event }}
                                @endif
                            </p>
                            <p class="is-size-7 has-text-grey-dark">{!! $data->description !!}</p>
                            @if ($tipe === 'pariwisata')
                                <p class="is-size-7 has-text-black">
                                    Kabupaten: {{ $data->kabupatens->nama_kabupaten }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <button id="likeButton" class="button has-text-white is-fullwidth">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                    </svg>
                    Suka
                </button>
            </div>
            
            <!-- Image Gallery Section -->
            <div class="column is-7">
                <div class="box">
                    <figure class="image is-4by3">
                        <img src="{{ asset('storage/' . $data->foto) }}" alt="{{ $tipe === 'pariwisata' ? $data->nm_pariwisata : $data->nm_kuliner }}">
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <!-- Include footer -->
    @include('front.footer')

    <script>
        document.getElementById('likeButton').addEventListener('click', function() {
            Swal.fire({
                icon: 'success',
                title: 'Anda menyukai ini!',
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
</body>
</html>
