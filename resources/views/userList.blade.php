
@if(@count($users) > 0)
@foreach($users as $user)
<div class="container my-5 lightgallery" style="background: #e2e2e2;border-radius: 20px;box-shadow: 0px 0px 20px 0px #000000;">
            <div class="row">
                <div class="col-lg-4 p-0">
                <!-- <img class="w-100 shadow" src="https://via.placeholder.com/824x552" /> -->
                <div class="card" style="
                border-radius: 20px;
            ">
            <!-- Carousel -->
            <div id="carouselExample1{{$user->id}}" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" style="border-radius: 20px;box-shadow: 0px 0px 10px 0px #645a5a;">

                @foreach($user->images as $key => $image)
                    <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                        <img src="{{url($image->image_path)}}" class="d-block w-100"  data-src="{{url($image->image_path)}}" style='height:400px;border-radius:20px'> 
                    </div>
                    @endforeach
                </div>
                <!-- Controls -->
                <a class="carousel-control-prev" href="#carouselExample1{{$user->id}}" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample1{{$user->id}}" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- End Carousel -->
        </div>
    </div>
                <div class="col-lg-8" style='height:400px;overflow: auto;'>
                <div class="p-5 mt-4">
                    <h1 class="display-4">{{$user->name}}</h1>
                    <p class="lead">{{$user->description}}</p>
                    <div class="icon-links">
                    <a href="tel:+{{$user->mobile}}" class="btn btn-outline-info">
                        <i class="fa fa-phone"></i> Call
                    </a>
                    <a href="https://api.whatsapp.com/send?phone={{$user->mobile}}" class="btn btn-outline-success">
                    <i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp
                    </a>
                </div>
                </div>
                </div>
</div>
</div>

@endforeach



@else
<div class="text-center text-white mt-5 display-4">No data found!</div>
@endif

    <script>
    $(document).ready(function() {
        // Initialize lightGallery on the container with all images
        $('.lightgallery').lightGallery({
            selector: 'img', // Initialize lightGallery for all images within the container
            thumbnail: false, // Enable thumbnails
            download: false, // Disable download button
            zoom: true, // Enable zoom
            share: false
        });
         // Disable the auto-slide on the carousel
         $('#carouselExample1').carousel({
                interval: false // Setting the interval to false disables auto-slide
            });
  
    });
</script> 
        