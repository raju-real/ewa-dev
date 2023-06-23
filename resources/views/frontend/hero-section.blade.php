 <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>{{ siteSetting()['site_title'] }}</h1>
          <h2>{{ siteSetting()['site_slogan'] }}</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#registration" class="btn-get-started scrollto">Become a member</a>
              @if(!empty(siteSetting()['youtube_url']))
            <a href="{{ siteSetting()['youtube_url'] }}" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
              @endif
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200" style="background-image: url('assets/frontend/img/hero-img.png')">
          <img src="{{ asset('assets/frontend/img/hero-img.png') }}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->
