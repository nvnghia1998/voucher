<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/home.css') }}">
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-4 my-4">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        
    <section class="container" style="background-color: #dadde6;"> 
        <div class="row">
            <div class="col-3">col-8</div>
            <div class="col-9">
                <div class="filter">
                    <div class="grid">
                        <div class='row'>
                            <div class='col-12 col-sm-12 col-md-6 col-lg-6  small--text-center collection-sorting grid__item medium-up--two-thirds mt-3'>
                                <div class="collection-sorting__dropdown">
                                    <form id="filter"  method="POST">
                                        {{ csrf_field() }}
                                        <label for="SortBy" class="label--hidden" >Category</label>
                                        <select name="category_id" id="SortBy" data-cate-id=''>
                                            @if ($cates)
                                                @foreach ($cates as $cate)
                                                    <option value="{{$cate->category_id}}">{{$cate->name}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </form>
                                  </div>
                                
                            </div>
                            <div class='col-12 col-sm-12 col-md-6 col-lg-6  small--text-center collection-sorting grid__item medium-up--two-thirds mt-3'>
                                <div class="collection-sorting__dropdown">
                                    <label for="itemsOnPage" class="label--hidden" >Limmit</label>
                                    <select name="itemsOnPage" id="itemsOnPage">
                                          <option value="8">8 sản phẩm</option>
                                          <option value="12">12 sản phẩm</option>
                                          <option value="16">16 sản phẩm</option>
                                          <option value="25">25 sản phẩm</option>
                                    </select>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-voucher">
                    @if($posts)
                    @foreach ($posts as $post)
                        <article class="card fl-left mb-3 " >
                            <section class="date">
                            <time datetime="23th feb">
                                <span>23</span><span>feb</span>
                            </time>
                            </section>
                            <section class="card-cont">
                            <small>dj khaled</small>
                            <h3>{{$post->title}}</h3>
                            <div class="even-date">
                                <i class="fa fa-calendar"></i>
                                <time>
                                <span>wednesday 28 december 2014</span>
                                <span>08:55pm to 12:00 am</span>
                                </time>
                            </div>
                            <div class="even-info">
                                <i class="fa fa-map-marker"></i>
                                <p>
                                    {{$post->detail}}
                                </p>
                            </div>
                            <div class="view">
                                {{ $post->view_count }} <i class="fa fa-eye" aria-hidden="true"></i>
                            </div>
                            
                            <a href="posts/{{$post->post_id}}">tickets</a>
                            </section>
                        </article>
                    @endforeach
                       
                    @else

                    @endif
                </div>
            </div>
          </div>
    </section>
        
           
              
            
        {{-- <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer> --}}
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/brands.min.css"></script>

<script>
$(document).ready(function(){
    $('#SortBy').change(function (){
        var form = $('#filter');
        $.ajax({
            url: "posts",
            type: 'post',
            dataType: 'html',
            data: form.serialize(),
            async: true,
            beforeSend:function (){
                $(".loading-icon").fadeIn('fast');
            },
            success: function(data) {
                if (data) {
                    $html = $(data).find('.list-voucher')
		        $('.list-voucher').replaceWith($html);
                }
            },
            errors: function(){
                alert('Yêu cầu của bạn không được đáp ứng');
            }
        });
    });
});


// function ajax(){
//     $.ajax({
//         url: '/filter_list_post',
//         type: 'post',
//         dataType: 'html',
//         data: ,
//         async: true,
//         beforeSend:function (){
//             $(".loading-icon").fadeIn('fast');
//         },
//         success: function(data) {

//         },
//         errors: function(){

//         }

//     });
// }
    



</script>

</body>
</html>