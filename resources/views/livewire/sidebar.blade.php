<div class="col-lg-3 mb-4">
    <h1 class="mt-4">Filters</h1>

    <h3 class="mt-2">Price</h3>
    @foreach($prices as $index => $price)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="price{{ $index }}" value="{{ $index }}" wire:model="selected.prices">
            <label class="form-check-label" for="price{{ $index }}">
                {{ $price['name'] }} ({{ $price['products_count'] }})
            </label>
        </div>
    @endforeach

    <h3 class="mt-2">Categories</h3>
    @foreach($categories as $index => $category)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="category{{ $index }}" value="{{ $category->id }}" wire:model="selected.categories">
            <label class="form-check-label" for="category{{ $index }}">
                {{ $category['name'] }} ({{ $category['products_count'] }})
            </label>
        </div>
    @endforeach

    <h3 class="mt-2">Manufacturers</h3>
    @foreach($manufacturers as $index => $manufacturer)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="manufacturer{{ $index }}" value="{{ $manufacturer->id }}" wire:model="selected.manufacturers">
            <label class="form-check-label" for="manufacturer{{ $index }}">
                {{ $manufacturer['name'] }} ({{ $manufacturer['products_count'] }})
            </label>
        </div>
    @endforeach
</div>