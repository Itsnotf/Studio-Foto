@extends('layouts.userapp')
@section('content')
    <div class="mx-28">
        <div class="w-full bg-orange-900 p-10 rounded-xl mb-5">
            <img src="{{asset('assets/img/hero.png')}}"
                alt="" class="object-cover h-64 rounded-lg w-full">
        </div>
        <div class="flex flex-row gap-2 items-center">
            <h1 class="text-2xl font-normal text-gray-700 py-4">Product</h1>
        </div>
        <hr>
        <div
            class="w-auto p-10 flex gap-10  items-center overflow-x-auto scrollbar-thin scrollbar-thumb-gray-600 scrollbar-thumb-rounded-full scrollbar-track-transparent">
            @foreach ($products as $item)
                <div id="{{ $item->id }}"
                    class="product-div shadow-md hover:shadow-lg hover:shadow-orange-200 cursor-pointer hover:scale-105 transition-all px-10 w-56 h-20 flex justify-center items-center rounded-lg">
                    <p class="text-center">{{ $item->title }}</p>
                </div>
            @endforeach
        </div>
        <section class="pb-10">
            <div class="flex flex-row gap-2 items-center">
                <h1 class="text-2xl font-normal text-gray-700 py-4">Paket</h1>
            </div>
            <hr class="py-3">
            <div id="paket-container" class="flex flex-wrap justify-start gap-24">
                @foreach ($pakets as $item)
                    <div class="paket h-80 w-60 transition-all hover:scale-105 shadow-md hover:shadow-lg hover:shadow-orange-200 rounded-lg">
                        <div class="h-[60%] border">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="object-cover w-full h-full">
                        </div>
                        <div class="px-3">
                            <div class="mb-5 h-14 overflow-hidden">
                                <p class="py-3 line-clamp">{{ $item->desc }}</p>
                            </div>
                            <div class="flex flex-row items-center justify-between gap-2">
                                <h1 class="font-semibold text-xl text-orange-500">{{formatRupiah($item->price) }}</h1>

                                <a href="{{ route('detail', ['productid' => $item->product_id, 'paketId' => $item->id]) }}">
                                    <button
                                        class="outline-none hover:outline-none shadow-md w-10 h-10 hover:text-orange-500 hover:scale-110 rounded-full flex justify-center items-center">
                                        <i class="fa-solid fa-shop"></i>
                                    </button>
                                </a>


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const productDivs = document.querySelectorAll('.product-div');

            productDivs.forEach(div => {
                div.addEventListener('click', (event) => {
                    const productId = event.currentTarget.id;
                    console.log(productId);

                    // Make an AJAX request to fetch the related pakets
                    fetch(`/pakets/${productId}`)
                        .then(response => response.json())
                        .then(data => {
                            const paketContainer = document.getElementById('paket-container');
                            paketContainer.innerHTML = ''; // Clear existing pakets

                            data.forEach(paket => {
                                const paketDiv = `
                                <div class="paket h-80 w-60 transition-all hover:scale-105 shadow-md rounded-lg">
                                    <div class="h-[60%] border">
                                        <img src="${paket.image}" alt="${paket.title}" class="object-cover w-full h-full">
                                    </div>
                                    <div class="px-3">
                                        <div class="mb-5 h-14 overflow-hidden">
                                            <p class="py-3 line-clamp">${paket.desc}</p>
                                        </div>
                                        <div class="flex flex-row items-center justify-between gap-2">
                                            <h1 class="font-semibold text-xl text-orange-500">Rp ${paket.price}</h1>
                                            <form action="" method="POST">
                                                @csrf
                                                <button type="submit" class="outline-none hover:outline-none shadow-md w-10 h-10 hover:text-orange-500 hover:scale-110 rounded-full flex justify-center items-center">
                                                    <i class="fa-solid fa-shop"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            `;
                                paketContainer.insertAdjacentHTML('beforeend',
                                    paketDiv);
                            });
                        })
                        .catch(error => console.error('Error fetching pakets:', error));
                });
            });
        });
    </script>
@endsection
