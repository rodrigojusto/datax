<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
<div class="py-12">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Demandas STS
        </h2>
    </x-slot>

    <div x-show="open" @click.away="open = false" id="create-demand">
        @livewire('demand.create')
    </div>

    <div class="py-12">
        <div x-data="{ open: false}" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-actions-content>
                    <x-button @click="open = true" class="rounded bg-teal-600 text-teal-950 text-center font-bold hover:bg-teal-700">
                        Nova
                    </x-button>
                </x-actions-content>
                <x-content>
                    Local onde as demandas serão visualizadas
                </x-content>

            </div>
        </div>
    </div>
</div>
<script>
    // Carregue o componente Livewire na div específica
    Livewire.mount('demand.create');
</script>
