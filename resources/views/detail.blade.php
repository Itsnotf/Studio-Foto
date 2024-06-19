@extends('layouts.userapp')

@section('content')
    <div class="mx-28 overflow-hidden flex flex-row gap-10">
        <div class="w-[60%] h-[40rem] border overflow-hidden rounded-2xl">
            {{-- <img src="{{ $paket->image }}" alt="" class="object-cover w-auto h-full"> --}}
            <img src="{{ asset('storage/' . $paket->image) }}" alt="" class="object-cover w-full h-full">

        </div>
        <div class="w-full flex flex-col justify-center items-center gap-10">
            <div class="flex flex-col gap-10">
                <div class="flex flex-col gap-2 pb-10">
                    <h1 class="text-5xl font-semibold">{{ $paket->product->title }}</h1>
                    <h1 class="text-3xl">{{ formatRupiah($paket->price) }}</h1>
                </div>
                <ul>
                @foreach (explode('-', $paket->desc) as $desc)
                    @if (trim($desc) !== '-')
                        <li>{{ $desc }}</li>
                    @endif
                @endforeach
                </ul>
                <div class="flex flex-row gap-10">
                    <button id="orderButton" class="border p-4 text-orange-500  hover:text-white hover:bg-orange-500  rounded-lg transition-all ease-in duration-300 hover:duration-300">Pesan Sekarang</button>
                    <a href="/" class="border p-4 text-orange-500  hover:text-white hover:bg-orange-500  rounded-lg transition-all ease-in duration-300 hover:duration-300">Paket Lain</a>
                </div>
            </div>
        </div>
    </div>

    <div id="orderModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden justify-center items-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-1/2">
            <h2 class="text-2xl mb-4">Pesan Paket</h2>
            <div class="modal-body">
                <div class="flex flex-col gap-4">
                    <div>Metode Pembayaran</div>
                    <hr>
                    <form action="{{ route('transaksi', ['productid' => $paket->product_id, 'paketId' => $paket->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col gap-5">
                            <div class="flex gap-5">
                                @foreach ($mtd as $item)
                                    <button type="button"
                                        class="text-orange-500 border hover:text-white hover:bg-orange-500 w-20 h-10 rounded-lg transition-all ease-in duration-300 hover:duration-300"
                                        data-id="{{ $item->id }}" data-wallet="{{ $item->wallet }}"
                                        data-no-wallet="{{ $item->no_wallet }}" onclick="updateVirtualAccount(this)">
                                        {{ $item->wallet }}
                                    </button>
                                @endforeach
                            </div>
                            <div class="flex flex-col gap-5">
                                <div>
                                    <label for="no_wallet" class="block text-gray-600">Virtual Account</label>
                                    <input type="text" id="no_wallet" name="no_wallet"
                                        class="w-full border text-gray-600 border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                                        autocomplete="off" disabled>
                                    <!-- Hidden input field to store the selected ID -->
                                    <input type="hidden" id="wallet_id" name="mtd_pembayaran_id">
                                </div>
                                <div>
                                    <label for="telpon" class="block text-gray-600">No Handphone</label>
                                    <input type="number" id="telpon" name="telpon"
                                        class="w-full border text-gray-600 border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                                        autocomplete="on">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h1 class="text-gray-600">Bukti Pembayaran</h1>
                                    <div class="mb-3">
                                        <input
                                            class="relative m-0 block w-full min-w-0 flex-auto file:rounded rounded border border-solid border-orange-500 bg-clip-padding px-3 py-[0.32rem] text-base font-normal transition duration-300 ease-in-out file:-mx-4 file:-my-[0.32rem] file:overflow-hidden file:border-0 file:border-solid file:border-inherit file:bg-orange-500 file:py-[0.32rem] file:text-white file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem]"
                                            type="file" name="bukti_pembayaran" />
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="p-2 bg-white border text-orange-500">Check Out</button>
                                <button id="closeModal" class="mt-4 border p-2" type="button">Tutup</button>
                            </div>
                    </form>

                </div>
            </div>

            <script>
                document.getElementById('orderButton').addEventListener('click', function() {
                    document.getElementById('orderModal').classList.remove('hidden');
                    document.getElementById('orderModal').classList.add('flex');
                });

                document.getElementById('closeModal').addEventListener('click', function() {
                    document.getElementById('orderModal').classList.remove('flex');
                    document.getElementById('orderModal').classList.add('hidden');
                });

                function updateVirtualAccount(button) {
                    const walletId = button.getAttribute('data-id');
                    const noWallet = button.getAttribute('data-no-wallet');
                    document.getElementById('no_wallet').value = noWallet;
                    document.getElementById('wallet_id').value = walletId;
                }
            </script>
        </div>
    </div>
@endsection
