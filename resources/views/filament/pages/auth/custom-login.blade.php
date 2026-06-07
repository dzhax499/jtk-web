<div class="absolute inset-0 flex min-h-screen font-['Poppins'] z-50 bg-white">
    
    <div class="hidden lg:block lg:w-1/2 relative bg-[#00008B]">
        <img src="{{ asset('img/gedungh.png') }}" alt="Gedung H POLBAN" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay">
        <div class="absolute inset-0 bg-gradient-to-b from-[#00008B]/30 to-[#00008B]/90"></div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
        <div class="w-full max-w-md space-y-8">
            
            <div class="flex justify-center mb-2">
                <img src="{{ asset('img/logo-polban.png') }}" alt="Logo POLBAN" class="h-28 w-auto object-contain">
            </div>

            <h2 class="text-[28px] font-extrabold text-center text-black tracking-tight">
                Selamat Datang Kembali!
            </h2>

            <style>
                input[type="email"], input[type="password"] {
                    border-radius: 9999px !important;
                    padding-left: 1.25rem !important;
                }
            </style>

            <form wire:submit="authenticate" class="w-full">
                {{ $this->form }}

                <button type="submit" class="w-full bg-[#00008B] text-white py-3.5 px-4 rounded-full font-bold hover:bg-blue-800 transition shadow-md mt-4">
                    Masuk
                </button>
            </form>
            
        </div>
    </div>
</div>