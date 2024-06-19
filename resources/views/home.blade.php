@extends('layouts.userapp')

@section('content')
    <section class="mx-28 flex justify-center items-center h-[600px]">

        <div class="text-center">
            <h1 class="text-8xl font-bold text-orange-400">PHOTO <span class="text-blue-400">STUDIO</span></h1>
            <p class="text-2xl font-medium pt-2 text-blue-400 pb-10">We are expert Creating beautiful photographs</p>
            <a  href="/shop" class="rounded-full text-orange-600 duration-300 hover:duration-300 hover:bg-gradient-to-br hover:from-orange-500 hover:to-blue-500 hover:text-white px-12 py-4 text-lg font-semibold bg-gradient-to-br from-orange-200 to-blue-200 transition-all   cursor-pointer hover:transition-all ">Order Sekarang</a>

        </div>
        {{-- <div class="w-[50%]">
            <h1>Studio Header</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni excepturi fuga reprehenderit quo, veritatis delectus vero nam ipsam   </p>
            <button>Order Sekarang</button>
        </div>
        <div>
            <div class="w-[50%]">
                <img src="" alt="">
            </div>
        </div> --}}
    </section>
@endsection
