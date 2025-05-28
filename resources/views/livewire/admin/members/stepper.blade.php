<div class="flex items-center justify-center max-w-4xl mx-auto">
    @php
        $steps = [
            1 => ['title' => 'Basic Info'],
            2 => ['title' => 'Programs'],
            3 => ['title' => 'Credentials'],
            4 => ['title' => 'Overview'],
        ];
    @endphp

    @foreach ($steps as $stepNumber => $step)
        <div class="flex items-center">
            {{-- Step Container --}}
            <div class="flex flex-col items-center text-center">
                {{-- Step Circle --}}
                <div class="flex-shrink-0 mb-2">
                    @if ($currentStep > $stepNumber)
                        {{-- Completed Step --}}
                        <div
                            class="w-6 h-6 bg-green-100 border border-green-500 rounded-full flex items-center justify-center shadow-lg">
                            <flux:icon.check class="w-3 h-3 text-green-500" />
                        </div>
                    @elseif($currentStep == $stepNumber)
                        {{-- Current Step --}}
                        <div
                            class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center shadow-lg ring-4 ring-blue-200">
                            <span class="text-white font-bold text-xs">{{ $stepNumber }}</span>
                        </div>
                    @else
                        {{-- Future Step --}}
                        <div class="w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center">
                            <span class="text-gray-600 font-semibold text-xs">{{ $stepNumber }}</span>
                        </div>
                    @endif
                </div>

                {{-- Step Content --}}
                <div class="min-w-0 max-w-16">
                    <flux:heading size="sm"
                        class="mb-1 {{ $currentStep >= $stepNumber ? 'text-gray-900' : 'text-gray-500' }}">
                        {{ $step['title'] }}
                    </flux:heading>
                </div>
            </div>

            {{-- Connector Line --}}
            @if (!$loop->last)
                <div class="flex items-center mx-4 mb-8">
                    <div
                        class="h-px w-8 {{ $currentStep > $stepNumber ? 'bg-green-500' : 'bg-gray-300' }} transition-colors duration-300">
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>
