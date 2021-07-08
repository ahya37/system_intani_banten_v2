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
            {{-- member tim survey --}}
            @if (auth()->guard('member')->user()->roles_survey_team == 2 && auth()->guard('member')->user()->roles_manager == 1)
            @include('includes.navbar-menu-survey-team-management')
            @elseif (auth()->guard('member')->user()->roles_survey_team == 2)
            @include('includes.navbar-menu-survey-team')
            @elseif (auth()->guard('member')->user()->roles_manager == 1)
            @include('includes.navbar-menu-survey-team-management')
            @else
            @include('includes.navbar-menu-member-only')
            @endif
          </ul>
        </div>
      </div>
    </nav>