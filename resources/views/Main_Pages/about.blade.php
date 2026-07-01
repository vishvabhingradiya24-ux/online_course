@extends('Main_Pages.headerpage')

@section('content')

    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --edu-navy: #1a1c3d; /* Admin Suite Navy */
            --edu-yellow: #ffbc06; /* Educenter Yellow */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
        }

        /* Full Header Matching Home Page */
        .header-main {
            background-color: white;
            border-bottom: 3px solid var(--edu-yellow);
        }

        .nav-link-custom {
            color: var(--edu-navy);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 14px;
            transition: 0.3s;
        }

        .nav-link-custom:hover {
            color: var(--edu-yellow);
        }

        .bg-navy-edu { background-color: var(--edu-navy); }
        .text-yellow-edu { color: var(--edu-yellow); }

        /* About Image Style */
        .about-image-wrapper {
            position: relative;
            display: inline-block;
        }

        .about-image-wrapper::after {
            content: "";
            position: absolute;
            bottom: -15px;
            right: -15px;
            width: 100%;
            height: 100%;
            border: 5px solid var(--edu-yellow);
            z-index: -1;
            border-radius: 10px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>



    <section class="bg-[#1a1c3d] py-12 text-center" style="padding-top: 220px">
        <h1 class="text-white text-4xl font-black">ABOUT OUR <span class="text-yellow-500">PLATFORM</span></h1>
        <p class="text-gray-400 mt-2 text-sm uppercase tracking-widest">Bridging Education & Industry</p>
    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">

                <div class="lg:w-1/2">
                    <div class="about-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80"
                             class="rounded-xl shadow-2xl w-full" alt="Students Working">
                    </div>
                </div>

                <div class="lg:w-1/2">
                    <h2 class="text-4xl font-black text-[#1a1c3d] mb-6 leading-tight">
                        We are Building the Next <br> Generation of <span class="text-yellow-500">MCA Experts.</span>
                    </h2>
                    <p class="text-gray-500 text-lg mb-8">
                        Educenter provides a robust environment where academic learning meets industrial reality. Our platform is designed to help students master **Laravel**, **Data Science**, and **Cloud Systems**.
                    </p>

                    <div class="space-y-4 mb-10">
                        <div class="flex items-center gap-4">
                            <i class="ti-shield text-yellow-500 text-2xl"></i>
                            <span class="font-bold text-[#1a1c3d]">Verified Curriculum by HODs</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="ti-layout-grid2 text-yellow-500 text-2xl"></i>
                            <span class="font-bold text-[#1a1c3d]">Integrated Management Console</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="ti-stats-up text-yellow-500 text-2xl"></i>
                            <span class="font-bold text-[#1a1c3d]">Industry Placement Tracking</span>
                        </div>
                    </div>

                    <a href="{{ url('/register') }}" class="inline-block bg-yellow-500 text-black px-10 py-4 rounded-lg font-black shadow-xl hover:bg-[#1a1c3d] hover:text-white transition">
                        GET STARTED NOW
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#1a1c3d] py-20 text-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-10 text-center">
                <div class="stat-card">
                    <h3 class="text-4xl font-black text-yellow-500">1,482</h3>
                    <p class="text-xs uppercase tracking-widest font-bold mt-2">Active Students</p>
                </div>
                <div class="stat-card">
                    <h3 class="text-4xl font-black text-yellow-500">45</h3>
                    <p class="text-xs uppercase tracking-widest font-bold mt-2">Total Courses</p>
                </div>
                <div class="stat-card">
                    <h3 class="text-4xl font-black text-yellow-500">08</h3>
                    <p class="text-xs uppercase tracking-widest font-bold mt-2">Pending Approvals</p>
                </div>
                <div class="stat-card">
                    <h3 class="text-4xl font-black text-yellow-500">95%</h3>
                    <p class="text-xs uppercase tracking-widest font-bold mt-2">Placement Success</p>
                </div>
            </div>
        </div>
    </section>


@endsection
