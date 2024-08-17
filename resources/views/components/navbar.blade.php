<nav id="Navbar" class="max-w-[1130px] mx-auto flex justify-between items-center mt-[30px]">
    <a href="{{ route('front.index') }}">
        <div class="flex shrink-0">
            <img src="{{ asset('assets/images/logos/logo.svg') }}" alt="Maga Logo" />
        </div>
    </a>
    <div class="flex items-center gap-3">
        <a href=""
            class="rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 ring-1 ring-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18]">Upgrade
            Pro</a>
        <a href=""
            class="rounded-full p-[12px_22px] flex gap-[10px] font-bold transition-all duration-300 bg-[#FF6B18] text-white hover:shadow-[0_10px_20px_0_#FF6B1880]">
            <div class="w-6 h-6 flex shrink-0">
                <img src="{{ asset('assets/images/icons/favorite-chart.svg') }}" alt="icon" />
            </div>
            <span>Post Ads</span>
        </a>
    </div>
</nav>
