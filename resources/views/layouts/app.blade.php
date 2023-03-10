<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')
    @livewireScripts
    <script>
        function applyMask(event) {
            const input = event.target;
            const mask = input.dataset.mask;
            const value = input.value.replace(/\D/g, "");

            let maskedValue = "";
            let i = 0;

            for (const character of mask) {
                if (character === "#") {
                    if (value[i]) {
                        maskedValue += value[i];
                        i++;
                    } else {
                        break;
                    }
                } else {
                    maskedValue += character;
                }
            }

            input.value = maskedValue;
        }

        let inputs = document.querySelectorAll("input[data-mask]");

        inputs.forEach((input) => {
            input.addEventListener('keydown', function(event) {
                if (event.key === 'Delete' || event.key === 'Backspace') {
                    event.preventDefault();
                    this.value = '';
                }
            });
            input.addEventListener("input", applyMask);
        });

        document.querySelectorAll('.close').forEach(function(closeButton) {
            closeButton.addEventListener('click', function() {
                this.parentElement.remove();
            });
        });



    </script>

</body>

</html>
