<div class="flex flex-col w-full max-w-7xl mx-auto gap-4 p-4">

    <!-- Container PDF/LJK - Ukuran proporsional, tidak full screen -->
    <div class="w-full bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden relative"
        style="height: 600px;">
        @if($url)
        @php
        $extension = pathinfo($url, PATHINFO_EXTENSION);
        @endphp

        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
        <div class="w-full h-full flex items-center justify-center overflow-auto p-4 bg-gray-50">
            <img src="{{ $url }}" alt="Preview" class="max-w-full max-h-full w-auto h-auto object-contain rounded shadow-sm">
        </div>
        @elseif(strtolower($extension) === 'pdf')
        <iframe
            src="{{ $url }}#toolbar=0&navpanes=0&scrollbar=1&view=FitH"
            class="w-full h-full"
            style="border: none; width: 100%; height: 100%;"
            frameborder="0"
            allowfullscreen></iframe>
        @else
        <div class="flex flex-col items-center justify-center h-full p-8 text-center bg-gray-50">
            <p class="text-gray-500 mb-3">File tidak dapat dipreview.</p>
            <a href="{{ $url }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-500 transition-colors text-sm">
                Download File
            </a>
        </div>
        @endif
        @else
        <div class="flex flex-col items-center justify-center h-full text-gray-400 italic bg-gray-50">
            <p>Tidak ada file yang diunggah.</p>
        </div>
        @endif
    </div>

    <!-- Section Catatan - Dengan ukuran fixed dan scroll -->
    @if($notes)
    <div class="w-full bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="border-b border-gray-200 bg-gray-50 px-4 py-3">
            <h3 class="font-medium text-gray-900 text-sm">
                Catatan / Jawaban
                <span class="text-xs text-gray-500 ml-2">({{ str_word_count(strip_tags($notes)) }} kata)</span>
            </h3>
        </div>
        <div class="p-4 max-h-[200px] overflow-y-auto bg-white">
            <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                {!! $notes !!}
            </div>
        </div>
    </div>
    @else
    <!-- Empty state untuk catatan -->
    <div class="w-full bg-gray-50 rounded-xl border border-gray-200 border-dashed p-6 text-center">
        <div class="flex flex-col items-center justify-center text-gray-400">
            <p class="text-sm">Belum ada catatan atau jawaban untuk LJK ini.</p>
        </div>
    </div>
    @endif

    <!-- Metadata LJK -->
    <div class="flex-shrink-0 flex justify-between items-center text-xs text-gray-500 pt-2 border-t border-gray-100">
        <div class="flex items-center gap-4">
            <span>Format: {{ strtoupper($extension ?? '-') }}</span>
            <span>Ukuran: 600px</span>
        </div>
        <span>{{ now()->format('d M Y H:i') }}</span>
    </div>
</div>