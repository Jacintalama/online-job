<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Online Job Application </title>
        <meta content="" name="description">
        <meta content="" name="keywords">


        <!-- Favicons -->
        <link href="assets/img/gsc.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> --}}

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Template Main CSS File -->
        <link href="assets/css/welcome.css" rel="stylesheet">
       <!-- Bootstrap CSS -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
       @vite(['resources/sass/app.css', 'resources/js/app.js'])
        <!-- Styles -->
<style>
            /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, sans-serif;font-feature-settings:normal}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::-webkit-backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.relative{position:relative}.mx-auto{margin-left:auto;margin-right:auto}.mx-6{margin-left:1.5rem;margin-right:1.5rem}.ml-4{margin-left:1rem}.mt-16{margin-top:4rem}.mt-6{margin-top:1.5rem}.mt-4{margin-top:1rem}.-mt-px{margin-top:-1px}.mr-1{margin-right:0.25rem}.flex{display:flex}.inline-flex{display:inline-flex}.grid{display:grid}.h-16{height:4rem}.h-7{height:1.75rem}.h-6{height:1.5rem}.h-5{height:1.25rem}.min-h-screen{min-height:100vh}.w-auto{width:auto}.w-16{width:4rem}.w-7{width:1.75rem}.w-6{width:1.5rem}.w-5{width:1.25rem}.max-w-7xl{max-width:80rem}.shrink-0{flex-shrink:0}.scale-100{--tw-scale-x:1;--tw-scale-y:1;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.items-center{align-items:center}.justify-center{justify-content:center}.gap-6{gap:1.5rem}.gap-4{gap:1rem}.self-center{align-self:center}.rounded-lg{border-radius:0.5rem}.rounded-full{border-radius:9999px}.bg-gray-100{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-red-50{--tw-bg-opacity:1;background-color:rgb(254 242 242 / var(--tw-bg-opacity))}.bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}.from-gray-700\/50{--tw-gradient-from:rgb(55 65 81 / 0.5);--tw-gradient-to:rgb(55 65 81 / 0);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-transparent{--tw-gradient-to:rgb(0 0 0 / 0);--tw-gradient-stops:var(--tw-gradient-from), transparent, var(--tw-gradient-to)}.bg-center{background-position:center}.stroke-red-500{stroke:#ef4444}.stroke-gray-400{stroke:#9ca3af}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.text-center{text-align:center}.text-right{text-align:right}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-sm{font-size:0.875rem;line-height:1.25rem}.font-semibold{font-weight:600}.leading-relaxed{line-height:1.625}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-2xl{--tw-shadow:0 25px 50px -12px rgb(0 0 0 / 0.25);--tw-shadow-colored:0 25px 50px -12px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-gray-500\/20{--tw-shadow-color:rgb(107 114 128 / 0.2);--tw-shadow:var(--tw-shadow-colored)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.selection\:bg-red-500 *::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-red-500::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-gray-900:hover{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.hover\:text-gray-700:hover{--tw-text-opacity:1;color:rgb(55 65 81 / var(--tw-text-opacity))}.focus\:rounded-sm:focus{border-radius:0.125rem}.focus\:outline:focus{outline-style:solid}.focus\:outline-2:focus{outline-width:2px}.focus\:outline-red-500:focus{outline-color:#ef4444}.group:hover .group-hover\:stroke-gray-600{stroke:#4b5563}.z-10{z-index: 10}@media (prefers-reduced-motion: no-preference){.motion-safe\:hover\:scale-\[1\.01\]:hover{--tw-scale-x:1.01;--tw-scale-y:1.01;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}}@media (prefers-color-scheme: dark){.dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:bg-gray-800\/50{background-color:rgb(31 41 55 / 0.5)}.dark\:bg-red-800\/20{background-color:rgb(153 27 27 / 0.2)}.dark\:bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}.dark\:bg-gradient-to-bl{background-image:linear-gradient(to bottom left, var(--tw-gradient-stops))}.dark\:stroke-gray-600{stroke:#4b5563}.dark\:text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:shadow-none{--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.dark\:ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.dark\:ring-inset{--tw-ring-inset:inset}.dark\:ring-white\/5{--tw-ring-color:rgb(255 255 255 / 0.05)}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.group:hover .dark\:group-hover\:stroke-gray-400{stroke:#9ca3af}}@media (min-width: 640px){.sm\:fixed{position:fixed}.sm\:top-0{top:0px}.sm\:right-0{right:0px}.sm\:ml-0{margin-left:0px}.sm\:flex{display:flex}.sm\:items-center{align-items:center}.sm\:justify-center{justify-content:center}.sm\:justify-between{justify-content:space-between}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width: 768px){.md\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}}@media (min-width: 1024px){.lg\:gap-8{gap:2rem}.lg\:p-8{padding:2rem}}
</style>
<style>
body {
    background-color: #333333;
}
    </style>
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@foreach($jobs as $job)
    @if(!$job->is_closed)
        <!-- Display the job -->
    @endif
@endforeach

    </head>
    <body  class="bg-gray-100 selection:bg-red-500 selection:text-white bg-gray-200">
        <nav class="bg-white p-4 shadow-md">
            <div class="container mx-auto flex justify-between items-center">
                <!-- This empty div helps to keep the navigation links in the center -->

                <ul class="flex space-x-4 items-center">
                     <!-- Logo -->
            <li>

                    <img src="{{ asset('assets/img/gsc.png') }}" alt="Logo" width="70px">

            </li>
            <li><a href="{{ url('/') }}" class="nav-link text-gray-800 py-2 px-4 active">Home</a></li>


                    <li><a href="#findjobs" class="nav-link find-jobs-link text-gray-800 py-2 px-4">Search Jobs</a></li>

                   <li><a href="#about" class="nav-link text-gray-800 py-2 px-4">About Us</a></li>



                </ul>
                <div class="flex text-sm">
                    <div class="text-right text-sm space-x-5">
                        <div class="text-right text-sm space-x-5">
                            @if (Route::has('login'))
                                @auth
                                    @if (Auth::check() && Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="text-gray-800 hover:text-gray-600 font-semibold link-hover-effect">
                                            <i class="fas fa-briefcase"></i> Dashboard
                                        </a>
                                    @elseif (Auth::check() && Auth::user()->role === 'department_head')
                                        <a href="{{ route('departmenthead.dashboard') }}" class="text-gray-800 hover:text-gray-600 font-semibold link-hover-effect">
                                            <i class="fas fa-briefcase"></i> Dashboard
                                        </a>
                                    @elseif (Auth::check() && Auth::user()->role === 'applicant')
                                        <a href="{{ route('applicant.dashboard') }}" class="text-gray-800 hover:text-gray-600 font-semibold link-hover-effect">
                                            <i class="fas fa-briefcase"></i> Dashboard
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="text-gray-800 hover:text-gray-600 font-semibold link-hover-effect">
                                        <i class="fas fa-sign-in-alt"></i> Log in
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-gray-800 hover:text-gray-600 font-semibold link-hover-effect">
                                            <i class="fas fa-user-plus"></i> Register
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </nav>
        <div class="mb-3">
            @csrf
            <form action="/searchJobs" method="get">
                <div class="row">
                    <div class="col-lg-10 mx-auto text-center">
                        <div class="search-bar-container">
                            <div class="input-group mb-3">
                                <!-- Label for Department -->
                                <div class="input-group-prepend">
                                    <span class="input-group-text">From</span>
                                </div>
                                <input type="text" class="form-control mr-5" name="department" placeholder="Search by department...">
                                <!-- Spacer using Bootstrap -->
                                <div class="input-group-prepend ml-3">
                                    <span class="input-group-text" style="visibility: hidden;">Hidden Text</span>
                                </div>
                                <!-- Label for Job Title/Keyword -->
                                <div class="input-group-prepend">
                                    <span class="input-group-text">What</span>
                                </div>
                                <input type="text" class="form-control mr-3" name="position_title" placeholder="Search by job title or keyword...">
                                <!-- Search Button -->
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary" style="height: 100%;">Find Jobs</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @php
        $displayJobs = session('jobs') ?? $jobs;
    @endphp

    @if($displayJobs->count())
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-4">

            <div class="col-span-full flex items-center justify-center mb-4">
                <div class="flex-1 border-b-2 border-gray-400"></div>
                <h1 class="text-2xl font-bold px-4">Featured Jobs</h1>
                <div class="flex-1 border-b-2 border-gray-400"></div>
            </div>

            @foreach($displayJobs as $job)
            <div class="relative bg-white p-4 rounded shadow-md animate__animated animate__fadeIn animate__slideInUp" style="animation-delay: {{ $loop->index * 0.5 }}s;">

                <!-- Bookmark Button -->
                <a href="{{ route('bookmark.toggle', $job) }}" class="absolute top-2 right-2 text-blue-500 no-underline text-sm">


                    <i class="{{ auth()->user() && auth()->user()->bookmarks->where('job_id', $job->id)->count() ? 'fas fa-bookmark' : 'far fa-bookmark' }}"></i>
                    {{ auth()->user() && auth()->user()->bookmarks->where('job_id', $job->id)->count() ? 'Bookmarked' : 'Bookmark' }}
                </a><br>


                <h2 class="text-xl font-bold mb-2">{{ $job->position_title }}</h2>
                <p class="text-sm text-gray-700 mb-2">
                    <strong>Department:</strong> {{ optional($job->department)->name ?? 'No department' }}
                </p>
                <p class="text-sm text-gray-700 mb-4"><strong>Eligibility:</strong>@if($job->eligibilities->isNotEmpty())
                    {{ $job->eligibilities->pluck('name')->implode('  ') }}
                @else
                    N/A
                @endif

                </p><hr>
                <p class="text-sm text-gray-700 mb-2"><strong>Monthly Salary:</strong> ₱{{$job->monthly_salary}}</p><br>
                <p class="text-sm text-gray-700 mb-2"><strong>Application Deadline:</strong> {{ $job->job_deadline }}</p>

                <div class="flex justify-between items-center">
                    <a href="{{ route('jobs.details', $job) }}" class="text-blue-500 no-underline text-sm">
                        <x-button>Apply Now</x-button>
                    </a>
                    <a href="#" class="text-blue-500 no-underline text-sm" data-toggle="modal" data-target="#jobDetailModal{{ $job->id }}">
                        <i class="fas fa-eye"></i> View Details
                    </a>
                </div>


            </div>
            @endforeach
            @foreach($displayJobs as $job)
<!-- Job Detail Modal -->
<div class="modal fade" id="jobDetailModal{{ $job->id }}" tabindex="-1" role="dialog" aria-labelledby="jobDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jobDetailModalLabel">{{ $job->position_title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your Job Details Here -->
                <h5>
                    <strong>Department: {{ optional($job->department)->name ?? 'No department' }}</strong>
                  </h5><br>

                <p>
                    <i class="fas fa-briefcase"></i> <!-- Font Awesome briefcase icon -->
                    <strong>Egibility:</strong>
                    @if($job->eligibilities->isNotEmpty())
                        {{ $job->eligibilities->pluck('name')->implode('  ') }}
                    @else
                        N/A
                    @endif
                </p><br>
                <p>
                    <i class="fas fa-briefcase"></i> <!-- Font Awesome briefcase icon -->
                    <strong>Job Type:</strong>
                    @if($job->jobTypes->isNotEmpty())
                        {{ $job->jobTypes->pluck('name')->implode(', ') }}
                    @else
                        N/A
                    @endif
                </p>

                <p>
                    <i class="fas fa-clock"></i> <!-- Font Awesome clock icon -->
                    <strong>Schedule:</strong>
                    @if($job->jobSchedules->isNotEmpty())
                        {{ $job->jobSchedules->pluck('name')->implode(', ') }}
                    @else
                        N/A
                    @endif
                </p>

                <hr>
                <p><strong>Monthly Salary:</strong> ₱{{$job->monthly_salary}}</p><br>
                <p><strong> Competency:</strong> {!! $job->competency !!}</p>
                <p><strong>Qualifications:</strong></p>
                <ul>
                    @foreach($job->qualifications->filter(function($qualification) {
                        return $qualification->type !== 'eligibility';
                    }) as $qualification)
                        <li>{{ $qualification->type }}: {{ $qualification->requirement }}</li>
                    @endforeach
                </ul>

                <p><strong>Specific Skills:</strong> {!! $job->training!!}</p><br><br>

                <p><strong>Gender Requirement:</strong> {{$job->gender_requirement}}</p>
                <p><strong>Contact Email:</strong>📧 {{ $job->contact_email }}</p><br>
                <p><strong>Contact Phone:</strong>📞 {{ $job->contact_phone }}</p><br><hr><br>
                <p><strong>Application Deadline:</strong> {{ $job->job_deadline }}</p>
                <p><strong>Start for Job:</strong> {{ $job->start_date_job}}</p>
            </div>
            <div class="modal-footer">
                <x-button type="button" class="btn btn-secondary" data-dismiss="modal">Close</x-button>
            </div>
        </div>
    </div>
</div>
@endforeach
        </div>
    </div>

    @elseif(session('searchPerformed'))
        <p class="text-center mt-5">No jobs found matching your criteria.</p>
    @else
        <p class="text-center mt-5">No jobs available at the moment.</p>
    @endif<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <!-- ======= Clients Section ======= -->
  <section id="clients" class="clients">
    <div class="container" data-aos="zoom-in">

      <div class="clients-slider swiper">
        <div class="swiper-wrapper align-items-center">
          <div class="swiper-slide"><img src="assets/img/clients/cenu.jpg" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/cpao.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/cho.jpg" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/City Public Library.jpg" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/d.jpg" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/l.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/w.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/ceo.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/ac.jpg" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="assets/img/clients/c.jpg" class="img-fluid" alt=""></div>

        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>
  </section><!-- End Clients Section -->

   <!-- ======= Cta Section ======= -->
   <section id="cta" class="cta">

  </section><!-- End Cta Section -->


   {{-- <!-- ======= About Section ======= -->
   <br><br><br><br><section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
          <img src="assets/img/about.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
        <h3>About us</h3><br>
          <p class="fst-italic">
          The premier online platform designed with one goal in mind: to bridge the gap between talented job seekers and innovative companies looking for the perfect fit. In the ever-evolving landscape of the job market, we understand the importance of a seamless, user-friendly experience that caters to the needs of both employers and prospective employees. Here's what makes us stand out:
          </p>
          <ul>
            <li><i class="ri-check-double-line"></i> Tailored Recommendations: Our smart algorithms analyze your profile, skills, and preferences to suggest jobs that are the right fit for you. Say goodbye to hours of sifting through irrelevant listings.</li>
            <li><i class="ri-check-double-line"></i> Easy Application Process: With just a few clicks, you can apply to your dream job. Our integrated platform ensures a smooth application process, from submitting your resume to scheduling interviews.</li>
            <li><i class="ri-check-double-line"></i> For Employers: Companies can effortlessly post job openings, screen candidates, and manage applications all in one place. Our tools are designed to help you find the right talent in the shortest time possible.</li>
            <li><i class="ri-check-double-line"></i> Learning Resources: We're not just about finding jobs; we're about building careers. Access a vast collection of articles, webinars, and tutorials to upskill and stay updated with industry trends.</li>
            <li><i class="ri-check-double-line"></i> Community and Networking: Engage with a community of like-minded professionals. Share experiences, seek advice, or simply connect to grow your professional network.</li>
          </ul>
          <p>
          Dive in and discover a world of opportunities with LGU JobFinder . Your next professional adventure awaits!
          </p>
        </div>
      </div>

    </div>
  </section><!-- End About Section --> --}}
  {{-- <svg id="scrollTopIcon" stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="icon-sm m-1" height="2em" width="2em" xmlns="http://www.w3.org/2000/svg" style="display: none; cursor: pointer;">
    <line x1="12" y1="5" x2="12" y2="19"></line>
    <polyline points="19 12 12 19 5 12"></polyline>
</svg> --}}




        <footer class="bg-gray-800 text-white py-8 mt-8">
            <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
                <div id="about"> <!-- Add this id attribute -->
                    <h3 class="text-lg font-semibold mb-3">About Us</h3>
                    <p>The Human Resource Management and Development Office (HRMDO) began as a division under the City Administrator’s Office in 1989. In 1995, then City Councilor Hon. Gabriel Glennville Gonzalez authored Resolution No. 333 Series of 1995. This resolution proposed to revise the organizational structure of the local government of General Santos City by authorizing the creation of several offices that will handle the different functions of the city government. When the Sangguniang Panlungsod of General Santos City passed this resolution, HRMDO was among the new office that were established</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-3">Contact Us</h3>
                    <p>Email: cmogensan@gmail.com</p><br>

                    <p>Phone: (083) 552 6791</p><br>
                    <p>Pres. Sergio Osmeña St, General Santos City, Philippines</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-3">Follow Us</h3>
                    <p>Stay connected through our social media channels:</p>
                    <div class="flex space-x-4 mt-2">
                        <a href="https://www.facebook.com/LguGensan" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>


                        <a href="https://gensantos.gov.ph/?fbclid=IwAR0u0NzxlzcHNjptbqA8Q-0SioAwpB2UXVLXGqUSspBUupUqSzoH6fAarBM" aria-label="Website"><i class="fas fa-globe"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <p>&copy; 2023 Local Government Unit of GSC. All rights reserved.</p>
            </div>
        </footer>






         <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    $(document).ready(function(){
        $(".find-jobs-link").click(function(e){
        e.preventDefault();
        $(".search-bar-container").toggleClass("show");
    });

        $(".nav-link").click(function(e){
        e.preventDefault();
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
    });



    });
    document.querySelector('a[href="#about"]').addEventListener('click', function(e) {
    e.preventDefault();
    const aboutSection = document.getElementById('about');
    aboutSection.scrollIntoView({ behavior: 'smooth' });
    });


    var scrollTopIcon = document.getElementById("scrollTopIcon");

window.onscroll = function() {
    // Show the SVG when the user scrolls down 20px from the top
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollTopIcon.style.display = "block";
    } else {
        scrollTopIcon.style.display = "none";
    }
}

// When the user clicks on the SVG, scroll to the top of the document
scrollTopIcon.onclick = function() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
}


    </script>


    </body>
    </html>
