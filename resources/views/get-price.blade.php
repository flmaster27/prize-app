<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Поздравляем! Вы выиграли {{ $prize['amount'] }} {{ $prize['type'] }}!
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900">
                        Вернуться к списку
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
