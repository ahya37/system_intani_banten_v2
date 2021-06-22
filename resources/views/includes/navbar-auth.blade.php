<nav
      class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top shadow p-3 mb-5 bg-white rounded"
      data-aos="fade-down"
    >
      <div class="container">
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
        >
          <span class="navbar-toggler-icon"> </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a href="{{route('member-dashboard')}}" class="nav-link">Dasbor</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link active dropdown-toggle"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                v-pre
              >
                Investor
              </a>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdown"
              >
                <a
                  class="dropdown-item"
                  href=""
                >
                  Data Investor
                </a>
                <a
                  class="dropdown-item"
                  href=""
                >
                  Tambah Investor
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link active dropdown-toggle"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                v-pre
              >
                Petani
              </a>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdown"
              >
                <a
                  class="dropdown-item"
                  href=""
                >
                  Data Petani
                </a>
                <a
                  class="dropdown-item"
                  href=""
                >
                  Tambah Petani
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link active dropdown-toggle"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                v-pre
              >
                Kelompok Pertanian
              </a>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdown"
              >
                <a
                  class="dropdown-item"
                  href=""
                >
                  Data Kelompok Pertanian
                </a>
                <a
                  class="dropdown-item"
                  href=""
                >
                  Tambah Kelompok Pertanian
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link active dropdown-toggle"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                v-pre
              >
                Permodalan
              </a>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdown"
              >
                <a
                  class="dropdown-item"
                  href=""
                >
                  Data Permodalan
                </a>
                <a
                  class="dropdown-item"
                  href=""
                >
                  Tambah Permodalan
                </a>
                <a
                  class="dropdown-item"
                  href=""
                >
                  Transaksi
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link active dropdown-toggle"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                v-pre
              >
                Laporan
              </a>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdown"
              >
                <a
                  class="dropdown-item"
                  href=""
                >
                  Kas Penerimaan dan Pengeluaran
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a
                href="#"
                class="nav-link"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
              >
                <img
                  src="https://image.flaticon.com/icons/png/512/633/633780.png"
                  alt=""
                  class="reounded-circle mr-2 profile-picture"
                  width="25"
                />
                {{ auth()->guard('member')->user()->name }}
              </a>
              <div class="dropdown-menu">
                <a href="{{route('member-profile')}}" class="dropdown-item">Profil</a>
                <a href="{{route('member-ecard')}}" class="dropdown-item">E-Anggota</a>
                <a href="{{route('member-notulen')}}" class="dropdown-item">Notulensi</a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" 
                    class="dropdown-item">Logout</a>
                    <form id="logout-form" action="{{ route('member-logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>