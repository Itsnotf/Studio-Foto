<style>
    li,
    a {
        text-decoration: none !important;
    }
</style>

<nav style='z-index: 9999;' class="py-3 border-b bg-white border-gray-100 fixed w-full">
    <div class="hidden md:flex flex-row items-center justify-between px-28 ">
        @if (Route::has('login'))
            <ul class="text-lg font-normal flex gap-5">
                @auth
                    <li class=" ease-in transition-all hover:text-orange-500 hover:scale-110">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class=" ease-in transition-all hover:text-orange-500 hover:scale-110">
                        <a href="{{ url('/shop') }}">Shop</a>
                    </li>
                @else
                    <li class="ease-in transition-all hover:text-orange-500 hover:scale-110">
                        <a href="{{ route('login') }}">Log in</a>
                    </li>

                    @if (Route::has('register'))
                        <li class="ease-in transition-all hover:text-orange-500 hover:scale-110">
                            <a href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @endauth
            </ul>

            @auth

                <div class="flex gap-4">
                    <a href="{{route('profiles')}}">
                        <div
                            class="shadow-md  w-10 h-10 ease-in transition-all hover:text-orange-500 hover:scale-110 rounded-full flex justify-center items-center">
                            <i class="fa-solid fa-user text-center scale-110 "></i>
                        </div>
                    </a>
                </div>
            @endauth
    </div>
    @endif
    <div class="md:hidden flex">
        <div class="flex flex-row mx-10 w-full items-center justify-between">
            <div class="text-2xl font-semibold text-orange-500">
                KERT
            </div>
            <div class="flex gap-4">
                <a href="">
                    <div id='toggleCart'
                        class="shadow-md w-10 h-10 ease-in transition-all hover:text-orange-500 hover:scale-110 rounded-full flex justify-center items-center">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </a>
                <a href="">
                    <div
                        class="shadow-md  w-10 h-10 ease-in transition-all hover:text-orange-500 hover:scale-110 rounded-full flex justify-center items-center">
                        <i class="fa-solid fa-user text-center  scale-110"></i>
                    </div>
                </a>
                <button id="toggleSidebar"
                    class="shadow-md ease-in transition-all hover:text-orange-500 hover:scale-110 w-10 h-10 rounded-full flex justify-center items-center">
                    <i class="fa-solid fa-bars "></i>
                </button>
            </div>
        </div>
    </div>

    <div id='sidebar'
        class="md:hidden absolute bg-white shadow-md -translate-x-full transition-all  ease-in-out font-normal text-lg  mt-4 w-full">
        <div class="flex flex-col mx-10 py-6">
            <ul class="flex flex-col gap-5">
                <div
                    class="w-full hover:text-orange-500 transition-all px-10 ease-in-out hover:ease-in-out hover:translate-x-3">
                    <li class="flex flex-col gap-2">
                        <a href="">Home</a>
                        <hr class="transition-all bg-orange-200 ease-in-out transform -translate-x-full ">
                    </li>
                </div>
                <div
                    class="home w-full hover:text-orange-500 transition-all px-10 ease-in-out hover:ease-in-out hover:translate-x-3">
                    <li class="flex flex-col gap-2">
                        <a href="">Shop</a>
                        <hr class="transition-all bg-orange-200 ease-in-out transform -translate-x-full ">
                    </li>
                </div>
                <div
                    class="home w-full hover:text-orange-500 transition-all px-10 ease-in-out hover:ease-in-out hover:translate-x-3">
                    <li class="flex flex-col gap-2">
                        <a href="">Contact</a>
                        <hr class="transition-all bg-orange-200 ease-in-out transform -translate-x-full ">
                    </li>
                </div>
                <div
                    class="home w-full hover:text-orange-500 transition-all px-10 ease-in-out hover:ease-in-out hover:translate-x-3">
                    <li class="flex flex-col gap-2">
                        <a href="">About Us</a>
                        <hr class="transition-all bg-orange-200 ease-in-out transform -translate-x-full ">
                    </li>
                </div>


            </ul>
        </div>
    </div>

    {{-- <div id='cart'
        class=" absolute right-0 translate-x-full shadow-lg px-10 py-2 rounded-l-lg bg-white   transition-all  ease-in-out font-normal text-lg  mt-4 ">
        <div class="mb-3">
            <h1 class="text-xl font-semibold text-orange-500">Your Cart</h1>
        </div>

        @foreach ($datas as $data)


            <div class="flex flex-row gap-4 mb-3 items-center justify-center shadow-md p-2 rounded-lg">
                <div class="w-14 shadow-inner p-2 rounded-md">
                    <img src="{{ asset('/'.$data->product->image) }}" alt="">
                </div>
                <div>
                    <h1>{{$data->product->name}}</h1>
                    <p class="text-base text-orange-500 font-light">{{$data->product->price}}</p>
                </div>
            </div>
            @endforeach

    </div> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let sidebar = document.getElementById("sidebar");
            let toggleSidebarButton = document.getElementById("toggleSidebar");

            toggleSidebarButton.addEventListener("click", function() {
                // Toggle the class when the button is clicked
                sidebar.classList.toggle("-translate-x-full");
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            let cart = document.getElementById("cart");
            let toggleCartButton = document.getElementById("toggleCart");

            toggleCartButton.addEventListener("mouseenter", function() {
                // Remove class on mouse enter
                cart.classList.remove("translate-x-full");
            });

            toggleCartButton.addEventListener("mouseleave", function() {
                // Add class on mouse leave
                cart.classList.add("translate-x-full");
            });
        });
    </script>


</nav>
