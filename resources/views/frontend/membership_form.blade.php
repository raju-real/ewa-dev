@extends('frontend.layouts')
@section('content')
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact" >
      <div class="container" >

        <div class="section-title">
          <h2>Join With Us</h2>
          <p>Welcome message</p>
        </div>

        <div class="row custom-bg-img" >
            <div class="col-md-12">
                <form action="" class="needs-validation" novalidate >
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Full Name</label> {!! starSign() !!}
                            <input type="text" name="name" autocomplete="off" class="form-control max-length-input" placeholder="Full Name" maxlength="50" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Father Name</label> {!! starSign() !!}
                            <input type="text" name="father_name" autocomplete="off" class="form-control max-length-input" placeholder="Father Name" maxlength="50" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Mother Name</label> {!! starSign() !!}
                            <input type="text" name="mother_name" autocomplete="off" class="form-control max-length-input" placeholder="Mother Name" maxlength="50" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Date Of Birth</label> {!! starSign() !!}
                            <input type="text" id="date_of_birth" name="date_of_birth" autocomplete="off" class="form-control" placeholder="Date Of Birth" readonly required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Mobile</label> {!! starSign() !!}
                            <input type="text" name="mobile" autocomplete="off" class="form-control max-length-input" placeholder="Mobile" maxlength="15" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Email</label> {!! starSign() !!}
                            <input type="text" name="email" autocomplete="off" class="form-control max-length-input" placeholder="Email" maxlength="50" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-lg btn-info mt-3 col-4">Submit</button>
                    </div>
                </div>
            </form>
            </div>

        </div>

      </div>
    </section><!-- End Contact Section -->
@endsection

@push('js')
    <script>
    $('#date_of_birth').datepicker();
</script>
@endpush
