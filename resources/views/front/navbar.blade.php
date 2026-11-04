<nav class="navbar is-light has-text-weight-semibold" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item is-size-3 has-text-success" href="{{ route('front.index') }}">Infinity</a>
    </div>
    <div class="navbar-menu">
      <div class="navbar-start">
      </div>
      <div class="navbar-end">
          <div class="navbar-item">
              <a href="{{ route('detail.event') }}" class="has-text-black">Event</a>
          </div>
          <div class="navbar-item">
              <a href="{{ route('detail.info') }}" class="has-text-black">Info</a>
          </div>
          <div class="navbar-item">
              <a href="{{ route('detail.berita') }}" class="has-text-black">Berita</a>
          </div>
          <div class="navbar-item">
              <a href="{{ route('detail.artikel') }}" class="has-text-black">Artikel</a>
          </div>
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-success is-rounded" href="{{ route('login') }}">Masuk</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  