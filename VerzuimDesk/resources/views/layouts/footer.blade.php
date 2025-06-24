<footer class="bg-white dark:bg-gray-900 py-8 w-full inset-x-0 bottom-0">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <h3 class="text-gray-600 dark:text-gray-100 text-lg font-semibold mb-4">Portaal</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit veniam animi officia aperiam. Excepturi quisquam cupiditate similique, sapiente, veritatis, illum tempora exercitationem eius consequatur error eos facere nobis sed fugit.</p>
            </div>
            <div>
                <h3 class="text-gray-600 dark:text-gray-100 text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="text-gray-600 dark:text-gray-300 text-sm">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/') }}">Over ons</a></li>
                    <li><a href="{{ url('/') }}">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4 text-gray-600 dark:text-gray-100">Neem Contact op</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">123 Main Street<br>Springfield, IL 62701<br>Phone:
                    (555) 555-5555
                </p>
            </div>
        </div>
        <div class="text-center mt-8 text-gray-600 dark:text-gray-100">
            <p>&copy; {{ date('Y') }} Portaal. Alle rechten voorbehouden.</p>
        </div>
    </div>
</footer>
