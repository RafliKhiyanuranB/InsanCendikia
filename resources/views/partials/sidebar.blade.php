<nav class="pc-sidebar">
    <div class="navbar-wrapper">
      <div class="m-header">
        <a href="{{ route('dashboard') }}" class="b-brand text-primary">
          <!-- ========   Change your logo from here   ============ -->
          <img src="{{ asset('/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo">
          <span class="badge bg-light-success rounded-pill ms-2 theme-version">Infinity</span>
        </a>
      </div>
      <div class="navbar-content">
        <ul class="pc-navbar">
          <li class="pc-item pc-caption">
            <label>Navigation</label>
          </li>
  
          <li class="pc-item">
            <a href="{{ route('dashboard') }}" class="pc-link">
              <div class="icon-text d-flex align-items-center">
                <div class="icon me-2 mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="gray" width="20" height="20">
                        <path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                    </svg>
                </div>
                <span class="pc-mtext">Dashboard</span>
              </div>            
            </a>
          </li>

          <li class="pc-item">
            <a href="{{ route('event.index') }}" class="pc-link">
              <div class="icon-text d-flex align-items-center">
                <div class="icon me-2 mb-1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="gray" width="20" height="20"><path d="M96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L80 480c-44.2 0-80-35.8-80-80L0 128c0-17.7 14.3-32 32-32s32 14.3 32 32l0 272c0 8.8 7.2 16 16 16s16-7.2 16-16L96 96zm64 24l0 80c0 13.3 10.7 24 24 24l112 0c13.3 0 24-10.7 24-24l0-80c0-13.3-10.7-24-24-24L184 96c-13.3 0-24 10.7-24 24zm208-8c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zM160 304c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16z"/></svg>
                </div>
                <span class="pc-mtext">Event</span>
              </div>
            </a>
          </li>

          <li class="pc-item">
            <a href="{{ route('info.index') }}" class="pc-link">
              <div class="icon-text d-flex align-items-center">
                <div class="icon me-2 mb-1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="gray" width="20" height="20"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                </div>
                <span class="pc-mtext">Info</span>
              </div>
            </a>
          </li>

          <li class="pc-item">
            <a href="{{ route('berita.index') }}" class="pc-link">
              <div class="icon-text d-flex align-items-center">
                <div class="icon me-2 mb-1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="gray" width="20" height="20"><path d="M96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L80 480c-44.2 0-80-35.8-80-80L0 128c0-17.7 14.3-32 32-32s32 14.3 32 32l0 272c0 8.8 7.2 16 16 16s16-7.2 16-16L96 96zm64 24l0 80c0 13.3 10.7 24 24 24l112 0c13.3 0 24-10.7 24-24l0-80c0-13.3-10.7-24-24-24L184 96c-13.3 0-24 10.7-24 24zm208-8c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zM160 304c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16z"/></svg>
                </div>
                <span class="pc-mtext">Berita</span>
              </div>
            </a>
          </li>

          <li class="pc-item">
            <a href="{{ route('artikel.index') }}" class="pc-link">
              <div class="icon-text d-flex align-items-center">
                <div class="icon me-2 mb-1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="gray" width="20" height="20"><path d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm64 192l192 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L128 288c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 96l192 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-192 0c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0-192c0-17.7 14.3-32 32-32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32z"/></svg>
                </div>
                <span class="pc-mtext">Artikel</span>
              </div>
            </a>
          </li>

        </ul>
      </div>
    </div>
  </nav>