@extends('layouts.layouts')

@section('content')
<style>
url('https://fonts.googleapis.com/css?family=Roboto&display=swap');

.counters {
background: #0f479a;
color: #fff;
padding: 40px 20px;
border-top: 3px lightskyblue solid;
}

.counters .container {
display: grid;
grid-template-columns: repeat(4, 1fr);
grid-gap: 30px;
text-align: center;
}

.counters i {
color: lightskyblue;
margin-bottom: 5px;
}

.counters .counter {
font-size: 45px;
margin: 10px 0;
}

@media (max-width: 700px) {
.counters .container {
  grid-template-columns: repeat(2, 1fr);
}

.counters .container > div:nth-of-type(1),
.counters .container > div:nth-of-type(2) {
  border-bottom: 1px lightskyblue solid;
  padding-bottom: 20px;
}
}

        .on-scroll-fade {
            opacity: 0;
            transition: opacity 0.6s ease-in;
        }

        .on-scroll-fade.appear {
            opacity: 1;
        }

</style>
<section class="spotlight C-parallax bg-cover bg-size--cover" data-spotlight="fullscreen">
    <span class="mask bg-tertiary alpha-5"></span>
    <div class="spotlight-holder py-lg pt-lg-xl">
        <div class="container d-flex align-items-center no-padding">
            <div class="col">
                <div class="row cols-xs-space align-items-center text-center text-md-left justify-content-start">
                    <div class="col-7">
                        <div class="text-left mt-5">
                          <img src="https://cdn.discordapp.com/attachments/530789778912837640/691801343723307068/1585008642050.png"
                              style="width: 200px;" class="img-fluid animated" data-animation-in="jackInTheBox"
                              data-animation-delay="1000">

                            <!-- <h2 class="heading display-4 font-weight-400 text-white mt-5 animated" data-animation-in="fadeInUp" data-animation-delay="2000">
                <span class="font-weight-700">812</span> hungry mouths fed today
              </h2> -->
                            <h4 class="lead text-white mt-3 lh-180 c-white animated" data-animation-in="fadeInUp"
                                data-animation-delay="2500">
                                <span style="font-size: 3rem;">Our Mission</span> <br />
                                "Our Mission aims at a #HungerFreeIndia"
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-xl bg-lighter">
        <div class="container">
        <center>
              <h3>We believe that no human should go to sleep with an empty stomach, <br>
              And we've taken this as our mission.</h3><br>
              <h3>At  <strong>feed</strong>ThePoor we constantly strive to make this dream of our's come true.</h3>
            </center>
        </div>
        </section>
<section class="py-sm bg-lightest">
  <center>
    <h3>Why not let we our stats do the talking?</h3>
  </center>
</section>  <!--
<section class="py-xl bg-lightest">
  <center>
    <h1 style="font-size: 100px;">450+</h1>
    <h4>Families being fed through our mission</h4>
    <br><br><br><br><br><br>
    <h1 style="font-size: 100px;">50+</h1>
    <h4>Villages are benefitted by our mission</h4>
  </center>
</section>  -->
<section class="counters py-xl">

        <center>
				<div>
				<h1 class="counter on-scroll-fade" style="font-size: 100px;" data-target="15000">0</h1>
				<h4>Children being fed through our mission</h4>
				</div>
        <br>
      </center>

        <center>
				<div>
          <h1 class="counter on-scroll-fade" style="font-size: 100px;" data-target="5000">0</h1>
          <h4>Families are benefitted by our mission</h4>
				</div>
        <br>
      </center>

        <center>
				<div>
          <h1 class="counter on-scroll-fade" style="font-size: 100px;" data-target="60000">0</h1>
					<h3>Likes</h3>
				</div>
        <br>
      </center>

        <center>
				<div>
          <h1 class="counter on-scroll-fade" style="font-size: 100px;" data-target="60000">0</h1>
					<h3>Connections</h3>
				</div>
      </center>

		</section>

    <script type="text/javascript">
    function startCounter(num){
        const counters = document.querySelectorAll('.counter');
        const speed = 180; // The lower the slower


        const updateCount = () => {
          const target = + counters[num].getAttribute('data-target');
          const count = + counters[num].innerText;

          // Lower inc to slow and higher to slow
          const inc = Math.floor(target/speed);
         // console.log(inc);
          // console.log(count);

          // Check if target is reached
          if (count < target) {
            // Add inc to count and output in counter
            counters[num].innerText = count + inc;
            // Call function every ms
            setTimeout(updateCount, 1);
          } else {
            counters[num].innerText = target;
          }
        };

        updateCount();

    }

    const faders = document.querySelectorAll(".on-scroll-fade");

    const appearOptions = {
        threshold: 0.3,
    };

    var num = 0;

    const appearOnScroll = new IntersectionObserver(function (
        entries,
        appearOnScroll
    ) {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                return;
            } else {
                entry.target.classList.add("appear");
                startCounter(num++);
                appearOnScroll.unobserve(entry.target);
            }
        });
    }, appearOptions);

    faders.forEach(fader => {
        appearOnScroll.observe(fader);
    });

    </script>
@endsection
