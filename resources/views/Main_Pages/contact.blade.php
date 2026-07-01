@extends('Main_Pages.headerpage')

@section('content')

    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --edu-navy: #1a1c3d; /* Admin Suite Navy */
            --edu-yellow: #ffbc06; /* Educenter Yellow */
        }
        <script>

    const name = document.querySelector('input[placeholder="Axita"]');
    const email = document.querySelector('input[placeholder="example@gmail.com"]');
    const subject = document.querySelector('input[placeholder="MCA Project Inquiry"]');
    const message = document.querySelector('textarea');
    const btn = e.target.querySelector('button');

    let isValid = true;

    document.querySelectorAll('.error-msg').forEach(el => el.remove());

        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; }

        /* Matching Header */
        .header-main {
            background-color: white;
            border-bottom: 3px solid var(--edu-yellow);
        }

        .nav-link-custom {
            color: var(--edu-navy);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 14px;
        }

        /* Input Styling */
        .form-control-custom {
            border: 2px solid #e2e8f0;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .form-control-custom:focus {
            border-color: var(--edu-yellow);
            box-shadow: none;
            outline: none;
        }

        .contact-info-card {
            background: var(--edu-navy);
            color: white;
            border-radius: 20px;
            padding: 40px;
            height: 100%;
        }
    </style>


  <section class="bg-[#1a1c3d] py-12 text-center" style="padding-top: 220px">
        <h1 class="text-white text-4xl font-black uppercase">Get In <span class="text-yellow-500">Touch</span></h1>
        <p class="text-gray-400 mt-2 text-sm uppercase tracking-widest">We are here to help you grow</p>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-5">
            <div class="flex flex-col lg:flex-row gap-12">

                <div class="lg:w-2/4">
                    <div class="contact-info-card shadow-2xl">
                        <h3 class="text-2xl font-bold mb-8 text-yellow-500">Contact Information</h3>

                        <div class="space-y-8">
                            <div class="flex items-center gap-4">
                                <i class="ti-location-pin text-yellow-500 text-2xl"></i>
                                <div>
                                    <p class="text-xs uppercase opacity-50 font-bold">Location</p>
                                    <p class="font-medium text-sm">LJ University, Ahmedabad, Gujarat</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <i class="ti-mobile text-yellow-500 text-2xl"></i>
                                <div>
                                    <p class="text-xs uppercase opacity-50 font-bold">Call Us</p>
                                    <p class="font-medium text-sm">+91 98765 43210</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <i class="ti-email text-yellow-500 text-2xl"></i>
                                <div>
                                    <p class="text-xs uppercase opacity-50 font-bold">Email</p>
                                    <p class="font-medium text-sm">support@educenter.com</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-20 flex gap-4">
                            <a href="#" class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-yellow-500 hover:text-black transition"><i class="ti-facebook"></i></a>
                            <a href="#" class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-yellow-500 hover:text-black transition"><i class="ti-linkedin"></i></a>
                            <a href="#" class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-yellow-500 hover:text-black transition"><i class="ti-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <div class="lg:w-3/4 bg-white p-10 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-3xl font-black text-[#1a1c3d] mb-8">Send us a <span class="text-yellow-500 text-underline">Message</span></h2>

                    <form action="{{ url('contact_send') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-bold uppercase text-gray-400">Full Name</label>
                            <input type="text" placeholder="Darshan" class="form-control-custom">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-bold uppercase text-gray-400">Email Address</label>
                            <input type="email" placeholder="example@gmail.com" class="form-control-custom">
                        </div>
                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-xs font-bold uppercase text-gray-400">Subject</label>
                            <input type="text" placeholder="MCA Project Inquiry" class="form-control-custom">
                        </div>
                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-xs font-bold uppercase text-gray-400">Message</label>
                            <textarea rows="5" placeholder="How can we help you?" class="form-control-custom"></textarea>
                        </div>

                        <div class="md:col-span-2">
                            <button type="submit" class="bg-yellow-500 text-[#1a1c3d] font-black px-12 py-4 rounded-lg shadow-xl hover:bg-[#1a1c3d] hover:text-white transition-all">
                                SEND MESSAGE NOW
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
