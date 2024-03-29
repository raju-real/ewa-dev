@extends('frontend.layouts')
@section('content')
<!-- ======= Contact Section ======= -->
<section id="registration" class="contact">
    <div class="container" data-aos="fade-up">
        @if (Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
        @endif
        <div class="section-title">
            <h2>Member Registration</h2>
            <p>You are always welcome to be our honorable member.</p>
        </div>

        <div class="row">
            <div class="col-lg-6 mt-5 mt-lg-0 d-flex align-items-stretch">
                <form action="{{ route('become-a-member') }}" method="POST" role="form"
                    class="needs-validation php-email-form" novalidate>
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name">Name</label> {!! starSign() !!}
                            <input type="text" name="name" value="{{ old('name') }}" autocomplete="off"
                                class="form-control max-length-input @error('name') is-invalid @enderror" maxlength="50"
                                placeholder="Name" id="name" required>
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Mobile</label> {!! starSign() !!}
                            <input type="text" name="mobile" value="{{ old('mobile') }}" autocomplete="off"
                                class="form-control max-length-input @error('mobile') is-invalid @enderror"
                                maxlength="11" placeholder="Mobile" id="mobile" required>
                            @error('mobile')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Email</label> {!! starSign() !!}
                            <input type="email" name="email" value="{{ old('email') }}" autocomplete="off"
                                class="form-control max-length-input @error('email') is-invalid @enderror"
                                maxlength="50" placeholder="Email" id="email" required>
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="from_kaunia">Are you from Kaunia ?</label> {!! starSign() !!}
                            <select name="from_kaunia" id="from_kaunia"
                                class="form-select @error('from_kaunia') is-invalid @enderror" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            @error('from_kaunia')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="complete_graduation">Do you complete your graduation (Diploma/Bsc) ?</label>
                            {!! starSign() !!}
                            <select name="complete_graduation" id="complete_graduation"
                                class="form-select @error('complete_graduation') is-invalid @enderror" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            @error('complete_graduation')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Password</label> {!! starSign() !!}
                            <input type="password" name="password" autocomplete="off"
                                class="form-control max-length-input @error('password') is-invalid @enderror"
                                maxlength="15" placeholder="Password" id="password" required>
                            @error('password')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="text-center"><button type="submit">Submit</button></div>
                </form>
            </div>
            <div class="col-lg-6 d-flex align-items-stretch">
                <img src="{{ asset('assets/frontend/img/hand4.jpg') }}" alt="" class="img-responsive w-100">
            </div>
        </div>

    </div>
</section><!-- End Contact Section -->
<!-- ======= About Us Section ======= -->
<section id="about" class="about">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>About Us</h2>
        </div>

        <div class="row content">
            <div class="col-lg-12">
                {!! siteSetting()['about_us'] ?? '' !!}
            </div>
        </div>

    </div>
</section><!-- End About Us Section -->

<!-- ======= Why Us Section ======= -->
<section id="why-us" class="why-us section-bg">
    <div class="container-fluid" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                <div class="content">
                    <h3>Frequently Asked Questions: Making Your Queries Easy!</h3>
                    <p>Answers at Your Fingertips, Anytime, Anywhere!</p>
                </div>

                <div class="accordion-list">
                    <ul>
                        @foreach (App\Models\Faq::latest()->get() as $faq)
                        <li>
                            <a data-bs-toggle="collapse" class="collapse"
                                data-bs-target="#accordion-list-{{ $loop->index + 1 }}"><span>{{ $loop->index + 1 }}</span> {{ $faq->question ?? "" }}<i
                                    class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="accordion-list-{{ $loop->index + 1 }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent=".accordion-list">
                                <p>
                                    {{ $faq->answer ?? '' }}
                                </p>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>

            </div>

            <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
                style='background-image: url("assets/frontend/img/why-us.png");' data-aos="zoom-in"
                data-aos-delay="150">&nbsp;</div>
        </div>

    </div>
</section><!-- End Why Us Section -->

<!-- ======= Skills Section ======= -->
<section id="skills" class="skills">
    <div class="section-title">
        <h2>Engineers We Have</h2>
    </div>
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
                <div class="skills-content">
                    @foreach (App\Models\EngineerType::all() as $type)
                    @if ($loop->odd)
                    <div class="progress">
                        <span class="skill">{{ $type->title ?? '' }} <i class="val">25%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

            </div>

            <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
                <div class="skills-content">
                    @foreach (App\Models\EngineerType::all() as $type)
                    @if ($loop->even)
                    <div class="progress">
                        <span class="skill">{{ $type->title ?? '' }} <i class="val">25%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

            </div>
        </div>

    </div>
</section><!-- End Skills Section -->

<!-- ======= About Us Section ======= -->
<section id="policy" class="about">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Our Policy</h2>
        </div>

        <div class="row content">
            <div class="col-lg-12">
                {!! siteSetting()['privacy_policy'] ?? '' !!}
            </div>
        </div>

    </div>
</section><!-- End About Us Section -->

<!-- ======= Our Mission Section ======= -->
<section id="missions" class="services section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Our Mission</h2>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">
            @if (isset(siteSetting()['mission']))
            @foreach (siteSetting()['mission'] as $mission)
            <div class="col-xl-3 col-md-6 align-items-stretch mt-4 mt-xl-0 pb-2" data-aos="zoom-in"
                data-aos-delay="300">
                <div class="icon-box">
                    <div class="icon">
                        <i class="bi bi-{{ $loop->odd ? 'bullseye' : 'ticket-detailed' }}"></i>
                        <i class="bi bi-"></i>
                    </div>
                    <p class="mission-text">{{ $mission ?? '' }}</p>
                </div>
            </div>
            @endforeach
            @endif
        </div>

    </div>
</section><!-- End Services Section -->

<!-- ======= Events Section ======= -->
<!--
        <section id="events" class="portfolio">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>Events</h2>
              <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

              <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-img"><img src="assets/frontend/img/portfolio/portfolio-1.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                  <h4>App 1</h4>
                  <p>App</p>
                  <a href="assets/frontend/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                <div class="portfolio-img"><img src="assets/frontend/img/portfolio/portfolio-2.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                  <h4>Web 3</h4>
                  <p>Web</p>
                  <a href="assets/frontend/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-img"><img src="assets/frontend/img/portfolio/portfolio-3.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                  <h4>App 2</h4>
                  <p>App</p>
                  <a href="assets/frontend/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                <div class="portfolio-img"><img src="assets/frontend/img/portfolio/portfolio-4.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                  <h4>Card 2</h4>
                  <p>Card</p>
                  <a href="assets/frontend/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                <div class="portfolio-img"><img src="assets/frontend/img/portfolio/portfolio-5.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                  <h4>Web 2</h4>
                  <p>Web</p>
                  <a href="assets/frontend/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <div class="portfolio-img"><img src="assets/frontend/img/portfolio/portfolio-6.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                  <h4>App 3</h4>
                  <p>App</p>
                  <a href="assets/frontend/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                <div class="portfolio-img"><img src="assets/frontend/img/portfolio/portfolio-7.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                  <h4>Card 1</h4>
                  <p>Card</p>
                  <a href="assets/frontend/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                <div class="portfolio-img"><img src="assets/frontend/img/portfolio/portfolio-8.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                  <h4>Card 3</h4>
                  <p>Card</p>
                  <a href="assets/frontend/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                <div class="portfolio-img"><img src="assets/frontend/img/portfolio/portfolio-9.jpg" class="img-fluid" alt=""></div>
                <div class="portfolio-info">
                  <h4>Web 3</h4>
                  <p>Web</p>
                  <a href="assets/frontend/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>

            </div>

          </div>
        </section>
        -->
<!-- End Portfolio Section -->

<!-- ======= Team Section ======= -->
<!--
        <section id="team" class="team section-bg">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>Team</h2>
              <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row">

              <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="member d-flex align-items-start">
                  <div class="pic"><img src="assets/frontend/img/team/team-1.jpg" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>Walter White</h4>
                    <span>Chief Executive Officer</span>
                    <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                    <div class="social">
                      <a href=""><i class="ri-twitter-fill"></i></a>
                      <a href=""><i class="ri-facebook-fill"></i></a>
                      <a href=""><i class="ri-instagram-fill"></i></a>
                      <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="200">
                <div class="member d-flex align-items-start">
                  <div class="pic"><img src="assets/frontend/img/team/team-2.jpg" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>Sarah Jhonson</h4>
                    <span>Product Manager</span>
                    <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                    <div class="social">
                      <a href=""><i class="ri-twitter-fill"></i></a>
                      <a href=""><i class="ri-facebook-fill"></i></a>
                      <a href=""><i class="ri-instagram-fill"></i></a>
                      <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="member d-flex align-items-start">
                  <div class="pic"><img src="assets/frontend/img/team/team-3.jpg" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>William Anderson</h4>
                    <span>CTO</span>
                    <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                    <div class="social">
                      <a href=""><i class="ri-twitter-fill"></i></a>
                      <a href=""><i class="ri-facebook-fill"></i></a>
                      <a href=""><i class="ri-instagram-fill"></i></a>
                      <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="400">
                <div class="member d-flex align-items-start">
                  <div class="pic"><img src="assets/frontend/img/team/team-4.jpg" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>Amanda Jepson</h4>
                    <span>Accountant</span>
                    <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                    <div class="social">
                      <a href=""><i class="ri-twitter-fill"></i></a>
                      <a href=""><i class="ri-facebook-fill"></i></a>
                      <a href=""><i class="ri-instagram-fill"></i></a>
                      <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </section>
        -->
<!-- End Team Section -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact mb-4">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Contact</h2>
            <p>Send us a message for any query</p>
        </div>

        <div class="row">

            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="info">
                    <div class="address">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Location:</h4>
                        <p>{{ siteSetting()['address'] ?? '' }}</p>
                    </div>

                    <div class="email">
                        <i class="bi bi-envelope"></i>
                        <h4>Email:</h4>
                        <p>{{ siteSetting()['email'] ?? '' }}</p>
                    </div>

                    <div class="phone">
                        <i class="bi bi-phone"></i>
                        <h4>Call:</h4>
                        <p>{{ siteSetting()['phone'] ?? '' }}</p>
                    </div>

                    <iframe class="w-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57488.17433739199!2d89.39643728440444!3d25.770203647190478!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e2d666bb328579%3A0x9483bbaa656932cd!2sKaunia!5e0!3m2!1sen!2sbd!4v1687715131709!5m2!1sen!2sbd"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>

            <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                <form action="#" method="post" role="form" class="php-email-form needs-validation" novalidate>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Your Name</label>
                            <input type="text" placeholder="Your Name" name="name" class="form-control" id="guest-name"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Your Email</label>
                            <input type="email" placeholder="Your Email" class="form-control" name="email"
                                id="guest-email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Subject</label>
                        <input type="text" placeholder="Subject" class="form-control" name="subject" id="guest-subject"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="name">Message</label>
                        <textarea class="form-control" placeholder="Message" name="message" id="guest-message" rows="10"
                            required></textarea>
                    </div>
                    <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <div class="text-center"><button type="button" id="send-guest-message"
                            class="btn btn-info btn-md">Send Message</button></div>
                </form>
            </div>

        </div>

    </div>
</section><!-- End Contact Section -->
@endsection

@push('js')
<script>
    $(document).on('click', '#send-guest-message', function() {
            axios.post('/send-guest-message', {
                    name: $('#guest-name').val(),
                    email: $('#guest-email').val(),
                    subject: $('#guest-subject').val(),
                    message: $('#guest-message').val(),
                })
                .then(function(response) {
                    console.log(response);
                })
                .catch(function(error) {
                    console.log(error);
                });
        });
</script>
@endpush