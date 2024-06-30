<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Budaya Internet</title>
</head>
<body>
    {{-- Header --}}
    <header class="w-screen h-24 bg-artidari-space-cadet">
        <div class="flex">
            {{-- Logo --}}
            <div class="w-1/3 flex justify-center pt-2">
                <a href="/">
                    <img class="h-10" src="{{asset('images/logo-white.png')}}" alt="">
                </a>
            </div>
            {{-- Search --}}
            <div class="w-1/3 pt-4">
                <form action="/search">
                    <div class="flex">
                            <input
                            type="text"
                            name="search"
                            placeholder="Cari arti kata..."
                            class="text-base rounded-l-lg w-full pl-2 py-1"
                            />
                            <div class="bg-white pr-2 rounded-r-lg">
                                <button type="submit">
                                    <img class="h-4 mt-2" src="{{asset('images/search.png')}}" alt="">
                                </button>
                            </div>
                    </div>
                </form>
            </div>
            {{-- add and logout --}}
            <div class="w-1/3 pt-4 flex justify-between items-center">
                <div class="flex items-center">
                    <a href="/kata/create" class="ml-2">
                        <img class="h-8" src="{{asset('images/add.png')}}" alt="">
                    </a>
                </div>
                <div class="flex items-center">
                    <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="bg-artidari-celestial-blue py-1 px-2 mr-20 rounded-md text-sm text-white">
                        Logout
                    </button>
                    </form>
                </div>
            </div>
        </div>
        {{-- Navigation --}}
        <div class="flex justify-center gap-x-5 mt-5 text-white text-sm">
            <div>
                <a href="/istilah">Istilah Regional</a>
            </div>
            <div>
                <a href="/budaya" class="border-b-2 border-white">Budaya Internet</a>
            </div>
            <div>
                <a href="/teknologi">Teknologi dan Gadget</a>
            </div>
            <div>
                <a href="/akronim">Akronim</a>
            </div>
        </div>
    </header>

    {{-- Hero --}}
    <div class="w-screen h-48 bg-white pt-14">
        <div class="flex justify-center">
            <p class="text-3xl font-semibold">BUDAYA INTERNET</p>
        </div>
        <div class="flex justify-center mx-52">
            <p class="text-sm text-center">Budaya internet di dunia maya, ada bahasa tersendiri yang mungkin bikin kamu bertanya-tanya, “Ini maksudnya apa, sih?” Selamat datang di Budaya Internet, tempat meme jadi bahasa, dan emoji lebih kuat dari kata-kata. Di sini, ‘LOL’ bukan sekadar tawa, dan ‘ghosting’ bukan tentang hantu. Ini adalah evolusi komunikasi di era digital, tempat setiap hari ada saja istilah baru yang muncul dan viral.</p>
        </div>
    </div>
    
    {{-- Main Content --}}
    <div class="w-screen bg-artidari-alabaster py-10">

        <div class="flex justify-center">
            <div class="w-[46rem]">
                <p class="text-xl font-normal">ISTILAH BUDAYA INTERNET POPULER</p>
            </div>
        </div>
            
        {{-- Istilah Regional --}}
        @if($kataBudaya && $kataBudaya->isNotEmpty())
            @foreach($kataBudaya as $kata)
                <x-card :kata="$kata" />
            @endforeach
        @else
            <div class="flex justify-center py-20 ">
                <div class="bg-white w-[46rem] border-4 rounded-xl border-black py-8 px-10">
                    <p class="font-medium text-3xl text-artidari-celestial-blue my-1">Tidak ada Istilah Budaya Internet</p>
                </div>
            </div>
        @endif

    </div>

    {{-- Footer --}}
    <footer class="w-screen h-48 bg-artidari-space-cadet">
        <div class="flex justify-center pt-8">
            <img class="h-[4.5rem]" src="{{asset('images/logo-white.png')}}" alt="">
        </div>
        <div class="flex justify-center pt-8">
            <p class="text-white text-sm">&copy artidari 2024</p>
        </div>
    </footer>
    <script>
        function like(kataId, userId) {
            fetch(`/kata/like/${kataId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    userId: userId
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                document.getElementById(`like-count-${kataId}`).innerText = data.likes;
                document.getElementById(`dislike-count-${kataId}`).innerText = data.dislikes;
            });
        }

        function dislike(kataId, userId) {
            fetch(`/kata/dislike/${kataId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    userId: userId
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById(`dislike-count-${kataId}`).innerText = data.dislikes;
                document.getElementById(`like-count-${kataId}`).innerText = data.likes;
            });
        }
    </script>
</body>
</html>