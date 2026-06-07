<div class="fixed inset-0 z-[9999] flex w-screen h-screen bg-white">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif !important;
        }
        
        .fi-input-wrapper {
            border-radius: 9999px !important;
            overflow: hidden !important; 
        }

        input[type="email"], input[type="password"] {
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
        }

        input[type="checkbox"]:checked {
            background-color: #00008B !important;
            border-color: #00008B !important;
        }
    </style>

    <div class="hidden lg:block lg:w-1/2 relative h-full">
        <img src="{{ asset('img/loginpage.png') }}" alt="Background Login" class="absolute inset-0 w-full h-full object-cover">
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white h-full relative">
        <div class="w-full max-w-md space-y-6">
            
            <div class="flex justify-center mb-4">
                <img src="{{ asset('img/logopolban.png') }}" alt="Logo POLBAN" class="h-24 w-auto object-contain">
            </div>

            <h2 class="text-[28px] font-extrabold text-center text-black tracking-tight mb-8">
                Selamat Datang Kembali!
            </h2>

            <form wire:submit="authenticate" class="w-full">
                {{ $this->form }}

                <button type="submit" class="w-full bg-[#00008B] text-white py-3.5 px-4 rounded-full font-bold hover:bg-blue-800 transition shadow-md mt-6">
                    Masuk
                </button>
            </form>
            
        </div>
    </div>
</div>