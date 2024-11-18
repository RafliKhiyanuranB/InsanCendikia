<nav class="navbar is-light has-text-weight-semibold" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item is-size-3" href="#">GuestMadura</a>
    </div>
    <div class="navbar-menu">
      <div class="navbar-start">
        {{-- <div class="navbar-item select is-rounded is-light mt-3">
          <select>
            <option value="">Pilih Kabupaten</option>
            @foreach($kabupatens as $kabupaten)
              <option value="{{ $kabupaten->id }}">{{ $kabupaten->nama_kabupaten }}</option>
            @endforeach
          </select>
        </div> --}}
      </div>
      <div class="navbar-end">
          <div class="navbar-item">
              <a href="" class="has-text-black">Pariwisata</a>
          </div>
          <div class="navbar-item">
              <a href="" class="has-text-black">Berita Terkini</a>
          </div>
          <div class="navbar-item">
              <a href="" class="has-text-black">Event</a>
          </div>
          <div class="navbar-item">
              <a href="" class="has-text-black">Kuliner</a>
          </div>
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-black is-rounded">Masuk</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  