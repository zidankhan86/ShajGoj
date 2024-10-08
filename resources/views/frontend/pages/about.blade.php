@extends('frontend.master')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4">About Us</h1>
        <p class="lead">Discover our journey and commitment to beauty.</p>
    </div>

    <div class="row mb-5">
        <div class="col-lg-6">
            <h2>Our Story</h2>
            <p>
                Founded in 2020, our brand has been dedicated to providing high-quality beauty products that enhance your natural beauty. We believe that beauty is not just about appearances but about feeling confident in your own skin.
            </p>
        </div>
       
    </div>

    <div class="row mb-5">
        <div class="col-lg-12">
            <h2>Our Mission</h2>
            <p>
                Our mission is to empower individuals through beauty. We strive to create products that inspire confidence and promote self-expression, ensuring everyone feels beautiful, inside and out.
            </p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-12">
            <h2>Our Values</h2>
            <ul>
                <li><strong>Quality:</strong> We use only the finest ingredients to ensure the highest quality products.</li>
                <li><strong>Integrity:</strong> We are committed to transparency and ethical practices in all our operations.</li>
                <li><strong>Innovation:</strong> We continuously strive to innovate and improve our products to meet our customers' needs.</li>
                <li><strong>Sustainability:</strong> We prioritize environmentally-friendly practices and sustainable sourcing.</li>
            </ul>
        </div>
    </div>

   

    <div class="text-center mb-5">
        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Contact Us</a>
    </div>
</div>
@endsection
