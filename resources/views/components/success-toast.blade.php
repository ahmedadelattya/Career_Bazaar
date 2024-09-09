<div>
    @props(['message'])

    @if ($message)
        <ul id="success-toast-container"
            class="absolute top-48 left-1/2 -translate-x-1/2 text-sm text-green-800 dark:text-green-400 space-y-1">
            <li id="success-toast-message"
                class="relative max-w-sm min-w-80 flex justify-between items-center gap-4 overflow-hidden py-2 px-3 bg-green-200 dark:bg-green-800 rounded-md">
                {{ $message }}
                <button type="button"
                    class="bg-green-50 text-green-800 hover:text-green-900 rounded-lg focus:ring-2 focus:ring-green-300 p-1.5 hover:bg-green-100 inline-flex items-center justify-center h-8 w-8 dark:text-green-500 dark:hover:text-white dark:bg-green-800 dark:hover:bg-green-700"
                    data-dismiss-target="#success-toast-message" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
                <span class="progress-bar absolute bottom-0 left-0 h-1 w-full bg-green-800 dark:bg-green-400"></span>
            </li>
        </ul>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const successToastContainer = document.getElementById('success-toast-container');
                const successProgressBar = document.querySelector('#success-toast-message .progress-bar');
                const successTimer = 8000;

                successProgressBar.style.transition = `width ${successTimer}ms linear`;
                successProgressBar.style.width = '0';

                setTimeout(() => {
                    successToastContainer.style.display = 'none';
                }, successTimer);
            });
        </script>
    @endif

</div>