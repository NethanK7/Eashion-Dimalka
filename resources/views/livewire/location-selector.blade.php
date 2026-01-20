<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
    <div class="relative group">
        <label for="province-select" class="block text-xs uppercase tracking-[0.2em] font-bold text-gray-400 mb-2 ml-1 group-focus-within:text-black transition-colors duration-300">Province</label>
        <div class="relative">
            <select wire:model.live="province" name="province" id="province-select" class="w-full bg-white border-b-2 border-gray-100 py-4 px-1 text-base focus:outline-none focus:border-black transition-all duration-300 appearance-none cursor-pointer text-gray-900">
                <option value="">Select Province</option>
                @foreach($provinces as $prov)
                    <option value="{{ $prov }}" wire:key="prov-{{ $prov }}">{{ $prov }}</option>
                @endforeach
            </select>
            <div class="absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none opacity-40">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </div>

    <div class="relative group">
        <label for="district-select" class="block text-xs uppercase tracking-[0.2em] font-bold text-gray-400 mb-2 ml-1 group-focus-within:text-black transition-colors duration-300">District</label>
        <div class="relative">
            <select wire:model="district" name="district" id="district-select" class="w-full bg-white border-b-2 border-gray-100 py-4 px-1 text-base focus:outline-none focus:border-black transition-all duration-300 appearance-none cursor-pointer text-gray-900 {{ empty($districts) ? 'opacity-40 cursor-not-allowed' : '' }}" {{ empty($districts) ? 'disabled' : '' }}>
                <option value="">Select District</option>
                @foreach($districts as $dist)
                    <option value="{{ $dist }}" wire:key="dist-{{ $dist }}">{{ $dist }}</option>
                @endforeach
            </select>
            <div class="absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none opacity-40">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </div>
</div>