@extends('home.layouts.main')

@section('container')
<section class="container">
  <div class="row active-with-click">
      <div class="col-md-4 col-sm-6 col-xs-12">
          <article class="material-card Red">
              <h2>
                  <span>Christopher Walken</span>
                  <strong>
                      <i class="fa fa-fw fa-star"></i>
                      The Deer Hunter
                  </strong>
              </h2>
              <div class="mc-content">
                  <div class="img-container">
                      <img src="{{ asset('assets/img/sirkulasi/hp.png') }}" class="card-img-top" alt="...">
                      <!-- <img class="img-responsive" src="https://material-cards.s3-eu-west-1.amazonaws.com/thumb-christopher-walken.jpg"> -->
                  </div>
                  <div class="mc-description">
                      He has appeared in more than 100 films and television shows, including The Deer Hunter, Annie Hall, The Prophecy trilogy, The Dogs of War ...
                  </div>
              </div>
              <a class="mc-btn-action">
                  <i class="fa fa-bars"></i>
              </a>
              <div class="mc-footer">
                  <h4>
                      Social
                  </h4>
                  <a class="fa fa-fw fa-facebook"></a>
                  <a class="fa fa-fw fa-twitter"></a>
                  <a class="fa fa-fw fa-linkedin"></a>
                  <a class="fa fa-fw fa-google-plus"></a>
              </div>
          </article>
      </div>
  </div>
</section>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script>
    $(function() {
        $('.material-card > .mc-btn-action').click(function () {
            var card = $(this).parent('.material-card');
            var icon = $(this).children('i');
            icon.addClass('fa-spin-fast');

            if (card.hasClass('mc-active')) {
                card.removeClass('mc-active');

                window.setTimeout(function() {
                    icon
                        .removeClass('fa-arrow-left')
                        .removeClass('fa-spin-fast')
                        .addClass('fa-bars');

                }, 800);
            } else {
                card.addClass('mc-active');

                window.setTimeout(function() {
                    icon
                        .removeClass('fa-bars')
                        .removeClass('fa-spin-fast')
                        .addClass('fa-arrow-left');

                }, 800);
            }
        });
    });
</script>
@endsection