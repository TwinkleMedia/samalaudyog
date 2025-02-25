<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



<!-- Slick Slider  -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.slick-slider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>




<!-- --FFFF -->

<script>
        document.querySelectorAll('.faq-question').forEach(item => {
            item.addEventListener('click', () => {
                const answer = item.nextElementSibling;
                const isActive = item.classList.contains('active');

                // Close all open FAQs
                document.querySelectorAll('.faq-answer').forEach(answer => {
                    answer.style.display = 'none';
                });
                document.querySelectorAll('.faq-question').forEach(question => {
                    question.classList.remove('active');
                });

                // Open the clicked FAQ
                if (!isActive) {
                    answer.style.display = 'block';
                    item.classList.add('active');
                }
            });
        });
    </script>





<!--  -->

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
 document.addEventListener('DOMContentLoaded', function() {
  const swiper = new Swiper('.testimonial-slider', {
      slidesPerView: 1,  // Force single slide view
      spaceBetween: 30,
      loop: true,
      pagination: {
          el: '.swiper-pagination',
          clickable: true,
      },
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
      autoplay: {
          delay: 5000,
          disableOnInteraction: false,
      },
      // Disable any breakpoints to ensure only one slide shows
      breakpoints: {}
  });
});
</script>