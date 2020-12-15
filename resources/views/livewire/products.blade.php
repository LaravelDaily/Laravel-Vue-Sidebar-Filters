<div class="col-lg-9">
    <div class="row mt-4">
        @foreach($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#">
                        <img class="card-img-top" src="http://placehold.it/700x400" alt="">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">{{ $product->name }}</a>
                        </h4>
                        <h5>$ {{ number_format($product->price / 100, 2) }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>