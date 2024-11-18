<nav class="pc-sidebar">
    <div class="navbar-wrapper">
      <div class="m-header">
        <a href="../dashboard/index.html" class="b-brand text-primary">
          <!-- ========   Change your logo from here   ============ -->
          <img src="{{ asset('/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo">
          <span class="badge bg-light-success rounded-pill ms-2 theme-version">v9.0</span>
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
            <a href="{{ route('kabupaten.index') }}" class="pc-link">
              <div class="icon-text d-flex align-items-center">
                <div class="icon me-2 mb-1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="gray" width="20" height="20"><path d="M408 120c0 54.6-73.1 151.9-105.2 192c-7.7 9.6-22 9.6-29.6 0C241.1 271.9 168 174.6 168 120C168 53.7 221.7 0 288 0s120 53.7 120 120zm8 80.4c3.5-6.9 6.7-13.8 9.6-20.6c.5-1.2 1-2.5 1.5-3.7l116-46.4C558.9 123.4 576 135 576 152l0 270.8c0 9.8-6 18.6-15.1 22.3L416 503l0-302.6zM137.6 138.3c2.4 14.1 7.2 28.3 12.8 41.5c2.9 6.8 6.1 13.7 9.6 20.6l0 251.4L32.9 502.7C17.1 509 0 497.4 0 480.4L0 209.6c0-9.8 6-18.6 15.1-22.3l122.6-49zM327.8 332c13.9-17.4 35.7-45.7 56.2-77l0 249.3L192 449.4 192 255c20.5 31.3 42.3 59.6 56.2 77c20.5 25.6 59.1 25.6 79.6 0zM288 152a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"/></svg>
                </div>
                <span class="pc-mtext">Kabupaten</span>
              </div>
            </a
            >
          </li>
          <li class="pc-item">
            <a href="{{ route('pariwisata.index') }}" class="pc-link">
              <div class="icon-text d-flex align-items-center">
                <div class="icon me-2 mb-1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="gray" width="20" height="20"><path d="M51.7 295.1l31.7 6.3c7.9 1.6 16-.9 21.7-6.6l15.4-15.4c11.6-11.6 31.1-8.4 38.4 6.2l9.3 18.5c4.8 9.6 14.6 15.7 25.4 15.7c15.2 0 26.1-14.6 21.7-29.2l-6-19.9c-4.6-15.4 6.9-30.9 23-30.9l2.3 0c13.4 0 25.9-6.7 33.3-17.8l10.7-16.1c5.6-8.5 5.3-19.6-.8-27.7l-16.1-21.5c-10.3-13.7-3.3-33.5 13.4-37.7l17-4.3c7.5-1.9 13.6-7.2 16.5-14.4l16.4-40.9C303.4 52.1 280.2 48 256 48C141.1 48 48 141.1 48 256c0 13.4 1.3 26.5 3.7 39.1zm407.7 4.6c-3-.3-6-.1-9 .8l-15.8 4.4c-6.7 1.9-13.8-.9-17.5-6.7l-2-3.1c-6-9.4-16.4-15.1-27.6-15.1s-21.6 5.7-27.6 15.1l-6.1 9.5c-1.4 2.2-3.4 4.1-5.7 5.3L312 330.1c-18.1 10.1-25.5 32.4-17 51.3l5.5 12.4c8.6 19.2 30.7 28.5 50.5 21.1l2.6-1c10-3.7 21.3-2.2 29.9 4.1l1.5 1.1c37.2-29.5 64.1-71.4 74.4-119.5zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm144.5 92.1c-2.1 8.6 3.1 17.3 11.6 19.4l32 8c8.6 2.1 17.3-3.1 19.4-11.6s-3.1-17.3-11.6-19.4l-32-8c-8.6-2.1-17.3 3.1-19.4 11.6zm92-20c-2.1 8.6 3.1 17.3 11.6 19.4s17.3-3.1 19.4-11.6l8-32c2.1-8.6-3.1-17.3-11.6-19.4s-17.3 3.1-19.4 11.6l-8 32zM343.2 113.7c-7.9-4-17.5-.7-21.5 7.2l-16 32c-4 7.9-.7 17.5 7.2 21.5s17.5 .7 21.5-7.2l16-32c4-7.9 .7-17.5-7.2-21.5z"/></svg>
                </div>
                <span class="pc-mtext">Pariwisata</span>
              </div>
            </a
            >
            <li class="pc-item">
            <a href="{{ route('kuliner.index') }}" class="pc-link">
              <div class="icon-text d-flex align-items-center">
                <div class="icon me-2 mb-1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="gray" width="20" height="20"><path d="M416 0C400 0 288 32 288 176V288c0 35.3 28.7 64 64 64h32V480c0 17.7 14.3 32 32 32s32-14.3 32-32V352 240 32c0-17.7-14.3-32-32-32zM64 16C64 7.8 57.9 1 49.7 .1S34.2 4.6 32.4 12.5L2.1 148.8C.7 155.1 0 161.5 0 167.9c0 45.9 35.1 83.6 80 87.7V480c0 17.7 14.3 32 32 32s32-14.3 32-32V255.6c44.9-4.1 80-41.8 80-87.7c0-6.4-.7-12.8-2.1-19.1L191.6 12.5c-1.8-8-9.3-13.3-17.4-12.4S160 7.8 160 16V150.2c0 5.4-4.4 9.8-9.8 9.8c-5.1 0-9.3-3.9-9.8-9L127.9 14.6C127.2 6.3 120.3 0 112 0s-15.2 6.3-15.9 14.6L83.7 151c-.5 5.1-4.7 9-9.8 9c-5.4 0-9.8-4.4-9.8-9.8V16zm48.3 152l-.3 0-.3 0 .3-.7 .3 .7z"/></svg>
                </div>
                <span class="pc-mtext">Kuliner</span>
              </div>
            </a
            >
          </li>
          <li class="pc-item">
            <a href="{{ route('event.index') }}" class="pc-link">
              <div class="icon-text d-flex align-items-center">
                <div class="icon me-2 mb-1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="gray" width="20" height="20"><path d="M96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L80 480c-44.2 0-80-35.8-80-80L0 128c0-17.7 14.3-32 32-32s32 14.3 32 32l0 272c0 8.8 7.2 16 16 16s16-7.2 16-16L96 96zm64 24l0 80c0 13.3 10.7 24 24 24l112 0c13.3 0 24-10.7 24-24l0-80c0-13.3-10.7-24-24-24L184 96c-13.3 0-24 10.7-24 24zm208-8c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zM160 304c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16z"/></svg>                </div>
                <span class="pc-mtext">Event</span>
              </div>
            </a
            >
          </li>
          <li class="pc-item">
            <a href="{{ route('berita.index') }}" class="pc-link">
              <div class="icon-text d-flex align-items-center">
                <div class="icon me-2 mb-1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="gray" width="20" height="20"><path d="M96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L80 480c-44.2 0-80-35.8-80-80L0 128c0-17.7 14.3-32 32-32s32 14.3 32 32l0 272c0 8.8 7.2 16 16 16s16-7.2 16-16L96 96zm64 24l0 80c0 13.3 10.7 24 24 24l112 0c13.3 0 24-10.7 24-24l0-80c0-13.3-10.7-24-24-24L184 96c-13.3 0-24 10.7-24 24zm208-8c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zM160 304c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16z"/></svg>                </div>
                <span class="pc-mtext">Berita Terkini</span>
              </div>
            </a
            >
          </li>
          {{-- <li class="pc-item">
            <a href="../pages/register-v1.html" class="pc-link" target="_blank"
              ><span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-password-check"></use>
                </svg> </span
              ><span class="pc-mtext">Register</span></a
            >
          </li>
          <li class="pc-item pc-caption">
            <label>UI Components</label>
            <svg class="pc-icon">
              <use xlink:href="#custom-box-1"></use>
            </svg>
          </li>
          <li class="pc-item">
            <a href="../elements/bc_typography.html" class="pc-link"
              ><span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-text-block"></use>
                </svg> </span
              ><span class="pc-mtext">Typography</span></a
            >
          </li>
          <li class="pc-item">
            <a href="../elements/bc_color.html" class="pc-link"
              ><span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-clipboard"></use>
                </svg> </span
              ><span class="pc-mtext">Color</span></a
            >
          </li>
          <li class="pc-item">
            <a href="../elements/icon-tabler.html" class="pc-link"
              ><span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-mouse-circle"></use>
                </svg> </span
              ><span class="pc-mtext">Tabler</span>
            </a>
          </li>
          <li class="pc-item pc-caption">
            <label>Other</label>
            <svg class="pc-icon">
              <use xlink:href="#custom-notification-status"></use>
            </svg>
          </li>
          <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link"
              ><span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-level"></use>
                </svg> </span
              ><span class="pc-mtext">Menu levels</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
            ></a>
            <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>
              <li class="pc-item pc-hasmenu">
                <a href="#!" class="pc-link"
                  >Level 2.2<span class="pc-arrow"><i data-feather="chevron-right"></i></span
                ></a>
                <ul class="pc-submenu">
                  <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                  <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                  <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"
                      >Level 3.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span
                    ></a>
                    <ul class="pc-submenu">
                      <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                      <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="pc-item pc-hasmenu">
                <a href="#!" class="pc-link"
                  >Level 2.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span
                ></a>
                <ul class="pc-submenu">
                  <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                  <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                  <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"
                      >Level 3.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span
                    ></a>
                    <ul class="pc-submenu">
                      <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                      <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="pc-item"
            ><a href="../other/sample-page.html" class="pc-link">
              <span class="pc-micon">
                <svg class="pc-icon">
                  <use xlink:href="#custom-notification-status"></use>
                </svg>
              </span>
              <span class="pc-mtext">Sample page</span></a
            ></li
          > --}}
  
        </ul>
      </div>
    </div>
  </nav>