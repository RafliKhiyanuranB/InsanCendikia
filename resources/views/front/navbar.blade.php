<nav class="navbar is-light has-text-weight-semibold" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item is-size-3 has-text-success" href="{{ route('front.index') }}">InsanCendikia</a>
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
              <a href="{{ route('detail.infokos') }}" class="has-text-black">Info Kos</a>
          </div>
          <div class="navbar-item">
              <a href="{{ route('detail.kuliner') }}" class="has-text-black">Kuliner</a>
          </div>
          <div class="navbar-item">
              <a href="{{ route('detail.event') }}" class="has-text-black">Event</a>
          </div>
          <div class="navbar-item">
              <a href="{{ route('detail.info') }}" class="has-text-black">Info</a>
          </div>
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-success is-rounded" href="{{ route('login') }}">Masuk</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  