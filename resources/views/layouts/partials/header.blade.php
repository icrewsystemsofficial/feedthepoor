<header class="header-global">
    <nav id="navbar-main" aria-label="Primary navigation" class="navbar navbar-main navbar-expand-lg navbar-theme-gray headroom navbar-dark">
        <div class="container position-relative">
            <a class="navbar-brand me-lg-5" href="{{ route('frontend.index') }}">
                {{-- <img class="navbar-brand-dark" src="{{ asset('theme/assets/img/icrewsystems_logo_white_highres.png') }}" alt="Logo light">
                <img class="navbar-brand-light" src="{{ asset('theme/assets/img/icrewsystems_logo_highres.png') }}" alt="Logo dark"> --}}

                <img style="width: 70px; height: auto;" class="navbar-brand-dark" src="{{ asset('images/branding/roshni-foundation.png') }}" alt="Logo light">
                <img style="width: 70px; height: auto;" class="navbar-brand-light" src="{{ asset('images/branding/roshni-foundation.png') }}" alt="Logo dark">

            </a>
            <div class="navbar-collapse collapse me-auto" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="{{ route('frontend.index') }}">
                                <img src="{{ asset('theme/assets/img/icrewsystems_logo_highres.png') }}" alt="Themesberg logo">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <a href="#navbar_global" class="fas fa-times" data-bs-toggle="collapse" data-bs-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" title="close" aria-label="Toggle navigation"></a>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-hover align-items-lg-center">

                    <style>
                        .nav-link {
                            text-transform: uppercase;
                            font-size: 13px;
                            font-weight: bold;
                            letter-spacing: 2px;
                        }
                    </style>

                    <li class="nav-item">
                        <a href="{{ route('frontend.index') }}" class="nav-link">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('frontend.about') }}" class="nav-link">
                            About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('frontend.partners') }}" class="nav-link">
                            Partners
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('frontend.index') }}" class="nav-link">
                            Activity
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="componentsDropdown" aria-expanded="false" data-bs-toggle="dropdown">
                            Campaigns
                            <span class="fas fa-angle-down nav-link-arrow ms-1"></span>
                        </a>
                        <div class="dropdown-menu dropdown-megamenu-sm p-0" aria-labelledby="componentsDropdown">
                            <div class="row g-0">
                                {{-- <div class="col-lg-6 bg-gray d-none d-lg-block me-0 me-3">
                                    <div class="py-9 mx-auto text-center">
                                        <center>
                                            <img src="{{ asset('images/branding/roshni-foundation-black.png') }}"
                                            alt="Roshni_fondation_campaigns"
                                            style="width: 150px; height: auto;">
                                        </center>
                                    </div>
                                </div> --}}
                                <div class="col p-3">
                                    <ul class="list-style-none">

                                        @php
                                            $campaigns = App\Helpers\CampaignsHelper::getActiveCampaigns();
                                        @endphp

                                        @foreach ($campaigns as $campaign)
                                            <li>
                                                <a class="dropdown-item" href="{{ route('frontend.campaigns', $campaign->slug) }}">
                                                    {{ $campaign->campaign_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" id="supportDropdown" aria-expanded="false">
                            Support
                            <span class="fas fa-angle-down nav-link-arrow ms-1"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg" aria-labelledby="supportDropdown">
                            <div class="col-auto px-0">
                                <div class="list-group list-group-flush">
                                    <a href="https://themesberg.com/docs/bootstrap-5/pixel/getting-started/quick-start/" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                        <span class="icon icon-sm"><span class="fas fa-comment-alt"></span></span>
                                        <div class="ms-4">
                                            <span class="d-block font-small fw-bold mb-0">Chat with us<span class="badge badge-sm badge-secondary ms-2">v3.1</span></span>
                                        </div>
                                    </a>
                                    <a href="https://github.com/themesberg/pixel-bootstrap-ui-kit/issues" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center p-0 py-3 px-lg-4">
                                        <span class="icon icon-sm"><span class="fas fa-phone"></span></span>
                                        <div class="ms-4">
                                            <span class="d-block font-small fw-bold mb-0">Call us</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center">

                <a href="{{ route('frontend.donate') }}" target="_blank" class="btn btn-theme btn-zoom--hover btn-shadow--hover btn-animated btn-animated-x donate-btn">
                    <span class="btn-inner--visible">Donate Now</span>
                    <span class="btn-inner--hidden"><i class="fas fa-arrow-right"></i></span>
                </a>

                <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </nav>
</header>
