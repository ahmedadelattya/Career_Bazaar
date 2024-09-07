@props(['messages'])

@if ($messages)
    <ul id="message-container" {{ $attributes->merge(['class' => 'absolute top-4 left-1/2 -translate-x-1/2 text-sm text-indigo-800 dark:text-indigo-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li id="toast-message-{{ $loop->iteration }}"
                class="{{"relative max-w-sm min-w-80 flex justify-between items-center gap-4 overflow-hidden py-2 px-3 bg-zinc-200 dark:bg-zinc-800 rounded-md mt-" . ceil($loop->iteration * 4)}}">
                {{ $message }}
                <button type="button"
                    class="  bg-indigo-50 text-indigo-800 hover:text-indigo-900 rounded-lg focus:ring-2 focus:ring-indigo-300 p-1.5 hover:bg-indigo-100 inline-flex items-center justify-center h-8 w-8 dark:text-indigo-500 dark:hover:text-white dark:bg-zinc-800 dark:hover:bg-zinc-700"
                    data-dismiss-target="#toast-message-{{ $loop->iteration }}" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
                <span class="progress-bar absolute bottom-0 left-0 h-1 w-full bg-indigo-800 dark:bg-indigo-400"></span>
            </li>
        @endforeach
    </ul>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const messageContainer = document.getElementById('message-container');
            const progressBars = document.querySelectorAll('.progress-bar');
            const timer = 8000;
            progressBars.forEach(progressBar => {
                progressBar.style.transition = `width ${timer}ms linear`;
                progressBar.style.width = '0';

                setTimeout(() => {
                    messageContainer.style.display = 'none';
                }, timer);
            });
        });
    </script>
@endif
