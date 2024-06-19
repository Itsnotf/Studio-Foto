@extends('layouts.userapp')

@section('content')
    <div class="mx-28 flex-row flex gap-10">
        <div class="w-[40%] flex flex-col  items-center  rounded-lg shadow-xl">
            <div class="w-[15rem] h-[15rem] rounded-full border">
                <img src="https://th.bing.com/th/id/OIP.wRtvON_8JKRQghdROw5QvQHaHa?rs=1&pid=ImgDetMain" alt=""
                    class="object-cover w-full h-auto">
            </div>
            <div class="flex flex-col gap-3 py-8">
                <div
                    class="flex gap-2 items-start shadow-sm w-full text-gray-600 border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                    <label for="username">Name : </label>
                    <input type="text" value="{{ $user->name }}" class="bg-transparent" name="username"
                        autocomplete="off" disabled>
                </div>
                <div
                    class="flex gap-2 justify-start items-center shadow-sm w-full text-gray-600 border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                    <label for="Email">Email : </label>
                    <input type="text" value="{{ $user->email }}" name="username" autocomplete="off"
                        class="bg-transparent" disabled>
                </div>
                <div
                    class="flex gap-2 justify-center items-center w-full shadow-sm text-gray-600 border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                    <label for="username">Username : </label>
                    <input type="text" value="{{ $user->username }}" class="bg-transparent" name="username"
                        autocomplete="off" disabled>
                </div>
                <form class="px-5 py-2 text-center rounded-md bg-red-500 text-white" action="{{ route('logout') }}"
                    method="POST">
                    @csrf
                    <button type="submit" class="w-full"> Logout </button>
                </form>
            </div>
        </div>

        <div class="w-full flex flex-wrap gap-y-5 justify-between  h-[30rem] overflow-y-auto">
            @foreach ($transaksi as $item)
                <div class=" border w-[350px] h-[30rem] flex flex-col gap-2 rounded-xl justify-center">
                    <div class="mx-3 py-3 rounded-lg shadow-sm flex">
                        <span class="w-32 font-bold">No Handphone</span>
                        <span>{{ $item->telpon }}</span>
                    </div>
                    <div class="mx-3 py-3 rounded-lg shadow-sm flex">
                        <span class="w-32 font-bold">Product</span>
                        <span>{{ $item->product->title }}</span>
                    </div>
                    <div class="mx-3 py-3 rounded-lg shadow-sm flex">
                        <span class="w-32 font-bold">Paket</span>
                        <span>Rp {{ $item->paket->price }} -,</span>
                    </div>
                    <div class="mx-3 py-3 rounded-lg shadow-sm flex">
                        <span class="w-32 font-bold">Pembayaran</span>
                        <span>{{ $item->metode->wallet }}</span>
                    </div>
                    <div class="mx-3 py-3 rounded-lg shadow-sm flex">
                        <span class="w-32 font-bold">Status</span>
                        <span>{{ $item->status }}</span>
                    </div>
                    @if ($item->bukti_pembayaran !== null)
                        <div class="flex flex-col mx-3 gap-2">
                            <div class=" py-3 rounded-lg shadow-sm flex">
                                <span class="w-32 font-bold">Bukti </span>
                                <span>Ada</span>
                            </div>
                            <a href="https://wa.me/62895420984780?text=Hallo Admin Saya%0A{{$user->name}}%0AID Transaksi : {{ $item->id }}%0AProduct : {{ $item->product->title }}%0APaket : {{ $item->paket->price }}%0AMetode Pembayaran : {{ $item->metode->wallet }}%0A"
                                id="hubungi-admin-button" class="text-center border rounded-lg px-2 py-2 ">Hubungi
                                Admin</a>
                        </div>
                    @else
                        <div class="flex flex-col mx-3 ">
                            <div class=" py-3 rounded-lg shadow-sm flex">
                                <span class="w-32 font-bold">Bukti </span>
                                <span>Tidak ada bukti pembayaran</span>
                            </div>
                            <form class=" gap-2 flex flex-col" action="{{ route('updateBukti', $item->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file" id="file-upload-label"
                                        class=" flex  items-center justify-center w-full h-30 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold"
                                                id="file-upload-text">Click
                                                to upload</span> Bukti Pembayaran</p>


                                        <input id="dropzone-file" name="bukti_pembayaran"
                                            value="{{ $item->bukti_pembayaran }}" type="file" class="hidden"
                                            onchange="updateFileName(this)" />
                                        <input type="text" class="hidden" value="{{ $item->bukti_pembayaran }}">
                                    </label>
                                </div>
                                <button type="submit" id="save-button" class="border rounded-lg px-2 py-2">Save</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
